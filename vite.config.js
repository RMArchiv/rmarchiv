import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import inject from "@rollup/plugin-inject";

export default defineConfig({
  plugins: [
    inject({
        $: 'jquery',
        jQuery: 'jquery',
        Bloodhound: 'bloodhound-js'
    }),
    laravel({
      input: [
        "resources/assets/sass/app.scss",
        "resources/assets/js/app.js",
        // "node_modules/typeahead.js/dist/bloodhound",
        "node_modules/bloodhound-js/dist/bloodhound.min.js",
        "node_modules/inline-attachment/src/inline-attachment",
        "node_modules/inline-attachment/src/jquery.inline-attachment",
        "node_modules/editor.md/editormd",
      ],
      refresh: true,
    }),
  ],
});
