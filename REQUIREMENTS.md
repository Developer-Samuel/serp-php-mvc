# 🔒 Project Requirements

**Purpose:** Minimum requirements for development, testing, and optional `Docker` services.

---

## 1. Mandatory Requirements

- **PHP** 8.2 +
- **Composer** for dependency management
- **Node.js** (LTS) + **npm** for frontend build tooling (Vite with JavaScript & TypeScript support)
- **Git** version control
- **Web server** (choose at least one)
  - Nginx (recommended)
  - Apache
- **Internet access** for external API communication [serper.dev](https://serper.dev/)

> ⚠️ At least one web server is required for the application to function.

---

## 2. Optional Requirements (Recommended)

These improve developer experience, monitoring, or enable optional features. Not required for core application functionality:

- **Docker** for containerized environment
- **WSL 2** strongly recommended for **Windows users** to run Docker and Linux-based tools (Ubuntu) with native performance.
- **Make** (GNU Make) required to run project commands
- **Xdebug** for debugging and PHPUnit test coverage

---

## 3. Notes

- `Docker` is optional; all services can run locally if preferred
- Optional services improve developer experience but are not required to run the app
