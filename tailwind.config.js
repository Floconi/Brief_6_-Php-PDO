/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./code/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        'vert_clair': '#32ce9a',
      },
    },
    fontFamily:{
      'PE_nunito': ['nunito_regular','ui-sans-serif'],
      'PE_nunito_italique' : ['nunito_italic','ui-sans-serif'],
      'PE_libre_baskerville_gras' :['libre_baskerville_bold','ui-sans-serif'],
      'PE_libre_baskerville_italique' : ['libre_baskerville_italic','ui-sans-serif'],
      'PE_libre_baskerville' : ['libre_baskerville_regular','ui-sans-serif']
    },
  },
  plugins: [],
}

