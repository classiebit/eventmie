<?php

namespace Classiebit\Eventmie;

use Illuminate\Filesystem\Filesystem;

class Eventmie
{
    protected $version;
    protected $filesystem;

    public function __construct()
    {
        $this->filesystem = app(Filesystem::class);

        $this->findVersion();
    }

    public function routes()
    {
        require __DIR__.'/../routes/eventmie.php';
        
    }

    public function view($name, array $parameters = [])
    {
        return view($name, $parameters);
    }

    public function getVersion()
    {
        return $this->version;
    }

    protected function findVersion()
    {
        if (!is_null($this->version)) {
            return;
        }

        if ($this->filesystem->exists(base_path('composer.lock'))) {
            // Get the composer.lock file
            $file = json_decode(
                $this->filesystem->get(base_path('composer.lock'))
            );

            // Loop through all the packages and get the version of package
            foreach ($file->packages as $package) {
                if ($package->name == 'classiebit/eventmie') {
                    $this->version = $package->version;
                    break;
                }
            }
        }
    }

    public function getLocales()
    {
        return array_diff(scandir(realpath(__DIR__.'/../publishable/lang')), ['..', '.']);
    }
}
