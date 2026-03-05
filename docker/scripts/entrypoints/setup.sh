#!/bin/bash
set -e

/usr/local/bin/scripts/bootstrap/check-composer.sh

echo "🔄 Preparing environment file (.env.example -> .env)"
/usr/local/bin/scripts/bootstrap/prepare-env.sh

echo "🔍 Checking node dependencies..."
/usr/local/bin/scripts/bootstrap/node-setup.sh

echo "🔍 Checking frontend build (npm run build)..."
/usr/local/bin/scripts/entrypoints/app/build.sh
