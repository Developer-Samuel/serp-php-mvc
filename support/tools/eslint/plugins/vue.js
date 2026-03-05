// 🧰 support/tools/eslint/plugins/vue.js

import vue from 'eslint-plugin-vue';
import vueParser from 'vue-eslint-parser';
import tseslint from 'typescript-eslint';
import { VUE_FILES } from '../constants/files.js';

export const vuePlugin = {
  files: VUE_FILES,

  languageOptions: {
    parser: vueParser,
    parserOptions: {
      parser: tseslint.parser,
      ecmaVersion: 'latest',
      sourceType: 'module',
      extraFileExtensions: ['.vue'],
    },
  },

  plugins: {
    vue,
    '@typescript-eslint': tseslint.plugin,
  },

  rules: {
    ...vue.configs['flat/recommended'].rules,

    'vue/max-attributes-per-line': 'off',
    'vue/html-closing-bracket-newline': 'off',
    'vue/html-indent': 'off',
    'vue/html-self-closing': 'off',
    'vue/singleline-html-element-content-newline': 'off',
    'vue/multiline-html-element-content-newline': 'off',
  },
};
