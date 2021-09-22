<?php

namespace Helpers;
use ReflectionProperty;
use ReflectionException;

trait PropertiesUnwrapper
{
    /**
     * @throws ReflectionException
     */
    public function getReflectionValue(string $classFqn, string $propertyName, object $actualObject){
        $reflectionProperty = new ReflectionProperty($classFqn, $propertyName);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($actualObject);
    }

}