<?php
declare(strict_types=1);

require __DIR__ . '/../web/modules/custom/pcp_validation/src/Greeter.php';
require __DIR__ . '/../tests/GreeterTest.php';

use PCP\Validation\Greeter;
use PCP\Validation\Tests\GreeterTest;

$greeter = new Greeter();
$failures = 0;
$total = 0;

foreach (GreeterTest::cases() as $name => $case) {
    ++$total;
    $actual = $greeter->greet($case['input']);

    if ($actual !== $case['expected']) {
        ++$failures;
        fwrite(
            STDERR,
            sprintf(
                "FAIL %s: expected %s, got %s\n",
                $name,
                var_export($case['expected'], true),
                var_export($actual, true),
            ),
        );
        continue;
    }

    fwrite(STDOUT, sprintf("PASS %s\n", $name));
}

fwrite(STDOUT, sprintf("RESULT %d passed, %d failed\n", $total - $failures, $failures));

exit($failures === 0 ? 0 : 1);
