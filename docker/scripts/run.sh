#!/bin/bash
set -e

if [ "$1" = "setup" ]; then
    exec /usr/local/bin/scripts/entrypoints/setup.sh
fi

/usr/local/bin/scripts/entrypoints/server/start.sh
