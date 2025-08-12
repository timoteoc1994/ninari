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
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                impact: {
                    '0%': { opacity: 0, transform: 'scale(0.5) translateY(-50px)' },
                    '50%': { opacity: 0.7, transform: 'scale(1.2) translateY(10px)' },
                    '100%': { opacity: 1, transform: 'scale(1) translateY(0)' },
                },
                fadeInUp: {
                    '0%': { opacity: 0, transform: 'translateY(20px)' },
                    '100%': { opacity: 1, transform: 'translateY(0)' },
                },
                fadeZoom: {
                    '0%': { opacity: 0, transform: 'scale(0.8)' },
                    '100%': { opacity: 1, transform: 'scale(1)' },
                },
                
            },
            animation: {
                impact: 'impact 1s ease-out forwards',
                fadeInUp: 'fadeInUp 1s ease-out forwards',
                fadeZoom: 'fadeZoom 1s ease-out forwards',
            },
        },
    },

    plugins: [forms, typography],
};
