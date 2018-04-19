<?php
/**
 * Created by PhpStorm.
 * User: thijs-sollicity
 * Date: 21/03/2018
 * Time: 14:55
 */

namespace App\Domain\Middleware\Contracts;


use Symfony\Component\HttpFoundation\Request;

interface Middleware
{
    public function setRequest(Request $request);

}