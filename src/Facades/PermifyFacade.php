<?php
/**
 * Created by PhpStorm.
 * User: tolgaozen
 * Date: 3/16/22
 * Time: 9:11 PM
 */

namespace Permify\PermifyLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class PermifyFacade extends Facade
{
    /**
     * Get Facade Accessor.
     *
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'permify';
    }
}