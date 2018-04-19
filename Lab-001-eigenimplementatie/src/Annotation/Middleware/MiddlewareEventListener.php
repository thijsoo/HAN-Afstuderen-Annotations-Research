<?php
/**
 * Created by PhpStorm.
 * User: thijs-sollicity
 * Date: 21/03/2018
 * Time: 13:17
 */

namespace App\Annotation\Middleware;


use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class MiddlewareEventListener
{
    private $request;


    /**
     * SecureTokenAnnotationListener constructor.
     *
     * @param Reader $reader
     */
    public function __construct(Reader $reader, RequestStack $request)
    {
        $this->reader = $reader;
        $this->request = $request->getCurrentRequest();

    }


    /**
     * @param FilterControllerEvent $event
     *
     * @throws \ReflectionException
     */
    public function onKernelController(FilterControllerEvent $event): void
    {
        /** @var Controller $controller */
        $controller = $event->getController();

        /** @var Controller $controllerObject */
        [$controllerObject, $methodName] = $controller;
        if ($controllerObject instanceof Controller) {
            $this->parseMiddlewareAnnotations($controllerObject, $methodName);


        }
    }

    /**
     * @param Controller $controllerObject
     * @param string     $methodName
     *
     * Always give method priority over class in retruns
     *
     * @return Middleware|null
     * @throws \ReflectionException
     */
    private function parseMiddlewareAnnotations(Controller $controllerObject, string $methodName): void
    {
        $className = Middleware::class;

        $classAnnotations = $this->reader->getClassAnnotations(
            new \ReflectionClass(ClassUtils::getClass($controllerObject)), $className
        );

        if (null !== $classAnnotations) {
            $this->callMiddlewareMethods($classAnnotations);
        }

        $controllerReflectionObject = new \ReflectionObject($controllerObject);
        $reflectionMethod = $controllerReflectionObject->getMethod($methodName);
        $methodAnnotations = $this->reader->getMethodAnnotations($reflectionMethod, $className);

        if (null !== $methodAnnotations) {
            $this->callMiddlewareMethods($methodAnnotations);
        }
    }

    /**
     * @param array $annotations
     */
    private function callMiddlewareMethods(array $annotations)
    {
        foreach ($annotations as $annotation) {
            if ($annotation instanceof Middleware) {
                $this->callMiddlewareMethod($annotation);
            }
        }

    }

    /**
     * @param Middleware $annotation
     */
    private function callMiddlewareMethod(Middleware $annotation)
    {
        $class = new $annotation->class;
        $class->setRequest($this->request);
        $method = $annotation->getMethod();
        if ($annotation->getParams()) {
            $class->$method(...$annotation->getParams());
        } else {
            $class->$method();
        }
    }

}