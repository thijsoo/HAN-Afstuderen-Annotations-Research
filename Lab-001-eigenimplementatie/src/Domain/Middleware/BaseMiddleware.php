<?php
/**
 * Created by PhpStorm.
 * User: thijs-sollicity
 * Date: 21/03/2018
 * Time: 14:56
 */

namespace App\Domain\Middleware;


use App\Domain\Middleware\Contracts\Middleware;
use Symfony\Component\HttpFoundation\Request;

class BaseMiddleware implements Middleware
{
    /** @var Request $request */
    protected $request;

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}