# PCP Validation Fixture ProjectBaseline

Baseline revision `validation-v3-2026-11-25-local-core`.
The Human Owner approved the successor scope in [PCP #835](https://github.com/sonvhse06072/personal-coding-platform/issues/835#issuecomment-7161923539).
The predecessor `validation-v2-2026-09-16-r3` remains pinned to `6395655ec311692493d9e93c2573b1bd946c7331`.
This successor starts from the verified fixture state `3ecd9ce66260245089efe2533080d1b5191b810c`.

This document is the source-of-truth frame for the dedicated non-production `pcp-validation-fixture` project used by the Personal Coding Platform operational-validation path.

## Goals

- Provide a small, deterministic, GitHub-backed non-production repository for exercising the PCP routine delivery path end to end.
- Validate bounded implementation, deterministic verification, proportional review, pull-request CI, constrained PM merge, telemetry, and continuity without touching a real production project.
- Exercise one deployed Local Core plan with three to five useful, dependency-linked WorkOrders on the existing WSL host.
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
- Improve the existing test runner so zero executed cases or failed cases produce a nonzero exit. Preserve all existing Greeter cases, including the mixed-whitespace regression from R3.
- Provide a reusable local HTTP readiness check and accessible preview for the existing fixture. Preserve the root greeting and its plain-text response. Keep readiness and preview self-contained, independent of credentials and external network calls.
- Add deterministic HTTP coverage that exercises the actual endpoint and detects readiness and preview regressions. Verify the preview is usable by keyboard and has meaningful document structure and text.
- Limit routine delivery to fixture PHP entry points under `web/`, tests under `tests/`, the existing checks under `tools/`, and relevant usage corrections in `README.md`.

## Architecture constraints

- Keep the current generic PHP 8.3-compatible codebase and DDEV environment.
- Keep the Drupal-style module surface under `web/modules/custom/pcp_validation`.
- Keep checks self-contained and repository-local; do not add external runtime services or dependency-resolution requirements.
- Preserve `main` as the base branch for delivery.
- Preserve the GitHub workflow, DDEV project configuration, and existing Runtime, Router and Executor permission boundaries.

## Quality policy

- Local and PCP verification must enforce:
  1. style via `php tools/check-style.php`;
  2. PHP syntax across `web`, `tests`, and `tools`;
  3. full self-contained tests via `php tools/run-tests.php`.
- Pull-request CI must continue to run equivalent style, syntax, and full-test gates on PHP 8.3.
- Deterministic checks are authoritative for acceptance; model output alone is never sufficient.
- By plan completion, the full-test gate must detect an empty suite and fail on an HTTP readiness or preview regression. Keep each WorkOrder's verification usable in DDEV and the existing GitHub workflow.
- Each accepted WorkOrder must produce a real non-empty diff. Verify exact PR head, executed CI, required independent review, eligible PM merge, and dependency continuation from the verified merge.

## Security policy

- The fixture contains no production data, credentials, secrets, or external-service dependency.
- No production deployment capability is part of this project.
- Developer/model processes must not receive PCP control-plane, Runtime, executor, GitHub-delivery, or unrelated provider credentials through fixture content.
- Any task that would introduce or modify a security boundary is outside this baseline and requires a new Human Owner-approved project decision.
- If the governed Developer tool is used, its existing single project-scoped check surface and fixed phases apply. Preserve the manifest, sandbox, lease, Executor admission and positive and negative custody evidence.

## Budget policy

- Treat fixture work as routine personal-scale validation work.
- New PM-generated WorkOrders should use adaptive budget semantics so healthy routine progress does not create avoidable Human Owner continuation prompts.
- Resource use must remain bounded by PCP's approved personal resource envelope and circuit breakers.
- Material expansion of resource limits, provider policy, or Human Owner attention requirements is outside this baseline.
- The existing [PCP #835 authorization](https://github.com/sonvhse06072/personal-coding-platform/issues/835#issuecomment-7161923539) permits one fresh WSL acceptance window of at most 7,200 seconds. Source and image verification, capacity admission, independent watchdog, and scoped rollback and closure precede or guard live execution per the existing operating contract.

## Roadmap frame

1. Review and deliver the successor baseline. Register its exact verified fixture commit in PCP and preserve all earlier registered revisions.
2. Verify deployed source, fixture repository readiness, quiescence, duplicate prevention, credential isolation, and baseline checks before admitting the authorized window.
3. Send one fixture improvement request through ordinary PCP intake. The PM plans and critiques three to five useful dependency-linked WorkOrders for fail-closed testing, local readiness and accessible preview, and regression verification. Launch each order through the existing Router and Runtime.
4. Carry the same job through development, deterministic verification, independent review, PR, exact-head fixture CI, eligible PM merge, and next-ready reconciliation. Preserve durable job, source, diff, lease, and counters across any permitted recovery. Verify both bounded same-job recovery and refusal using the existing authorized mechanisms.
5. Capture actual WorkOrder, PR, CI, merge, recovery and next-ready evidence, along with cost, resource and Human Owner attention telemetry. Complete exact-owned closure and record Local Core acceptance evidence in PCP #593 and #835.

Any work outside this frame requires a new baseline revision or another applicable Human Owner-approved decision before execution.
