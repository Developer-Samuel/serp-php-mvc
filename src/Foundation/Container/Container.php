<?php

declare(strict_types=1);

namespace App\Foundation\Container;

final class Container
{
    /** @var array<string, object> */
    private array $instances = [];

    /**
     * @template T of object
     * 
     * @param class-string<T> $id
     * 
     * @return T
     */
    public function get(string $id): object
    {
        if (isset($this->instances[$id])) {
            /** @var T */
            return $this->instances[$id];
        }

        return $this->resolve($id);
    }

    /**
     * @template T of object
     * 
     * @param class-string<T> $id
     * 
     * @return T
     */
    private function resolve(string $id): object
    {
        $reflection = $this->getReflection($id);

        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return $this->setInstance($id, new $id());
        }

        $dependencies = $this->resolveParameters($constructor->getParameters());

        return $this->setInstance(
            $id, 
            $reflection->newInstanceArgs($dependencies)
        );
    }

    /**
     * @template T of object
     * 
     * @param class-string<T> $id
     * 
     * @return \ReflectionClass<T>
     */
    private function getReflection(string $id): \ReflectionClass
    {
        if (!class_exists($id)) {
            throw new \RuntimeException("Class {$id} does not exist.");
        }

        $reflection = new \ReflectionClass($id);

        if (!$reflection->isInstantiable()) {
            throw new \RuntimeException("Class {$id} is not instantiable.");
        }

        return $reflection;
    }
    
    /**
     * @template T of object
     * 
     * @param string $id
     * @param T $instance
     * 
     * @return T
    */
    private function setInstance(string $id, object $instance): object
    {
        return $this->instances[$id] = $instance;
    }

    /**
     * @param array<int, \ReflectionParameter> $parameters
     * 
     * @return array<int, object>
    */
    private function resolveParameters(array $parameters): array
    {
        return array_map(
            fn (\ReflectionParameter $param): object => $this->resolveDependency($param),
            $parameters
        );
    }

    /**
     * @param \ReflectionParameter $parameter
     * 
     * @return object
     * 
     * @throws \RuntimeException
    */
    private function resolveDependency(\ReflectionParameter $parameter): object
    {
        $type = $parameter->getType();
        if (!$type instanceof \ReflectionNamedType || $type->isBuiltin()) {
            throw new \RuntimeException(
                "Container cannot resolve non-class parameter '{$parameter->getName()}' in {$parameter->getDeclaringClass()?->getName()}"
            );
        }

        /** @var class-string<object> $className */
        $className = $type->getName();

        return $this->get($className);
    }
}