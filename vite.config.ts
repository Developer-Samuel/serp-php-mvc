// 📄 vite.config.ts

import { defineConfig } from "vite";

import plugins from "./vite/plugins.vite";
import resolve from "./vite/resolve.vite";
import build from "./vite/build.vite";

export default defineConfig({
  publicDir: false,

  plugins,
  ...resolve,
  ...build
});