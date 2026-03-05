#!/bin/bash
set -e

if [ -f public/hot ] && ! docker ps --filter "name=serp_php_mvc_vite" --filter "status=running" | grep -q serp_php_mvc_vite; then
  echo "🧹 Removing public/hot because vite container is not running..."
  rm public/hot
fi

echo "⚙️ Building assets..."
npm run build
echo "✅ Assets built."
