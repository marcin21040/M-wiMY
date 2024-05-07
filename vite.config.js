import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  root: 'src', // Aktualizacja ścieżki do głównego katalogu projektu
  plugins: [
    {
      name: 'custom-css-filename',
      enforce: 'post',
      generateBundle(options, bundle) {
        for (const fileName in bundle) {
          if (bundle[fileName].type === 'asset' && fileName.endsWith('.css')) {
            bundle[fileName].fileName = 'prod.css'; // Tutaj możesz ustawić niestandardową nazwę pliku CSS
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
            bundle[fileName].fileName = 'prod.js'; // Tutaj możesz ustawić niestandardową nazwę pliku JS
          }
        }
      },
    },
  ],
  css: {
    preprocessorOptions: {
      scss: {
        // Możesz dodać tutaj opcje kompilatora Sass
        outputStyle: 'compressed'
      },
    },
  },
});
