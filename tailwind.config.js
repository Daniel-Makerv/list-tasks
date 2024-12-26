import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const flowbitePlugin = require('flowbite/plugin');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js", // Incluye los archivos de Flowbite

    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    darkMode: false, // Asegúrate de desactivar explícitamente el modo oscuro

    plugins: [
        forms,
        flowbitePlugin({
            charts: true, // Configuración adicional para el plugin de Flowbite
        }),
    ],
};
