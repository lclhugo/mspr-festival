/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  lightMode: 'class',
  plugins: [
    require('flowbite/plugin')
  ],
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
}

