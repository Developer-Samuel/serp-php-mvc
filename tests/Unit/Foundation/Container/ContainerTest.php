<?php

declare(strict_types=1);

namespace Tests\Unit\Foundation\Container;

use PHPUnit\{
    Framework\Attributes\CoversClass,
    Framework\TestCase
};

use App\Foundation\Container\Container;

use Tests\{
    Support\Foundation\Container\Dependency\Dependency,
    Support\Foundation\Container\Dependency\DependencyInterface,
    Support\Foundation\Container\Service\AbstractService,
    Support\Foundation\Container\Service\ServiceWithDependency,
    Support\Foundation\Container\Service\ServiceWithPrimitive,
    Support\Foundation\Container\Service\SimpleService
};

#[CoversClass(Container::class)]
final class ContainerTest extends TestCase
{
    private Container $container;

    /**
     * @return void
    */
    protected function setUp(): void
    {
        $this->container = new Container();
    }

    /**
     * Method: get()
     * 
     * @return void
    */
    public function testGetResolvesClassWithNoDependencies(): void
    {
        $instance = $this->container->get(SimpleService::class);

        $this->assertInstanceOf(SimpleService::class, $instance);
    }

    /**
     * Method: get()
     * 
     * @return void
    */
    public function testGetCachesInstances(): void
    {
        $first = $this->container->get(SimpleService::class);
        $second = $this->container->get(SimpleService::class);

        $this->assertSame($first, $second);
    }

    /**
     * Method: get()
     * 
     * @return void
    */
    public function testGetThrowsWhenClassDoesNotExist(): void
    {
        $this->expectException(\LogicException::class);

        $this->container->get('ClassThatDoesNotExist');
    }

    /**
     * Method: get()
     * 
     * @return void
    */
    public function testGetThrowsWhenInterfaceNotBound(): void
    {
        $this->expectException(\LogicException::class);

        $this->container->get(DependencyInterface::class);
    }

    /**
     * Method: set()
     * 
     * @return void
    */
    public function testSetResolvesStringBinding(): void
    {
        $this->container->set(DependencyInterface::class, Dependency::class);

        $instance = $this->container->get(DependencyInterface::class);

        $this->assertInstanceOf(Dependency::class, $instance);
    }

    /**
     * Method: set()
     * 
     * @return void
    */
    public function testSetResolvesClosureBinding(): void
    {
        $this->container->set(
            DependencyInterface::class,
            fn (Container $container) => new Dependency()
        );

        $instance = $this->container->get(DependencyInterface::class);

        $this->assertInstanceOf(Dependency::class, $instance);
    }

    /**
     * Method: set()
     * 
     * @return void
    */
    public function testSetRejectsInvalidBindingType(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->container->set('foo', 123);
    }

    /**
     * Method: resolve()
     * 
     * @return void
    */
    public function testResolveConstructorDependencies(): void
    {
        $this->container->set(DependencyInterface::class, new Dependency());

        $instance = $this->container->get(ServiceWithDependency::class);

        $this->assertInstanceOf(ServiceWithDependency::class, $instance);
        $this->assertInstanceOf(Dependency::class, $instance->dependency);
    }

    /**
     * Method: resolve()
     * 
     * @return void
    */
    public function testResolveThrowsWhenConstructorHasBuiltinParameter(): void
    {
        $this->expectException(\RuntimeException::class);

        $this->container->get(ServiceWithPrimitive::class);
    }

    /**
     * Method: resolve()
     * 
     * @return void
    */
    public function testResolveThrowsWhenAbstractClass(): void
    {
        $this->expectException(\LogicException::class);

        $this->container->get(AbstractService::class);
    }

    /**
     * Method: getReflection()
     * 
     * @return void
    */
    public function testGetReflectionThrowsWhenTargetDoesNotExist(): void
    {
        $this->expectException(\LogicException::class);

        $this->container->get('FakeClassThatNeverExists');
    }

    /**
     * Method: get() + getReflection()
     * 
     * @return void
    */
    public function testCanReflectExistingInterface(): void
    {
        $this->container->set(DependencyInterface::class, new Dependency());

        $instance = $this->container->get(DependencyInterface::class);

        $this->assertInstanceOf(Dependency::class, $instance);
    }
}
