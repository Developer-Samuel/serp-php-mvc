<?php

declare(strict_types=1);

namespace Tests\Unit\Foundation;

use PHPUnit\{
    Framework\Attributes\CoversClass,
    Framework\TestCase
};

use Tests\{
    Support\Providers\TestServiceProvider,
    Support\Workspace\RecursivelyRemovesDirectories
};

use App\Foundation\{
    Application,
    Container\Container
};

#[CoversClass(Application::class)]
final class ApplicationTest extends TestCase
{
    use RecursivelyRemovesDirectories;

    private string $tempDir;

    /**
     * @return void
    */
    protected function setUp(): void
    {
        parent::setUp();

        $this->initializeTempDirectory();
    }

    /**
     * @return void
    */
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->removeDirectory($this->tempDir);
    }

    /**
     * Method: getInstance()
     * 
     * @return void
    */
    public function testGetInstanceThrowsIfNotInitialized(): void
    {
        $this->expectException(\RuntimeException::class);

        $this->resetApplicationInstance();

        Application::getInstance();
    }

    /**
     * Method: getInstance()
     * 
     * @return void
    */
    public function testGetInstanceReturnsInitializedApplication(): void
    {
        $app = new Application($this->tempDir);

        self::assertSame($app, Application::getInstance());
    }

    /**
     * Method: getContainer()
     * 
     * @return void
    */
    public function testApplicationInitializesContainer(): void
    {
        $app = new Application($this->tempDir);

        self::assertInstanceOf(Container::class, $app->getContainer());
    }

    /**
     * Method: bootstrap()
     * 
     * @return void
    */
    public function testBootstrapLoadsProvidersFileIfExists(): void
    {
        $this->createProvidersFile([]);

        $app = new Application($this->tempDir);

        self::assertInstanceOf(Container::class, $app->getContainer());
    }

    /**
     * Method: registerServiceProviders()
     * 
     * @return void
    */
    public function testRegisterServiceProvidersCallsRegisterMethod(): void
    {
        TestServiceProvider::$called = false;

        $this->createProvidersFile([
            TestServiceProvider::class,
        ]);

        new Application($this->tempDir);

        self::assertTrue(TestServiceProvider::$called);
    }

    /**
     * Method: registerServiceProviders()
     * 
     * @return void
    */
    public function testRegisterServiceProvidersThrowsIfProviderClassDoesNotExist(): void
    {
        $this->createProvidersFile([
            'NonExistingProviderClass',
        ]);

        $this->expectException(\RuntimeException::class);

        new Application($this->tempDir);
    }

    /**
     * @return void
    */
    private function initializeTempDirectory(): void
    {
        $this->tempDir = sys_get_temp_dir() . '/app-test-' . uniqid();

        mkdir($this->tempDir, 0777, true);
    }

    /**
     * @param array<int, string> $providers
     * 
     * @return void
    */
    private function createProvidersFile(array $providers): void
    {
        $bootstrapDir = $this->createBootstrapDirectory();

        file_put_contents(
            $bootstrapDir . '/providers.php',
            '<?php return ' . var_export($providers, true) . ';'
        );
    }

    /**
     * @return string
    */
    private function createBootstrapDirectory(): string
    {
        $bootstrapDir = $this->tempDir . '/bootstrap';

        mkdir($bootstrapDir, 0777, true);

        return $bootstrapDir;
    }

    /**
     * @return void
    */
    private function resetApplicationInstance(): void
    {
        $reflection = new \ReflectionClass(Application::class);
        $property = $reflection->getProperty('instance');
        $property->setValue(null);
    }
}