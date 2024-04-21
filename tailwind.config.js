/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#2958a3',
        'primary-dark': '#1f427a',
        'accent': '#7fc270',
        'accent-dark': '#60b34d',
        'light': '#d6e2f5'
      },
      fontFamily: {
        'body': 'Poppins',
        'display': 'Exo'
      },
      typography: {
        DEFAULT: {
          css: {
            maxWidth: '85ch'
          }
        }
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography')
  ],
}

