# ⚙️ SETUP.md

Minimal setup guide for **environment variables and runtime configuration**.

**Source of truth:**
- `.env.example`

---

## 1. Preparation

Before configuring environment variables, make sure the project dependencies are installed.

Complete **steps 1 and 2** from [INSTALL.md](INSTALL.md):

---

## 2. Environment Variables

All environment variables and configuration options are documented inline in:

`.env.example`

Copy it first:

```bash
cp .env.example .env
```

#### Core Configuration:

- **Serper API**

  `SERPER_API_KEY` (required)
  Must be set to authenticate API requests.

  `SERPER_API_URL` (Optional)
  API endpoint used for search requests.
  Change this if you want to use a different endpoint or custom API provider.

If these values are not configured correctly in `.env`, the application will not be able to communicate with the Serper API.

⚠️ Never modify `.env.example` directly — it serves only as a template.

---

> ⚠️ Final note
- This document is solely for **setting up environment variables and runtime configuration**.
- All variable documentation must live as inline comments inside
  `.env.example`.
