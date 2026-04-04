import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/assets/sass/app.scss",
        "resources/assets/js/app.js",
        "resources/assets/js/ckeditorSetup.js",
        "resources/assets/js/cheatsheet.js",
        "resources/assets/js/chart.js",
      ],
      refresh: true,
    }),
  ],
  css: {
    preprocessorOptions: {
        scss: {
          silenceDeprecations: [
            'import',
            'mixed-decls',
            'color-functions',
            'global-builtin',
            'legacy-js-api',
          ],
        },
    },
  },
  build: {
    sourcemap: false,
  },
});
