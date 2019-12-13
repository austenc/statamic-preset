let defaultConfig = require('tailwindcss/defaultConfig')

module.exports = {
  theme: {
    container: {
      center: true,
    },
    colors: {
      ...defaultConfig.theme.colors,
      primary: defaultConfig.theme.colors.indigo,
    },
  },
}
