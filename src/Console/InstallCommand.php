<?php

namespace Eurostep\Custom\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the Eurostep custom files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Publish the Service Provider
        $this->call('vendor:publish', [
            '--provider' => 'Eurostep/Custom/Providers/EurostepServiceProvider',
        ]);

        // Publish the configuration file
        $this->call('vendor:publish', [
            '--tag' => 'config',
        ]);

        $this->info('Package installed and configured successfully.');
    }
}
