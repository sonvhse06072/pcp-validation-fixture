<?php
declare(strict_types=1);

$roots = [
    __DIR__ . '/../web',
    __DIR__ . '/../tests',
    __DIR__,
];

$files = [];

foreach ($roots as $root) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
    );

    foreach ($iterator as $file) {
        if (!$file->isFile() || $file->getExtension() !== 'php') {
            continue;
        }

        $files[$file->getRealPath()] = $file->getRealPath();
    }
}

ksort($files);
$failures = 0;

foreach ($files as $path) {
    $content = file_get_contents($path);

    if ($content === false) {
        fwrite(STDERR, "FAIL unreadable file: {$path}\n");
        ++$failures;
        continue;
    }

    if (!str_starts_with($content, "<?php\ndeclare(strict_types=1);\n")) {
        fwrite(STDERR, "FAIL strict_types header: {$path}\n");
        ++$failures;
    }

    if (str_contains($content, "\t")) {
        fwrite(STDERR, "FAIL tab character: {$path}\n");
        ++$failures;
    }

    foreach (preg_split('/\R/', $content) ?: [] as $lineNumber => $line) {
        if (preg_match('/[ \t]+$/', $line) === 1) {
            fwrite(
                STDERR,
                sprintf("FAIL trailing whitespace: %s:%d\n", $path, $lineNumber + 1),
            );
            ++$failures;
        }
    }
}

if ($files === []) {
    fwrite(STDERR, "FAIL no PHP files found\n");
    exit(1);
}

if ($failures > 0) {
    fwrite(STDERR, sprintf("STYLE RESULT %d failure(s)\n", $failures));
    exit(1);
}

fwrite(STDOUT, sprintf("STYLE RESULT %d files passed\n", count($files)));
