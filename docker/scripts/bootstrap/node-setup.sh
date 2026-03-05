#!/bin/bash
set -e

cd /var/www

if [ ! -d "node_modules" ] || [ -z "$(ls -A node_modules)" ]; then
  echo "⬇️ Dependencies not found or empty, running 'npm install' to install packages..."
  npm install -g npm@latest
  echo "✅ npm install finished."

  echo "⬇️ Installing Vite..."
  npm install vite --save-dev
  echo "✅ npm install vite finished."
else
  echo "⚙️ Dependencies found, running 'npm update' to ensure packages are up to date..."
  npm update
  echo "✅ node_modules exists, updated with npm update."
fi
