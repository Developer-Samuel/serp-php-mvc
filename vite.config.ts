import path from 'path';
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    vue(),
    tailwindcss()
  ],

  publicDir: false,

  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources'),
    },
  },

  build: {
    outDir: "public/build",
    manifest: true,
    emptyOutDir: true,
    rollupOptions: {
      input: {
        app: "resources/ts/app.ts"
      }
    }
  }
});