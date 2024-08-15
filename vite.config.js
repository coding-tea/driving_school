import {defineConfig} from "vite";
import laravel from "laravel-vite-plugin";
import {glob} from "glob";
import path from "node:path";
import {fileURLToPath} from "node:url";

let sass = Object.fromEntries(
    glob
        .sync("resources/sass/pages/**/*.scss")
        .map((file) => [
            path.relative(
                "resources/sass/pages",
                file.slice(0, file.length - path.extname(file).length)
            ),
            fileURLToPath(new URL(file, import.meta.url)),
        ])
);
sass = Object.values(sass);

let js = Object.fromEntries(
    glob
        .sync("resources/js/pages/**/*.js")
        .map((file) => [
            path.relative(
                "resources/js/pages",
                file.slice(0, file.length - path.extname(file).length)
            ),
            fileURLToPath(new URL(file, import.meta.url)),
        ])
);
js = Object.values(js);

let input = [sass, js];
input = [].concat(...input);
input.push('resources/js/app.js')
input.push('resources/css/app.css')
console.log(input)
export default defineConfig({
    plugins: [
        laravel({
            input,
            refresh: true,
        }),
    ],
});
