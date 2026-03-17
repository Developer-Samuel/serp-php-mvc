#!/bin/bash
set -e

echo "🛠️ Creating required directories..."
mkdir -p /var/www/storage/logs

echo "🔧 Setting permissions for directories..."
chmod 775 /var/www/storage/logs

echo "📄 Creating log file if missing..."
if [ ! -f /var/www/storage/logs/app.log ]; then
  touch /var/www/storage/logs/app.log
  echo "📝 Created empty app.log file"
fi
chmod 664 /var/www/storage/logs/app.log

# 📢 Hot reload file
[ -f /var/www/public/hot ] && chown www-data:www-data /var/www/public/hot

# 📦 Frontend build assets directory
[ -d /var/www/public/build ] && chown -R www-data:www-data /var/www/public/build

# 📦 Node-related files
[ -f /var/www/package-lock.json ] && chown www-data:www-data /var/www/package-lock.json
[ -d /var/www/node_modules ] && chown -R www-data:www-data /var/www/node_modules

echo "✅ Permissions and logging setup complete."
