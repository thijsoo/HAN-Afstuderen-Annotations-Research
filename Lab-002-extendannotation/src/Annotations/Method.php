<?php
/**
 * Created by PhpStorm.
 * User: thijs-sollicity
 * Date: 22/03/2018
 * Time: 11:42
 */

namespace App\Annotations;


/**
 * Class Method
 * @package App\Annotations
 * @Annotation
 */
class Method extends \Sensio\Bundle\FrameworkExtraBundle\Configuration\Method
{
    /** @var string $locale */
    protected $locale;

    /**
     * @return mixed
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale): void
    {
        $this->locale = $locale;
    }


}