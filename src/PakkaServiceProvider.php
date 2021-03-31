<?php

namespace TheRealJanJanssens\Pakka;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use TheRealJanJanssens\Pakka\Commands\CleanCommand;
use TheRealJanJanssens\Pakka\Commands\InstallCommand;
use TheRealJanJanssens\Pakka\Commands\UserMakeCommand;

class PakkaServiceProvider extends PackageServiceProvider
{
    public function bootingPackage()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //php artisan vendor:publish --tag=pakka
        $this->publishes([
            // Config
            __DIR__.'/../config/_fonts.php' => config_path('_fonts.php'),
            __DIR__.'/../config/app.php' => config_path('app.php'),
            __DIR__.'/../config/database.php' => config_path('database.php'),
            __DIR__.'/../config/debugbar.php' => config_path('debugbar.php'),
            __DIR__.'/../config/auth.php' => config_path('auth.php'),
            __DIR__.'/../config/image.php' => config_path('image.php'),
            __DIR__.'/../config/pakka.php' => config_path('pakka.php'),
            __DIR__.'/../config/placeholders.php' => config_path('placeholders.php'),
            __DIR__.'/../config/settings.php' => config_path('settings.php'),

            // NPM json
            __DIR__.'/../resources/dev/package.json' => base_path('package.json'),

            // Webpack Mix
             __DIR__.'/../resources/dev/webpack.mix.js' => public_path('../webpack.mix.js'),

            // Helpers
            //__DIR__.'/../src/Helpers' => app_path('Helpers'),

            // Providers
            __DIR__.'/../src/Providers/HelperServiceProvider.php' => app_path('Providers/HelperServiceProvider.php'),
            __DIR__.'/../src/Providers/MacroServiceProvider.php' => app_path('Providers/MacroServiceProvider.php'),

            // Middleware
            __DIR__.'/../src/Http/Middleware/Locale.php' => app_path('Http/Middleware/Locale.php'),
            __DIR__.'/../src/Http/Middleware/Role.php' => app_path('Http/Middleware/Role.php'),
            __DIR__.'/../src/Http/Middleware/VerifyCsrfToken.php' => app_path('Http/Middleware/VerifyCsrfToken.php'),

            // Kernel
            __DIR__.'/../src/Http/Kernel/Kernel.php' => app_path('Http/Kernel.php'),

            //Auth
            //__DIR__.'/../src/Http/Controllers/Auth' => app_path('Http/Controllers/Auth'),
            
            // Storage Assets
            __DIR__.'/../storage/analytics' => storage_path('app/analytics'),
            __DIR__.'/../storage/fonts' => storage_path('fonts'),

            // Public Assets
            __DIR__.'/../resources/dist/css' => public_path('vendor/css'),
            __DIR__.'/../resources/dist/js' => public_path('vendor/js'),
            __DIR__.'/../resources/dist/images' => public_path('vendor/images'),
            __DIR__.'/../resources/dist/fonts' => public_path('vendor/fonts'),
        ], 'pakka');

        // $this->publishes([
        //     // Composer.json for pakka dev
        //     __DIR__.'/../resources/dev/composer.json' =>  public_path('../composer.json'),
            
        //     // Webpack Mix
        //     __DIR__.'/../resources/dev/webpack.mix.js' => public_path('../webpack.mix.js'),

        //     // Dev Assets
        //     __DIR__.'/../resources/js' => resource_path('pakka/js'),
        //     __DIR__.'/../resources/sass' => resource_path('pakka/sass'),

        // ], 'pakka-dev');

        if (file_exists($file = __DIR__.'/Macros/form.php')) {
            require_once $file;
        }
    }
    
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pakka')
            ->hasViews()
            ->hasConfigFile()
            ->hasTranslations()
            ->hasRoute('web')
            // ->hasMigrations([
            //     'create_attribute_inputs_table'
            // ])
            ->hasCommands([
                InstallCommand::class,
                CleanCommand::class,
                UserMakeCommand::class,
            ]);
    }
}
