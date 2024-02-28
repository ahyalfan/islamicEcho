import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode:"class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                proximanofa : ["proximanofa-black"],
                "proximanofa-light" : ["proximanofa-light"],

                // amiri
                amiri : ["amiri"],

                // amiri
                lalezar : ["lalezar"],

                // amiri
                lateef : ["lateef"],

            },
            colors: {
                'biru_background': "#ADD8E6", //ini bisa bebas mau pakai rbg,gradient pakai apapun bisa
                'biru_bacground2' : "#333333",
                'biru_font' : "#000080",
              },
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};
