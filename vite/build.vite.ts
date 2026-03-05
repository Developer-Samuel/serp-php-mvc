// 📄 vite/build.vite.ts

export default {
  build: {
    outDir: 'public/build',
    manifest: true,
    emptyOutDir: true,
    rollupOptions: {
      input: ['resources/ts/app.ts'],
    },
  },
};
