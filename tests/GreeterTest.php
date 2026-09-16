<?php
declare(strict_types=1);

namespace PCP\Validation\Tests;

final class GreeterTest
{
    /**
     * @return array<string, array{input: string, expected: string}>
     */
    public static function cases(): array
    {
        return [
            'basic name' => [
                'input' => 'Ada',
                'expected' => 'Hello, Ada!',
            ],
            'trims surrounding whitespace' => [
                'input' => '  Grace  ',
                'expected' => 'Hello, Grace!',
            ],
        ];
    }
}
