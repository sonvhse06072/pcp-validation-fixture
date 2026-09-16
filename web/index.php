<?php
declare(strict_types=1);

require __DIR__ . '/modules/custom/pcp_validation/src/Greeter.php';

use PCP\Validation\Greeter;

header('Content-Type: text/plain; charset=UTF-8');
echo (new Greeter())->greet('PCP Validation Fixture');
