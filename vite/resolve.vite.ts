// 📄 vite/resolve.vite.ts

import path from 'path';

export default {
  resolve: {
    alias: {
      '@': path.resolve(__dirname, '../resources'),
    },
  },
};
