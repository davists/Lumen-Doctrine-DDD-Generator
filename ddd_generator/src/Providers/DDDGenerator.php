<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/28/17
 * Time: 4:41 PM
 */
namespace DDD\Generator\Providers;

use DDD\Generator\Console\DDDGeneratorCommand;
use Illuminate\Support\ServiceProvider;

class DDDGenerator extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.ddd.generator', function()
        {
            return new DDDGeneratorCommand();
        });

        $this->commands(
            'command.ddd.generator'
        );
    }

}