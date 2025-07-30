import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        // "node_modules/typeahead.js/dist/bloodhound",
        // "node_modules/typeahead.js/dist/typeahead.jquery.js",
        // "node_modules/bloodhound-js/dist/bloodhound.min.js",
        // "node_modules/editor.md/editormd",
        // 'node_modules/inline-attachment/src/inline-attachment.js',
        // 'node_modules/inline-attachment/src/jquery.inline-attachment.js',
        // 'node_modules/editor.md/editormd.js',
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
