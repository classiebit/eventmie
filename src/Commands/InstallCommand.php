<?php

namespace Classiebit\Eventmie\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageServiceProviderLaravel5;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Classiebit\Eventmie\Traits\Seedable;
use Classiebit\Eventmie\EventmieServiceProvider;

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
    protected $description = 'Install the Eventmie package';

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
        $this->info('Initiate the installation process...');

        // 1. Publish the core assets defined in the EventmieServiceProvider
        $this->info('1. Publishing Eventmie core assets: config, languages & dummy content');
        $this->call('vendor:publish', ['--provider' => EventmieServiceProvider::class]);

        // 2. Run Eventmie migrations
        $this->info('2. Migrating the Eventmie database tables into your application');
        $this->call('migrate', ['--force' => $this->option('force')]);
        
        // 3. Extend App\User to Eventmie user model
        $this->info('3. Attempting to set Eventmie User model as parent to App\User');
        if (file_exists(app_path('User.php'))) {
            $str = file_get_contents(app_path('User.php'));

            if ($str !== false) {
                $str = str_replace('extends Authenticatable', "extends \Classiebit\Eventmie\Models\User", $str);

                file_put_contents(app_path('User.php'), $str);
            }
        } else {
            $this->warn('Unable to locate "app/Models/User.php".  Did you move this file?');
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

        // 6. Add storage symlink
        $this->info('6. Adding the storage symlink to your public folder');
        $this->call('storage:link');
        
        // Finish
        $this->info('Congrats!!! Eventmie installed successfully! Wish you all the best :)');
    }
}
