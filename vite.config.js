import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  root: 'src', // Aktualizacja ścieżki do głównego katalogu projektu
  plugins: [],
  css: {
    preprocessorOptions: {
      scss: {
        // Możesz dodać tutaj opcje kompilatora Sass
        outputStyle: 'compressed'
      },
    },
  },
});
