// 📄 vite/build.vite.ts

export default {
  build: {
    outDir: 'public/build',
    manifest: true,
    emptyOutDir: true,
    rollupOptions: {
      input: ['assets/ts/app.ts'],
    },
  },
};
