<?php
namespace eurostep\custom;

use Illuminate\Support\Facades\Storage;

class Eurostep
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function configure($appName)
    {
        $storageRoot = rtrim($this->config['storage_root'], '/');
        $storagePath = $storageRoot . '/' . $appName;

        // Configure the storage adapter with the new path
        config(['filesystems.disks.eurostep_root' => [
            'driver' => 'local',
            'root' => $storagePath,
        ]]);
    }

    public function storage($disk = null)
    {
        return Storage::disk($disk);
    }
}
