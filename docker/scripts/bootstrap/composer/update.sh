#!/bin/bash
set -e

# 📥 Run composer update if 'vendor' folder doesn't exist or is empty
if [ ! -d "vendor" ] || [ -z "$(ls -A vendor)" ]; then
  echo "📦 Updating Composer dependencies (composer.json) ==="
  composer update
else
  echo "✅ The 'vendor' folder exists, I'm skipping updating Composer dependencies."
fi