<?php

declare(strict_types=1);

namespace App\Infrastructure\Client\Serper\Mapper;

/**
 * @phpstan-type OrganicItem array{
 *     title: string,
 *     link: string,
 *     description: string
 * }
*/
final class SerperResponseMapper
{
    /**
     * @param array<string, mixed> $data
     * 
     * @return array<int, OrganicItem>
    */
    public function extract(array $data): array
    {
        $extracted = [];

        $extracted = [
            ...$this->mapKnowledgeGraph($data),
            ...$this->mapOrganic($data),
        ];

        return $this->normalize($extracted);
    }

    /**
     * @param array<string, mixed> $data
     * 
     * @return array<int, OrganicItem>
    */
    private function mapKnowledgeGraph(array $data): array
    {
        if (!isset($data['knowledgeGraph'])) {
            return [];
        }

        $knowledgeGraph = (array) $data['knowledgeGraph'];

        return [[
            'title' => $this->safeString($knowledgeGraph, 'title', 'N/A'),
            'link' => $this->safeStringMultiple($knowledgeGraph, ['website', 'descriptionUrl'], ''),
            'description' => $this->safeString($knowledgeGraph, 'description', ''),
        ]];
    }

    /**
     * @param array<string, mixed> $data
     * 
     * @return array<int, OrganicItem>
    */
    private function mapOrganic(array $data): array
    {
        if (!isset($data['organic']) || !is_array($data['organic'])) {
            return [];
        }

        $results = [];

        foreach ($data['organic'] as $row) {
            if (!is_array($row)) {
                continue;
            }

            $results[] = [
                'title' => $this->safeString($row, 'title', 'No Title'),
                'link' => $this->safeString($row, 'link', '#'),
                'description' => $this->safeString($row, 'snippet', ''),
            ];
        }

        return $results;
    }

    /**
     * @param array<int, OrganicItem> $items
     * 
     * @return array<int, OrganicItem>
    */
    private function normalize(array $items): array
    {
        return array_map(
            static fn(array $item): array => [
                'title' => trim(htmlspecialchars_decode($item['title'], ENT_QUOTES)),
                'link' => trim($item['link']),
                'description' => trim(htmlspecialchars_decode($item['description'], ENT_QUOTES)),
            ],
            $items
        );
    }

    /**
     * @param array<mixed> $source
     * @param string $key
     * @param string $default
     * 
     * @return string
    */
    private function safeString(array $source, string $key, string $default): string
    {
        $value = $source[$key] ?? null;

        return is_string($value) ? $value : $default;
    }

    /**
     * @param array<mixed> $source
     * @param array<int, string> $keys
     * @param string $default
     * 
     * @return string
    */
    private function safeStringMultiple(array $source, array $keys, string $default): string
    {
        foreach ($keys as $key) {
            $value = $source[$key] ?? null;
            if (is_string($value)) {
                return $value;
            }
        }

        return $default;
    }
}