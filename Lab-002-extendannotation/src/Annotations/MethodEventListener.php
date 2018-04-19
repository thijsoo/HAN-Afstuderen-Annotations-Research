<?php
/**
 * Created by PhpStorm.
 * User: thijs-sollicity
 * Date: 22/03/2018
 * Time: 11:51
 */

namespace App\Annotations;


use App\Annotations\Exceptions\LocaleNotValidException;
use Doctrine\Common\Annotations\Reader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class MethodEventListener
{


    /** @var null|Request */
    private $request;
    /** @var Reader $reader */
    private $reader;

    /**
     * MethodEventListener constructor.
     *
     * @param Reader       $reader
     * @param RequestStack $requestStack
     */
    public function __construct(Reader $reader, RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->request->setLocale("en");
        $this->reader = $reader;
    }


    /**
     * @param FilterControllerEvent $event
     *
     * @throws LocaleNotValidException
     */
    public function onKernelController(FilterControllerEvent $event): void
    {
        $className = Method::class;
        /** @var Controller $controller */
        $controller = $event->getController();

        /** @var Controller $controllerObject */
        [$controllerObject, $methodName] = $controller;
        $controllerReflectionObject = new \ReflectionObject($controllerObject);
        $reflectionMethod = $controllerReflectionObject->getMethod($methodName);

        /** @var Method $annotation */
        $annotation = $this->reader->getMethodAnnotation($reflectionMethod, $className);

        if (null !== $annotation && $annotation->getLocale() !== $this->request->getLocale()) {
            throw new LocaleNotValidException("Locale for this route is not valid it should be {$annotation->getLocale()} but it is {$this->request->getLocale()}");
        }
    }


}