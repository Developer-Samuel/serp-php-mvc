# 📦 Development

This document contains **Docker / Makefile** commands used when working with the project.

---

## 1. Local Development

```bash
# Local development server
composer serve

# Frontend development (live server)
composer dev

# Frontend build
composer build
```

## 2. Docker & Makefile Development

### First time setup

```bash
# Using Docker (loads DB and initial data)
docker compose --profile setup up

# Using Makefile
make setup-up
```

### Subsequent starts

```bash
# Using Docker
docker compose up

# Using Makefile
make up
```

The following commands cover common `Docker and Makefile` workflows used during development.

---

#### 🚀 Core Commands

```bash
# Start all services in foreground
make up
# or
docker compose up

# Start all services in background (detached)
make up-detached
# or
docker compose up -d

# Stop all services
make down
# or
docker compose down

# Stop and clean all services including volumes and orphan containers
make down-clean
# or
docker compose down --volumes --remove-orphans

# Clean ALL containers and images (⚠️ destructive!)
make clean-all
# or
docker ps -q | xargs -r docker stop
docker ps -aq | xargs -r docker rm -f
docker images -aq | xargs -r docker rmi -f

# Build/rebuild images
make build
# or
docker compose build

# Force recreate all services detached (stop old, remove conflicts)
make force
# or
docker compose up -d --force-recreate

# Force rebuild all images and recreate all services
make build-force
# or
docker compose build
docker compose up -d --force-recreate

# Build/rebuild all Docker images without using cache
make build-cache
# or
docker compose build --no-cache

# Restart all services (clean + up detached)
make restart
# or
docker compose down --volumes --remove-orphans
docker compose up
```

#### 🛠️ Setup Commands

```bash
# Build and start setup containers (first time or Dockerfile changes)
make setup-build
# or
docker compose --profile setup up --build

# Start setup containers without rebuilding
make setup-up
# or
docker compose --profile setup up

# Clean and rebuild setup containers (with cache)
make setup-restart-build
# or
docker compose down --volumes --remove-orphans
docker compose --profile setup up --build

# Clean and rebuild setup containers (without cache)
make setup-restart-build-without-cache
# or
docker compose down --volumes --remove-orphans
docker compose build --no-cache
docker compose --profile setup up --build

# Restart setup containers (clean + start without rebuild)
make setup-restart
# or
docker compose down --volumes --remove-orphans
docker compose --profile setup up
```

#### 💻 Development Commands

```bash
# Start dev profile services in foreground
make dev
# or
docker compose --profile dev up

# Start dev profile services detached
make dev-detached
# or
docker compose --profile dev up -d
```

#### 🔍 Utility Commands

```bash
# Show logs of all services
make logs
# or
docker compose logs -f
```

---

✅ This `DEVELOPMENT.md` serves as a quick reference for common development **Docker / Makefile** commands.

- Always start with `composer install` and `npm install`.
- Use Makefile or Docker commands for consistent, reproducible environments and easy setup.
