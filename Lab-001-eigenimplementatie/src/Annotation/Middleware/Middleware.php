<?php
/**
 * Created by PhpStorm.
 * User: thijs-sollicity
 * Date: 21/03/2018
 * Time: 11:28
 */

namespace App\Annotation\Middleware;

/**
 * Class Middleware
 * @package App\Annotation
 * @Annotation
 */
class Middleware
{
    /** @var string $class */
    public $class;
    /** @var string $method */
    private $method;

    /** @var array $params */
    private $params;

    /**
     * Middleware constructor.
     *
     * @param array $options
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $options)
    {
        foreach ($options as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new \InvalidArgumentException(sprintf('Property "%s" does not exist', $key));
            }
            $this->$key = $value;
        }

    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams():? array
    {
        return $this->params;
    }


}