const {
  height
} = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    './public/**/*.html',
    './src/**/*.vue',
  ],
  theme: {
    extend: {
      height: {
        ...height,
        '18': '4.5rem',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}