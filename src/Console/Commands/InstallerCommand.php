<?php

namespace Dartika\Adm\Console\Commands;

use Dartika\Adm\Console\Installation;
use Dartika\Adm\Installation\Installer;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallerCommand extends Command
{
    protected $signature = 'dartika-adm:install';

    protected $description = 'Installs the dartika-adm dependencies';

    protected $fileSystem;

    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;

        parent::__construct();
    }

    public function handle()
    {
        $installer = new Installer($this, $this->fileSystem);
        $installer->install();
    }
}
