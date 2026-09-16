# PCP Validation Fixture ProjectBaseline

Baseline revision: `validation-v2-2026-09-16-r3`
Status: Human Owner approved on 2026-09-17 under PCP #199.

This document is the source-of-truth frame for the dedicated non-production `pcp-validation-fixture` project used by the Personal Coding Platform operational-validation path.

## Goals

- Provide a small, deterministic, GitHub-backed non-production repository for exercising the PCP routine delivery path end to end.
- Validate bounded implementation, deterministic verification, proportional review, pull-request CI, constrained PM merge, telemetry, and continuity without touching a real production project.
- Keep the fixture simple enough that validation failures can be attributed to PCP behavior rather than application complexity.

## Non-goals

- Production use, production deployment, production writes, or production data.
- Authentication, authorization, secret-management, security-boundary, architecture, migration, or infrastructure experimentation.
- Adding external services, network dependencies, Composer/Packagist dependencies, or other major dependencies.
- Expanding the fixture into a general application or benchmark suite.
- Weakening verification merely to make an operational proof pass.

## Requirements

- Preserve the existing generic PHP DDEV project and Drupal-style custom-module layout.
- Keep the implementation surface deterministic and self-contained.
- All functional changes must use `ai/*` branches and pull requests to `main`.
- Required verification must remain enforcing and must not use `|| true` escape paths.
- PCP routine validation work must remain non-security, non-architecture, non-dependency, non-migration, non-production, and independently verifiable.
- The currently approved immediate routine task is test-only: add one mixed whitespace-only Greeter regression case containing spaces/tabs/newlines and prove it returns the already-supported `Hello, friend!` result without changing public behavior.

## Architecture constraints

- Keep the current generic PHP 8.3-compatible codebase and DDEV environment.
- Keep the Drupal-style module surface under `web/modules/custom/pcp_validation`.
- Keep checks self-contained and repository-local; do not add external runtime services or dependency-resolution requirements.
- Preserve `main` as the base branch for delivery.

## Quality policy

- Local and PCP verification must enforce:
  1. style via `php tools/check-style.php`;
  2. PHP syntax across `web`, `tests`, and `tools`;
  3. full self-contained tests via `php tools/run-tests.php`.
- Pull-request CI must continue to run equivalent style, syntax, and full-test gates on PHP 8.3.
- Deterministic checks are authoritative for acceptance; model output alone is never sufficient.
- A validation change must produce a real non-empty diff and preserve existing public behavior unless a separately approved baseline revision says otherwise.

## Security policy

- The fixture contains no production data, credentials, secrets, or external-service dependency.
- No production deployment capability is part of this project.
- Developer/model processes must not receive PCP control-plane, Runtime, executor, GitHub-delivery, or unrelated provider credentials through fixture content.
- Any task that would introduce or modify a security boundary is outside this baseline and requires a new Human Owner-approved project decision.

## Budget policy

- Treat fixture work as routine personal-scale validation work.
- New PM-generated WorkOrders should use adaptive budget semantics so healthy routine progress does not create avoidable Human Owner continuation prompts.
- Resource use must remain bounded by PCP's approved personal resource envelope and circuit breakers.
- Material expansion of resource limits, provider policy, or Human Owner attention requirements is outside this baseline.

## Roadmap frame

1. Treat the completed R2 merge commit `c91666947dce59fc12d263da99597875eb561798` as the pre-refresh fixture application state; R2 remains defect-discovery/recovery evidence rather than the final clean zero-intervention proof.
2. Register this approved ProjectBaseline revision in PCP pinned to the exact fixture commit containing this document.
3. Re-run fresh idle, duplicate, repository-readiness, credential-boundary, and deterministic baseline gates before operational validation.
4. Create exactly one legitimate plan through PCP `POST /v1/plans` for `pcp-validation-fixture#7`: add one mixed whitespace-only Greeter regression case in `tests/GreeterTest.php` without changing implementation behavior.
5. Let PCP proceed through implementation, layered deterministic verification, proportional review, PR/CI, and constrained PM merge without manual branch/PR/merge intervention or delivery recovery.
6. Capture telemetry, Human-attention, delivery-retry, PM-merge audit, and continuity evidence for PCP issues #162 and #146.

Any work outside this frame requires a new baseline revision or another applicable Human Owner-approved decision before execution.
