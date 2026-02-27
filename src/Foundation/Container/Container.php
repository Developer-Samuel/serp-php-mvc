<?php

declare(strict_types=1);

namespace App\Foundation\Container;

final class Container
{
    /** @var array<string, object> */
    private array $instances = [];

    /** @var array<string, string|\Closure(self): object> */
    private array $bindings = [];

    /**
     * @param string $id
     * 
     * @return object
    */
    public function get(string $id): object
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        if (isset($this->bindings[$id])) {
            $concrete = $this->bindings[$id];

            if ($concrete instanceof \Closure) {
                $instance = $concrete($this);
                return $this->setInstance($id, $instance);
            }

            return $this->get($concrete);
        }

        return $this->resolve($id);
    }

    /**
     * @param string $id
     * @param mixed $concrete
     * 
     * @return void
    */
    public function set(string $id, mixed $concrete): void
    {
        match (true) {
            $concrete instanceof \Closure, is_string($concrete) => $this->bindings[$id] = $concrete,
            is_object($concrete) => $this->instances[$id] = $concrete,
            default => throw new \InvalidArgumentException(
                sprintf('Invalid type for [%s]. Expected Closure, string or object, got %s.', $id, get_debug_type($concrete))
            ),
        };
    }

    /**
     * @param string $id
     * 
     * @return object
     * 
     * @throws \ReflectionException|\LogicException
     */
    private function resolve(string $id): object
    {
        if (!class_exists($id)) {
            throw new \LogicException(sprintf('Target class [%s] does not exist.', $id));
        }

        $reflection = $this->getReflection($id);

        $constructor = $reflection->getConstructor();
        if ($constructor === null) {
            $instance = new $id();
            return $this->setInstance($id, $instance);
        }

        $dependencies = $this->resolveParameters($constructor->getParameters());

        $instance = $reflection->newInstanceArgs($dependencies);

        return $this->setInstance($id, $instance);
    }

    /**
     * @template T of object
     * 
     * @param class-string<T> $id
     * 
     * @return \ReflectionClass<T>
     * 
     * @throws \RuntimeException
    */
    private function getReflection(string $id): \ReflectionClass
    {
        if (!class_exists($id) && !interface_exists($id)) {
            throw new \RuntimeException(sprintf('Class or Interface %s does not exist.', $id));
        }

        /** @var \ReflectionClass<T> */
        return new \ReflectionClass($id);
    }

    /**
     * @param string $id
     * @param object $instance
     * 
     * @return object
    */
    private function setInstance(string $id, object $instance): object
    {
        $this->instances[$id] = $instance;

        return $instance;
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
            $declaringClass = $parameter->getDeclaringClass();

            throw new \RuntimeException(
                sprintf(
                    "Container cannot resolve non-class parameter '%s' in %s",
                    $parameter->getName(),
                    $declaringClass ? $declaringClass->getName() : 'unknown'
                )
            );
        }

        return $this->get($type->getName());
    }
}