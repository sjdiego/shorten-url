module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    container: (theme) => ({
      center: true,
      padding: theme("spacing.4"),
    }),
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
