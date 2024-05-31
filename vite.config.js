import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  root: 'src', 
  plugins: [
    {
      name: 'custom-css-filename',
      enforce: 'post',
      generateBundle(options, bundle) {
        for (const fileName in bundle) {
          if (bundle[fileName].type === 'asset' && fileName.endsWith('.css')) {
            bundle[fileName].fileName = 'prod.css'; 
          }
        }
      },
    },
    {
      name: 'custom-js-filename',
      enforce: 'post',
      generateBundle(options, bundle) {
        for (const fileName in bundle) {
          if (bundle[fileName].type === 'chunk' && fileName.endsWith('.js')) {
            bundle[fileName].fileName = 'prod.js'; 
          }
        }
      },
    },
  ],
  css: {
    preprocessorOptions: {
      scss: {
        outputStyle: 'compressed'
      },
    },
  },
});
