module.exports = {
  purge: {
    enabled: process.env.NODE_ENV === 'production',
    content: [
      './resources/**/*.vue',
      './resources/**/*.php',
      './resources/**/*.blade',
      './resources/**/*.scss',
    ]
  },
  theme: {
    extend: {}
  },
  variants: {},
  plugins: []
}
