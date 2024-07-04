/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
        fontFamily : {
          "noto-jp":"Noto Sans JP"
        },
        backgroundColor: {
            custom:{
                'green' : "#00A86B",
            }
        },
        textColor: {
            custom:{
                'green' : "#00A86B",
            }
        },
    },
  },
  plugins: [
      require('flowbite/plugin')
  ],
}

