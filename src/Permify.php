<?php

namespace Permify\PermifyLaravel;

use GuzzleHttp\Promise\Promise;
use Permify\Requests\Request;
use Permify\Exceptions;

class Permify extends AbstractPermify
{
    /**
     * Create new Permify instance.
     */
    public function __construct()
    {
        parent::__construct(
            config('permify.workspace'),
            config('permify.token')
        );
    }

    /**
     * Send request.
     *
     * @param \Permify\Requests\Request $request
     *
     * @return \GuzzleHttp\Promise\Promise|mixed
     */
    public function call(Request $request)
    {
        return $promise = new Promise(function () use (&$promise, $request) {
            try {
                $request->setTimeout($this->timeout);
                $response = $this->client->call($request);
                $promise->resolve($response);
            } catch (Exceptions\ApiTimeoutException $e) {
                $promise->reject($e->getMessage());
            } catch (Exceptions\ResponseException $e) {
                $promise->reject($e->getMessage());
            } catch (Exceptions\PermifyException $e) {
                $promise->reject($e->getMessage());
            }
        });
    }
}
