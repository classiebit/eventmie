<?php

namespace Classiebit\Eventmie\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageServiceProviderLaravel5;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Classiebit\Eventmie\Traits\Seedable;
use Classiebit\Eventmie\EventmieServiceProvider;
use Facades\Classiebit\Eventmie\Eventmie;

use Illuminate\Support\Facades\File;  

class UpdateCommand extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__.'/../../publishable/database/seeds/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'eventmie:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eventmie Lite Updater';

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
        $this->info('Initializing update process...');
        $this->update($filesystem);
    }

    private function update(Filesystem $filesystem)
    {
        // ---- Check if everything good so far ----
        $this->info('---- Dumping the autoloaded files and reloading all new files ----');
        $composer = $this->findComposer();
        $process = new Process([$composer.' dump-autoload']);
        // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setTimeout(null); 
        $process->setWorkingDirectory(base_path())->run();

        // 1. Run Eventmie migrations
        $this->info('1. Migrating the Eventmie Lite database tables to update');
        $this->call('migrate', ['--force' => $this->option('force')]);
        
        // 2. Run database seeder
        $this->info('2. Running Eventmie Lite database update seeders');
        $this->seed('EventmieDatabaseUpdateSeeder');

        // Copy missing extras folder's files to storage
        $dir = str_replace('src/Commands', '', __DIR__);
        File::copyDirectory($dir.'publishable/assets/ep_img/', public_path('/'));
        
        
        // 3. Run cache clear commands
        $this->info('3. Clearing application cache');
        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('cache:clear');
        
        // Finish
        $version = Eventmie::getVersion();
        $this->info("Congrats! Eventmie Lite successfully updated to version $version! Make sure to check Eventmie Pro FullyLoaded on our website- https://classiebit.com/eventmie-pro-fullyloaded");
    }
    
}
