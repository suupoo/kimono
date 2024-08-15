/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/preline/dist/*.js"
  ],
  theme: {
    extend: {
        fontFamily : {
          "noto-jp":"Noto Sans JP"
        },
        backgroundColor: {
            custom:{
                'green' : "#00A86B",
                'red' : "#FF0000",
                'blue' : '#1E90FF',
                'gray' : '#6B7280',
                'light-gray' : '#F3F4F6',
            }
        },
        textColor: {
            custom:{
                'green' : "#00A86B",
                'red' : "#FF0000",
                'blue' : '#1E90FF',
                'gray' : '#6B7280',
                'light-gray' : '#F3F4F6',
            }
        },
    },
  },
  plugins: [
      require('preline/plugin'),
      require('@tailwindcss/forms'),
  ],
}

