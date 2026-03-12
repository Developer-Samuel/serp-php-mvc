# SERP PHP - Layered MVC Architecture

A lightweight PHP application built with a layered architecture approach that follows MVC principles and clean separation of concerns.

It integrates with the Serper API to execute Google search queries, retrieve the first 10 results, and allows exporting the data as:

- 📦 JSON
- 📄 XML

---

## 🧱 Architecture

### Layer Responsibilities

- **Foundation** - Core system utilities, base abstractions, helpers.
- **Infrastructure** - External integrations (API client, Logging).
- **Application** - Application logic including HTTP controllers, request handling, business rules.
- **Providers** - Service registration layer responsible for binding interfaces to implementations, configuring dependencies, and bootstrapping infrastructure and application services into the container.

---

## 🚀 Features

### Backend

- ✅ Vanilla PHP
- ✅ Layered MVC-based architecture
- ✅ Serper API integration - [serper.dev](https://serper.dev)
- ✅ Structured logging with custom logger implementation
- ✅ Fetch top 10 search results
- ✅ Export results as JSON
- ✅ Export results as XML
- ✅ Environment configuration

### Testing & Static Analysis

- ✅ PHPUnit for Unit & Integration testing
- ✅ Code coverage reporting
- ✅ Static analysis with PHPStan (Level 10)
- ✅ Automated code refactoring with Rector

### CI/CD & DevOps

- ✅ GitHub Actions CI/CD pipeline
- ✅ Automated testing on push & pull requests
- ✅ Dockerized development environment
- ✅ Pre-configured development scripts

### Frontend Layer

- ✅ Vue.js
- ✅ TypeScript
- ✅ TailwindCSS
- ✅ Inertia.js (SPA-style frontend via backend routing)
- ✅ ESLint for code quality
- ✅ Prettier for consistent formatting

---

## 📚 Documentation

- 📋 Requirements → [REQUIREMENTS.md](REQUIREMENTS.md)
- ⚙ Installation → [INSTALL.md](INSTALL.md)
- 🔧 Environment Setup → [SETUP.md](SETUP.md)
- 🛠 Development → [DEVELOPMENT.md](DEVELOPMENT.md)
- 📢 Project Information → [SOCIAL.md](SOCIAL.md)

---

## ⚡ Quick Start

Clone the repository:

```bash
git clone https://github.com/Developer-Samuel/serp-php-mvc.git
cd serp-php-mvc
