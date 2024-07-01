/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js}"],
  theme: {
    extend: {
      fontFamily: {
        guntur: ["Hind Guntur"],
        publicSans: ["Public sans"],
        roboto: ["Roboto"],
      },
      colors: {
        biruTua: "#191d88",
        biruMuda: "#1450a3",
        kuning: "#ffc436",
        putih: "#F9F9F9",
      },
    },
  },
  plugins: [],
};
