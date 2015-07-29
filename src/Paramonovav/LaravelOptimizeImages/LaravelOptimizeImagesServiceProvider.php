<?php
namespace Paramonovav\LaravelOptimizeImages;

use Illuminate\Support\ServiceProvider;
/**
 * Service provider for the Recaptcha class
 * 
 * @author     Anton Paramonov
 * @link       https://github.com/paramonovav/laravel-optimize-images

 */
class LaravelOptimizeImagesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;
    
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('paramonovav/laravel-optimize-images');
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['command.optimize.images'] = $this->app->share(function () {
            return new Commands\OptimizeImageCommand();
        });

        $this->commands('command.optimize.images');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('command.optimize.images');
	}

}
