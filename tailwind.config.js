/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.{blade.php,js,jsx,ts,tsx}",
    "./resources/views/**/*.{blade.php,jsx,js}",
    "./resources/js/**/*.{js,jsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FF6B35',
        'primary-dark': '#E85A2A',
        'primary-light': '#FF8C5A',
        secondary: '#FFE66D',
        'secondary-dark': '#FFD93D',
        accent: '#6BCB77',
        success: '#4AFF6A',
        warning: '#FFD93D',
        danger: '#FF6B6B',
      },
      fontFamily: {
        sans: ['Poppins', 'Inter', 'system-ui', 'sans-serif'],
      },
    },
  },
  darkMode: 'class',
  plugins: [],
}
