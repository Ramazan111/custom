
# Eurostep Custom Storage

Every Laravel application has its internal storage folder, where local and public files/subfolders are located and made available for usage and access, depending on the application context.

Eurostep wants a new shared folder approach, where a server will contain all storages for all our client applications, and we need to update our Laravel applications (from 7.0 to 9.0 Laravel version) to add a new package able to provide an external adapter for the application storage.


### Steps to install
- Add this line to project's composer.json file
```
"repositories": [
    { 
        "type": "vcs", 
        "url": "https://github.com/Ramazan111/custom"
    }
],
```
- Run `composer update` || `composer install`
- Add `EurostepServiceProvider.php` to app.php config file
```
'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */
        EurostepServiceProvider::class,
        .
        .
        .
```
- Run artisan command: `php artisan eurostep:install`
