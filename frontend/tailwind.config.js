/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      './components/**/*.{vue,js,ts}',
      './layouts/**/*.vue',
      './pages/**/*.vue',
      './composables/**/*.{js,ts}',
      './plugins/**/*.{js,ts}',
      './app.{js,ts,vue}'
    ],
    theme: {
        extend: {
          colors: {
            "bg-color": "#FDFAF3",
            "overlay": "#E0D6C3",
            "overlay-text": "#FDFAF3",
            "button": "#846E82"
          },
          fontFamily: {
            neucha: ["Neucha-Regular", "sans-serif"],
            chen: ["ChenYuluoyan-Thin-Monospaced", "sans-serif"],
            shu: ["chinese-fzstk", "sans-serif"],
          },
        },
      },
    plugins: [],
    css: [
        './public/assets/css/tailwind.css',
    ],
  }