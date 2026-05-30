/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        // Couleurs de la marque (inspirées de tes boutons et menus)
        primary: {
          DEFAULT: '#8B5A2B', // Le marron/camel des boutons "Ajouter"
          hover: '#6E4823',
          light: '#D4A373',
        },
        sidebar: '#FAF8F5', // Beige très clair pour le menu latéral
        background: '#F3F4F6', // Gris très léger pour le fond principal
        surface: '#FFFFFF', // Blanc pour les cartes
        
        // Couleurs des statuts (Pastel UI)
        status: {
          green: { bg: '#D1FAE5', text: '#065F46' }, // Opérationnel
          red: { bg: '#FEE2E2', text: '#991B1B' },   // En panne
          orange: { bg: '#FEF3C7', text: '#92400E' } // En maintenance
        }
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
      }
    },
  },
  plugins: [],
}