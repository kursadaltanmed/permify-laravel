<?php
/**
 * Created by PhpStorm.
 * User: tolgaozen
 * Date: 3/16/22
 * Time: 9:15 PM
 */

namespace Permify\PermifyLaravel;

class PermifyLaravelConnector
{
    /**
     *
     * @return Permify
     */
    public function connect()
    {
        return new Permify();
    }
}