<?php
/**
 * Created by PhpStorm.
 * User: tolgaozen
 * Date: 3/18/22
 * Time: 11:50 AM
 */

namespace Permify\PermifyLaravel\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageAliases($app)
    {
        return [
            'Permify' => 'Permify\PermifyLaravel\Facades\PermifyFacade',
        ];
    }

    protected function getPackageProviders($app)
    {
        return ['Permify\PermifyLaravel\PermifyLaravelServiceProvider'];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('laracombee.workspace', 'c8o5b8d17c4f76akvgn0');
        $app['config']->set('laracombee.token', 'p3KzbQWAyPyYhzCyF3HDBgT2Vpwtg86iB3rua3ayFaP0fo4D8UAlSOi6YQQyyhg7');
        $app['config']->set('laracombee.timeout', '5000');
    }
}