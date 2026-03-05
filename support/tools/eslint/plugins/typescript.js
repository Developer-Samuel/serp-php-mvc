// 🧰 support/tools/eslint/plugins/typescript.js

import globals from 'globals';
import tseslint from 'typescript-eslint';
import prettierPlugin from 'eslint-plugin-prettier';

import { TYPESCRIPT_FILES } from '../constants/files.js';

export const typescriptPlugin = {
  files: TYPESCRIPT_FILES,

  languageOptions: {
    parser: tseslint.parser,
    globals: {
      ...globals.browser,
    },
  },

  plugins: {
    '@typescript-eslint': tseslint.plugin,
    prettier: prettierPlugin,
  },

  rules: {
    'prettier/prettier': 'error',

    '@typescript-eslint/no-unused-vars': ['error', { argsIgnorePattern: '^_' }],

    '@typescript-eslint/no-unused-expressions': [
      'error',
      {
        allowShortCircuit: true,
        allowTernary: true,
      },
    ],
  },
};
