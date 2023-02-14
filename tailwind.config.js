/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
    colors: {
        laravel: '#42992e',
        er: '#f03e4d',
    },
},
  },
  plugins: [],
}
 