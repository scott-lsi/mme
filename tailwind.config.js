const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        'text-3xl',
        'text-2xl',
        'flex',
        'flex-1',
        'flex-row',
        'flex-wrap',
        'max-h-full',,
        'bg-blue-600',
        'columns-lg',
        'columns-xl',
        'columns-2xl',
        'rounded-lg',
        'p-2',
        'pl-12',
        'px-8',
        'mb-2',
        'mb-4',
        'mx-auto',
        'list-disc',
        'md:mx-0',
        'md:columns-lg',
      ],

    theme: {
        
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                'pink': {
                    DEFAULT: '#EC008C',
                    50: '#FFA5DA',
                    100: '#FF90D2',
                    200: '#FF67C1',
                    300: '#FF3FB1',
                    400: '#FF16A0',
                    500: '#EC008C',
                    600: '#B4006B',
                    700: '#7C0049',
                    800: '#440028',
                    900: '#0C0007'
                  },
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
