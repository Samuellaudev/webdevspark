/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');

module.exports = {
  content: ['./*.php', './**/*.php'],
  theme: {
    extend: {
      colors: {
        primary: colors.orange,
        secondary: colors.green,
      },      
    },
  },
  plugins: [],
}

