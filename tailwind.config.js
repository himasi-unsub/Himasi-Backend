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
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f0f4ff',
                    100: '#e0e7ff',
                    500: '#667eea',
                    600: '#5a67d8',
                    700: '#4c51bf'
                },
                accent: {
                    500: '#ff6b6b',
                    600: '#ee5a24'
                }
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                'fade-in-up-delay-1': 'fadeInUp 0.6s ease-out 0.2s forwards',
                'fade-in-up-delay-2': 'fadeInUp 0.6s ease-out 0.4s forwards',
            },
        },
    },

    plugins: [
		forms,
		typography,
		require("daisyui")
	],
};
