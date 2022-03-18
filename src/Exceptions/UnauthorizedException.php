<?php
/**
 * Created by PhpStorm.
 * User: tolgaozen
 * Date: 3/17/22
 * Time: 12:55 AM
 */

namespace Permify\PermifyLaravel\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends HttpException
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(403, "This action is unauthorized.");
    }
}