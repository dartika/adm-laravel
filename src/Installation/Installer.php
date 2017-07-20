<?php

namespace Dartika\Adm\Installation;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class Installer
{
    private $command;
    private $fileSystem;

    public function __construct(Command $command, Filesystem $fileSystem)
    {
        $this->command = $command;
        $this->fileSystem = $fileSystem;
    }

    public function install()
    {
        if (!$this->fileSystem->exists($this->getAdmPath()) || $this->command->confirm('This will overwrite all existing admin data (views, routes, translations...), are you sure?')) {
            // vendor publish
            $this->command->call('vendor:publish', ['--provider' => 'Dartika\Adm\Providers\AdmServiceProvider', '--force' => true]);

            // bootstrap directory
            $this->fileSystem->makeDirectory($this->getAdmPath(), 0755, true, true);

            // custom routes file
            $routeStubContent = $this->fileSystem->get(__DIR__ . '/stubs/routes.stub');
            $this->fileSystem->put($this->getAdmPath('routes.php'), $routeStubContent);

            $this->command->comment('Dartika Admin successfully installed.');
        }
    }

    protected function getAdmPath($path = null)
    {
        return base_path() . '/' . config('dartika-adm.admPath') . "/{$path}";
    }
}
