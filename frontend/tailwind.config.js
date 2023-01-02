const {
  boxShadow
} = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    './public/**/*.html',
    './src/**/*.vue',
  ],
  theme: {
    extend: {
      boxShadow: {
        ...boxShadow,
        'card': '2px -3px 17px rgba(72, 98, 124, 0.26)',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}