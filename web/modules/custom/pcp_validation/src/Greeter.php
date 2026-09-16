<?php
declare(strict_types=1);

namespace PCP\Validation;

final class Greeter
{
    public function greet(string $name): string
    {
        $normalized = trim($name);

        return sprintf(
            'Hello, %s!',
            $normalized === '' ? 'friend' : $normalized,
        );
    }
}
