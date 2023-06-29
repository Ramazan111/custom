<?php

namespace Eurostep\Custom\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

        $this->updateStorageConfiguration();

        $this->info('Package installed and configured successfully.');
    }

    protected function updateStorageConfiguration()
    {
        $configPath = config_path('filesystems.php');
        $config = File::get($configPath);

        // Update the configuration to inject the new adapter
        $newConfig = str_replace(
            "'default' => env('FILESYSTEM_DRIVER', 'local'),",
            "'default' => env('FILESYSTEM_DRIVER', 'eurostep_root'),",
            $config
        );

        // Write the updated configuration back to the file
        File::put($configPath, $newConfig);

        // Configure the new adapter for the Eurostep driver
        config(['filesystems.disks.eurostep_root' => [
            'driver' => 'local',
            'root' => storage_path('application-1/public'), // Replace with the actual root path
        ]]);

        // Optionally, you can set the configured storage as the default driver
        config(['filesystems.default' => 'eurostep_root']);

        // Reload the configuration cache to reflect the changes
        Artisan::call('config:cache');

    }

}
