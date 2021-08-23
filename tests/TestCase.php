<?php

namespace Hmones\LaravelFacade\Tests;

use Hmones\LaravelFacade\LaravelFacadeServiceProvider;
use Orchestra\Testbench\TestCase as Test;

class TestCase extends Test
{
    protected $serviceProviderPath;
    protected $serviceProviderClass;
    protected $facadeClassPath;

    public function test_basic(): void
    {
        $this->assertTrue(true);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->serviceProviderPath = $this->getProviderPath();
        $this->facadeClassPath = app_path('Facades/TestFacade.php');
        $this->serviceProviderClass = $this->getProviderClass();
    }

    protected function getProviderPath(): string
    {
        $providerDirectory = config('laravel-facade.provider.namespace');

        return app_path(
            str_replace(
                $this->getNamespace($providerDirectory).'\\',
                '',
                $providerDirectory
            ).'/'.config('laravel-facade.provider.name').'.php'
        );
    }

    protected function getNamespace($name): string
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }

    protected function getProviderClass(): string
    {
        return config('laravel-facade.provider.namespace').'\\'.config('laravel-facade.provider.name').'::class';
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelFacadeServiceProvider::class,
        ];
    }
}
