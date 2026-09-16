# PCP Validation Fixture

Dedicated **non-production** fixture for validating the Personal Coding Platform routine autonomous delivery path.

The repository intentionally contains no production data, external-service dependency, deployment logic, or secrets. Its implementation surface is deliberately small so PCP can exercise implementation, deterministic verification, PR/CI, review, and constrained PM merge without touching a real project.

## Structure

- `.ddev/config.yaml` — generic PHP DDEV environment.
- `web/modules/custom/pcp_validation` — Drupal-style custom-module surface.
- `tests/GreeterTest.php` — deterministic unit cases.
- `tools/check-style.php` — enforcing style checks.
- `tools/run-tests.php` — self-contained test runner.
- `.github/workflows/validation.yml` — pull-request CI for the same repository-level checks.

## Local verification

```bash
ddev start -y
ddev exec php tools/check-style.php
ddev exec sh -lc 'find web/modules/custom tests tools -type f -name "*.php" -print0 | xargs -0 -n1 php -l'
ddev exec php tools/run-tests.php
ddev stop --unlist --omit-snapshot
```

Every required command is enforcing; there is no `|| true` escape path.

## Intended routine validation task

The baseline implementation already falls back to `friend` for an empty/whitespace-only name, but the initial unit cases intentionally cover only a normal name and trimming surrounding whitespace. A suitable future PCP routine task is to add one missing regression case for whitespace-only input **without changing public behavior**.

All functional changes should use `ai/*` branches and pull requests to `main`.
