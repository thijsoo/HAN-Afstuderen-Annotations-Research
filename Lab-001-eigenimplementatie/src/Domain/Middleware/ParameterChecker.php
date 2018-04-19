<?php
/**
 * Created by PhpStorm.
 * User: thijs-sollicity
 * Date: 21/03/2018
 * Time: 14:22
 */

namespace App\Domain\Middleware;


use App\Domain\Middleware\Exceptions\GetParameterMissingException;

class ParameterChecker extends BaseMiddleware
{

    /**
     * @param array ...$params
     *
     * @throws GetParameterMissingException
     */
    public function checkGet(...$params): void
    {
        foreach ($params as $requiredGet) {
            if (!$this->getRequest()->query->has($requiredGet)) {
                throw new GetParameterMissingException("parameter '{$requiredGet}' missing from query");
            }
        }
    }
}