  /** @type {import('tailwindcss').Config} */
  import colors from "tailwindcss/colors";

  module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    colors: {
      'blue': colors.blue,
      'purple': colors.purple,
      'pink': colors.pink,
      'red': colors.red,
      'teal': colors.teal,
      'cyan': colors.cyan,
      'orange': colors.orange,
      'green': colors.green,
      'yellow': colors.yellow,
      'gray': colors.gray,
      'slate': colors.slate,
      'fuchsia': colors.fuchsia,
      'gray-dark': '#273444',
      'gray-light': '#d3dce6',
      'white': '#ffffff',
      'black': '#000000',
      'primary-purple': '#573a74',
      'primary-pink': '#cb3a54',
      'primary-yellow': '#f4a838',
      'secondary-purple': '#bc80ff',
      'secondary-pink': '#ff7f95',
      'secondary-yellow': '#ffcc80',
    },
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
    },
    fontFamily: {
      sans: ['Graphik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
      title: ['magic_retro', 'serif']
    },
    extend: {
      spacing: {
        '8xl': '96rem',
        '9xl': '128rem',
      },
      borderRadius: {
        '4xl': '2rem',
      }
    }
  },
  plugins: [],
}

