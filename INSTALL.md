# 📦 Install

This file describes the **installation steps** on a fresh checkout.

---

## 1. Install PHP dependencies (Composer)

```bash
composer install
```

- `composer install` installs exact versions from `composer.lock` to ensure reproducibility.
- Dependency updates are handled separately as part of maintenance.

---

## 2. Install JavaScript dependencies (npm)

```bash
npm install
```

- Use `npm install` for a fresh checkout.
- Dependency updates are intentionally excluded from installation steps.

---

## 3. Next Steps

✅ After installing project dependencies, continue with the environment configuration.

See: [SETUP.md](SETUP.md)

The setup guide covers:

- environment configuration
- required services
- project initialization

---

✅ Once the environment is configured, proceed with the development workflow.

See: [DEVELOPMENT.md](DEVELOPMENT.md)
