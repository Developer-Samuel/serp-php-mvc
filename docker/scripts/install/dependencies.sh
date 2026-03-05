#!/bin/bash
set -e

export DEBIAN_FRONTEND=noninteractive

echo "🟢 Installing core dependencies..."
bash "$(dirname "$0")/tasks/core-dependencies.sh"

echo "🟢 Setting up Node.js..."
bash "$(dirname "$0")/tasks/node.sh"

echo "🧹 Cleaning up..."
rm -rf /var/lib/apt/lists/*
