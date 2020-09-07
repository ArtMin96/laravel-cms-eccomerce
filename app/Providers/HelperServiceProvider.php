<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

/**
 * Class HelperServiceProvider
 * @package App\Providers
 */
class HelperServiceProvider extends ServiceProvider
{

    /**
     * Register helper files
     */
    public function register(): void
    {
        $fileName = glob(app_path('Helpers/*.php'));

        if ($fileName !== false && is_iterable($fileName)) {
            foreach ($fileName as $file) {
                require_once $file;
            }
        }
    }

}
