#!/bin/bash
set -e

if [ ! -f .env ]; then
  cp .env.example .env
  echo "✅ Environment file prepared successfully."
else
  echo "⚠️ .env file already exists, skipping preparation."
fi
