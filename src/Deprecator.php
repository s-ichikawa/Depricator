<?php
namespace Sichikawa\Deprecator;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use ReflectionClass;
use ReflectionMethod;
use Sichikawa\Deprecator\Annotations\Deprecated;

trait Deprecator
{
    public static function check_deprecated()
    {
        foreach (debug_backtrace() as $backtrace) {
            echo '------';
            var_dump($backtrace);
            $file = $backtrace['file'] ?? '';
            $class = $backtrace['class'] ?? '';
            $function = $backtrace['function'] ?? '';

            if (!$class) {
                continue;
            }
            $reader = new \Doctrine\Common\Annotations\AnnotationReader();
            $reflClass = new ReflectionClass($class);
            $classAnnotations = $reader->getClassAnnotations($reflClass);
            var_dump($classAnnotations);

        }
    }

    public function init()
    {
        var_dump(__NAMESPACE__, __DIR__);
        AnnotationRegistry::registerAutoloadNamespace(__NAMESPACE__ . '\Annotations', __DIR__ . '/Annotations');
    }

    public function deprecated()
    {
        $this->init();
        $class = get_class($this);
        var_dump($class);
        $reader = new \Doctrine\Common\Annotations\AnnotationReader();

        $reflClass = new ReflectionClass($class);
        $classAnnotations = $reader->getClassAnnotations($reflClass);
        var_dump($classAnnotations);

        $reflMethod = new ReflectionMethod($class, 'index');
        $methodAnotations = $reader->getMethodAnnotations($reflMethod);
        var_dump($methodAnotations);
    }
}