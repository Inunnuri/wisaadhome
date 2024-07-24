import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "localhost",
        port: 5174,
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    build: {
        outDir: "public/build",
        manifest: true,
    },
});
