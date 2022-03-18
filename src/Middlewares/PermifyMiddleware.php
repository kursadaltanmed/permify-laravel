<?php
/**
 * Created by PhpStorm.
 * User: tolgaozen
 * Date: 3/17/22
 * Time: 6:46 PM
 */

namespace Permify\PermifyLaravel\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;
use Permify\PermifyLaravel\Exceptions\UnauthorizedException;
use Permify\PermifyLaravel\Facades\PermifyFacade;

class PermifyMiddleware
{
    /**
     * handle.
     *
     * @param mixed $request
     * @param Closure $next
     * @param string[] $options
     *
     * @return Closure
     * @throws  UnauthorizedException
     */
    public function handle($request, Closure $next, ...$options)
    {
        if (Auth::guest()) {
            throw new UnauthorizedException();
        }

        $user = Auth::user();
        $identifier = strval($user->getAuthIdentifier());
        $policy_name = $options[0];
        $optionals = ["cascade_create" => true];

        if (count($options) == 3) {
            $resourceId = $request->route($options[2]);
            if ($resourceId){
                $optionals["resource_id"] = $resourceId;
                $optionals["resource_type"] = $options[1];
            }
        }

        PermifyFacade::IsAuthorized($policy_name, $identifier, $optionals)->then(function ($response) {
            if (!$response->allow) {
                throw new UnauthorizedException();
            }
        })->otherWise(function ($error) {
            throw new UnauthorizedException();
        })->wait();

        return $next($request);
    }
}