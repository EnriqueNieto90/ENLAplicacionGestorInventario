import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                marca: {
                    50:  '#E1F5EE',
                    100: '#9FE1CB',
                    600: '#0F6E56',
                    700: '#0C5A47',
                    900: '#04342C',
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};
