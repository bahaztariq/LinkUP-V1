import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                "primary": "#135bec",
                "background-light": "#f6f6f8",
                "background-dark": "#0B0E14",
                "surface-dark": "#161B22",
                "border-dark": "#324467",
            },
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'sans-serif', ...defaultTheme.fontFamily.sans],
                display: ['Plus Jakarta Sans', 'sans-serif'],
            },
            borderRadius: {
                "lg": "0.5rem",
                "xl": "0.75rem",
            },
        },
    },

    plugins: [forms, typography],
};
