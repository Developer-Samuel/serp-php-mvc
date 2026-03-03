<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Client\Serper\Mapper;

use PHPUnit\{
    Framework\Attributes\CoversClass,
    Framework\Attributes\DataProvider,
    Framework\TestCase
};

use App\Infrastructure\Client\Serper\Mapper\SerperResponseMapper;

#[CoversClass(SerperResponseMapper::class)]
class SerperResponseMapperTest extends TestCase
{
    /**
     * Method: extract()
     * 
     * @param array<string, mixed> $input
     * @param array<string, mixed> $expected
     * 
     * @return void
    */
    #[DataProvider('provideScenarios')]
    public function testExtractScenarios(array $input, array $expected): void
    {
        $mapper = new SerperResponseMapper();

        $this->assertSame($expected, $mapper->extract($input));
    }

    /**
     * @return array<int, array{
     *     array<string, mixed>,
     *     array<string, mixed>
     * }>
     * 
     * @throws \RuntimeException
    */
    public static function provideScenarios(): array
    {
        $path = dirname(__DIR__, 5) . '/Support/Data/Client/Serper/serper_scenarios.json';

        $content = file_get_contents($path);
        if ($content === false) {
            throw new \RuntimeException('Cannot load scenarios file');
        }

        /**
         * @var array<int, array{
         *     input: array<string, mixed>,
         *     expected: array<string, mixed>
         * }> $scenarios
        */
        $scenarios = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        return array_map(
            static fn(array $scenario): array => [
                $scenario['input'],
                $scenario['expected'],
            ],
            $scenarios
        );
    }
}