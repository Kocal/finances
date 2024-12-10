#!/usr/bin/env bash
# This file can be used to execute "php" command (via symfony cli) in api directory from any path.
# With it you can easily run PHPUnit through PHPStorm, just declare a new CLI Interpreter.

set -euo pipefail

ROOT_PATH=$(set -e && cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)

cd "${ROOT_PATH}/.." && symfony php "$@"
