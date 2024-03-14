/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/**/*.{html,js,php}", "./public/**/*.{css,js}"],
  theme: {
    extend: {
      textColor: {
        primary: "#E48C44",
        secondary: "#FFC700",
        danger: "#e3342f",
      },
      borderColor: {
        primary: "#FFC700",
        secondary: "#1B2D44",
      },
      backgroundColor: {
        primary: "#14244B",
      },
      borderWidth: {
        3: "3px",
      },
    },
  },
  plugins: [],
  mode: "jit",
};
