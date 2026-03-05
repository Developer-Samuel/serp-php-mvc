#!/bin/bash
set -e
export DEBIAN_FRONTEND=noninteractive

echo "🔧 Updating packages and installing core dependencies..."
apt-get update -y

apt-get install -y --no-install-recommends \
    curl \
    git \

apt-get clean

echo "✅ Core dependencies installed."