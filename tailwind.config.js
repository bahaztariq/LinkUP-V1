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

    theme: {
        extend: {
            colors: {
                "primary": "#135bec",
                "background-light": "#f6f6f8",
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
