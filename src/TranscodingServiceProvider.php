<?php

namespace CocoNing\Transcoding;

use Illuminate\Support\ServiceProvider;

class TranscodingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('transcoding', function () {
            return new Prepare();
        });
    }
}