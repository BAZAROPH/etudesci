/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.{js,jsx,ts,tsx}",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'etudes-blue': '#143F7C',
                'etudes-orange': '#FF6F03',
            },
            fontFamily:{
                'roboto': ['"Roboto Mono"', 'sans-serif'],
                'rubik': ['"Rubik"', 'sans-serif'],
                'lobster': ['"Lobster"', 'sans-serif'],
                'fredoka-one': ['"Fredoka One"', 'sans-serif'],
                'lilita-one': ['"Lilita One"', 'sans-serif'],
                'eb-garamond': ['"EB Garamond"', 'sans-serif'],
                'bois': ['"Afolkalips"', 'sans-serif'],
            }
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
    ],
}
