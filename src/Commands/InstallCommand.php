<?php

namespace Classiebit\Eventmie\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Classiebit\Eventmie\Traits\Seedable;

use Classiebit\Eventmie\EventmieServiceProvider;
use Facades\Classiebit\Eventmie\Eventmie;

use File;

class InstallCommand extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__.'/../../publishable/database/seeds/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'eventmie:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eventmie Lite Installer';

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
        ];
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }


    /**
     * Merge Eventmie package.json dependencies with host application's package.json
     *
     * @return void
     */
    protected function mergePackageJson()
    {
        $hostPackageJsonPath = base_path('package.json');
        $eventmiePackageJsonPath = __DIR__.'/../../package.json';
        
        if (!file_exists($eventmiePackageJsonPath)) {
            $this->warn('Eventmie package.json not found, skipping npm dependencies merge');
            return;
        }
        
        // Read Eventmie package.json
        $eventmiePackageJson = json_decode(file_get_contents($eventmiePackageJsonPath), true);
        
        if (!$eventmiePackageJson) {
            $this->warn('Invalid Eventmie package.json, skipping npm dependencies merge');
            return;
        }
        
        // Read or create host package.json
        $hostPackageJson = [];
        if (file_exists($hostPackageJsonPath)) {
            $hostPackageJson = json_decode(file_get_contents($hostPackageJsonPath), true) ?: [];
        }
        
        // Initialize required sections
        if (!isset($hostPackageJson['dependencies'])) {
            $hostPackageJson['dependencies'] = [];
        }
        if (!isset($hostPackageJson['devDependencies'])) {
            $hostPackageJson['devDependencies'] = [];
        }
        if (!isset($hostPackageJson['scripts'])) {
            $hostPackageJson['scripts'] = [];
        }
        
        // Merge dependencies
        $merged = false;
        
        // Merge devDependencies
        if (isset($eventmiePackageJson['devDependencies'])) {
            foreach ($eventmiePackageJson['devDependencies'] as $package => $version) {
                if (!isset($hostPackageJson['devDependencies'][$package])) {
                    $hostPackageJson['devDependencies'][$package] = $version;
                    $merged = true;
                }
            }
        }
        
        // Merge dependencies
        if (isset($eventmiePackageJson['dependencies'])) {
            foreach ($eventmiePackageJson['dependencies'] as $package => $version) {
                if (!isset($hostPackageJson['dependencies'][$package])) {
                    $hostPackageJson['dependencies'][$package] = $version;
                    $merged = true;
                }
            }
        }
        
        // Merge scripts (only add if they don't exist)
        if (isset($eventmiePackageJson['scripts'])) {
            foreach ($eventmiePackageJson['scripts'] as $script => $command) {
                if (!isset($hostPackageJson['scripts'][$script])) {
                    $hostPackageJson['scripts'][$script] = $command;
                }
            }
        }
        
        // Write updated package.json
        if ($merged) {
            file_put_contents($hostPackageJsonPath, json_encode($hostPackageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            $this->info('Merged Eventmie npm dependencies into host package.json');
        }
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        $this->info('Initializing installation process...');
        $this->install($filesystem);
    }

    private function install(Filesystem $filesystem)
    {
        // 1. Publish the core assets defined in the EventmieServiceProvider
        $this->info('1. Publishing Eventmie core assets: config, languages & dummy content');
        $this->call('vendor:publish', ['--provider' => EventmieServiceProvider::class]);

        // 2. Run Eventmie migrations
        $this->info('2. Migrating the Eventmie database tables into your application');
        $this->call('migrate', ['--force' => $this->option('force')]);
        
        // 3. Extend App\User to Eventmie user model
        $this->info('3. Attempting to set Eventmie Pro User model as parent to App\User');
        if (file_exists(app_path('User.php')) || file_exists(app_path('Models/User.php'))) {
            $userPath = file_exists(app_path('User.php')) ? app_path('User.php') : app_path('Models/User.php');

            $str = file_get_contents($userPath);

            if ($str !== false) {
                $str = str_replace('extends Authenticatable', "extends \Classiebit\Eventmie\Models\User", $str);

                file_put_contents($userPath, $str);
            }
        } else {
            $this->warn('Unable to locate "User.php" in app or app/Models.  Did you move this file?');
            $this->warn('You will need to update this manually.  Change "extends Authenticatable" to "extends \Classiebit\Eventmie\Models\User" in your User model');
        }

        // ---- Check if everything good so far ----
        $this->info('---- Dumping the autoloaded files and reloading all new files ----');
        $composer = $this->findComposer();
        $process = new Process([$composer.' dump-autoload']);
        // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setTimeout(null); 
        $process->setWorkingDirectory(base_path())->run();

        // 4. Add Eventmie Route
        $this->info('4. Adding Eventmie routes to your application routes/web.php');
        $routes_contents = $filesystem->get(base_path('routes/web.php'));
        if (false === strpos($routes_contents, 'Eventmie::routes()')) {
            $filesystem->append(
                base_path('routes/web.php'),
                "\n\nEventmie::routes();\n"
            );
        }

        // 5. Run database seeder
        $this->info('5. Running Eventmie database seeders');
        $this->seed('EventmieDatabaseSeeder');
        
        // 6. Copy missing extras folder's files to storage
        $this->info('6. Adding Placeholders');
        $dir = str_replace('src/Commands', '', __DIR__);
        File::copyDirectory($dir.'publishable/assets/ep_img/', public_path('/'));
        File::copyDirectory($dir.'publishable/assets/webfonts/', public_path('/'));
        // copy vite config
        $viteConfigSrc  = $dir.'publishable/assets/vite.config.js';
        $viteConfigDest = base_path('vite.config.js');
        if (file_exists($viteConfigSrc)) {
            if (!file_exists($viteConfigDest)) {
                $this->info('Copied vite.config.js to application root');
            } else {
                $this->warn('vite.config.js already exists at application root, overriding the existing vite.config.js');
            }
            File::copy($viteConfigSrc, $viteConfigDest);
        }
        File::copyDirectory($dir.'publishable/dummy_content/', storage_path('app/public/'));
        
        // 7. Merge npm dependencies
        $this->info('7. Merging npm dependencies into package.json');
        $this->mergePackageJson();
        
        // 8. Add storage symlink
        $this->info('8. Adding the storage symlink to your public folder');
        $this->call('storage:link');
        
        $version = Eventmie::getVersion();
        $this->info("Congrats! Eventmie Lite successfully updated to version $version! Make sure to check Eventmie Pro FullyLoaded on our website- https://classiebit.com/eventmie-pro-fullyloaded");

        $this->info('!!! Final Important Step: Please run "npm install" and "npm run build" to install the dependencies and build the assets');
    }
    
}
