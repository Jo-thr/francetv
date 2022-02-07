module.exports = {
  purge: [
    './components/**/*.{vue,js}',
    './layouts/**/*.vue',
    './pages/**/*.vue',
    './plugins/**/*.{js,ts}',
    './nuxt.config.{js,ts}',
  ],
  theme: {
    extend: {
      // Colors
      colors: {
        dark: '#232323',

        'blue-dark': '#0017A6',
        blue: '#0023FF',
        'blue-light': '#90CEFF',

        pink: '#FF778B',

        green: '#7DFFCE',

        yellow: '#FCFC00',

        'gray-darker': '#48484D',
        'gray-dark': '#5F7081',
        gray: '#ABBAC7',
        'gray-light': '#E3E6EC',
        'gray-lighter': '#F3F5F8',

        // Button
        'btn-disabled': '#C8CACE',

        placeholder: '#C4C4C4',

        red: '#E61E00',
      },

      // Border Radius
      borderRadius: {
        button: '1.5rem',
      },

      // Border Width
      borderWidth: {
        3: '3px',
      },

      // Inset
      inset: {
        '-24': '-24px',
        4: '4px',
        10: '10px',
        14: '14px',
        24: '24px',
        25: '25px',
        32: '32px',
        34: '34px',
        40: '40px',
        50: '50px',
        96: '96px',
      },

      // Spacing
      spacing: {
        27: '6.875rem', // 110px
        52: '13rem',
        80: '20rem',
        96: '23rem',
        120: '30rem',
        160: '40rem',
        176: '44rem',
        200: '50rem',
        '80p': '80%',
        '33v': '33vh',
        '50v': '50vh',
        '66v': '66vh',
        '75v': '75vh',
      },

      maxHeight: {
        96: '24rem',
        120: '32rem',
      },

      height: {
        120: '32rem'
      },

      maxWidth: {
        '100vw': '100vw'
      },

      width: {
        '6/5': '120%',
      },

      scale: {
        mirror: '-1',
      }
    },

    container: {
      center: true,
    },

    // Font Size
    // name: [fontSize, lineHeight],
    fontSize: {
      'header-h1': ['4.5625rem', '2.4375rem'],
      'header-h2': ['2rem', '2.125rem'],

      'desktop-h1': ['2rem', '2.4375rem'],
      'desktop-h2': ['1.75rem', '2.125rem'],
      'desktop-h3': ['1.5rem', '1.8125rem'],
      'desktop-h4': ['1.25rem', '1.5rem'],
      'desktop-h5': ['1.125', '1.375rem'],
      'desktop-quote': ['1.3125rem', '1.8125rem'],
      'desktop-paragraph': ['1.125rem', '1.333rem'],
      'desktop-regular': ['1rem', '1.8125rem'],

      'mobile-h1': ['1.75rem', '2.125rem'],
      'mobile-h2': ['1.5rem', '1.8125rem'],
      'mobile-h3': ['1.25rem', '1.5rem'],
      'mobile-h4': ['1.0625rem', '1.3125rem'],
      'mobile-h5': ['0.875rem', '1.0625rem'],
      'mobile-quote': ['1rem', '1.375rem'],
      'mobile-regular': ['0.875rem', '1.375rem'],

      'common-regular': ['1rem', '1.1875rem'],
      'common-tag': ['0.875rem', '1.0625rem'],
      'common-legend': ['0.75rem', '0.9375rem'],
    },

    // Font Family
    fontFamily: {
      ftv: ['France TV Brown', 'Arial', 'sans-serif'],
    },

    // Breakpoints
    screens: {
      mobile: { max: '768px' },
      tablet: '768px',
      // => @media (min-width: 768px) { ... }

      desktop: '1024px',
      // => @media (min-width: 1024px) { ... }
    },

    customForms: (theme) => ({
      default: {
        'input, textarea, multiselect, select': {
          backgroundColor: theme('colors.transparent'),
          borderColor: theme('colors.gray'),
          borderWidth: '1px',
          borderRadius: undefined,
          color: theme('colors.dark'),
          padding: `${theme('spacing.3')} ${theme('spacing.4')}`,
          width: theme('width.full'),
          marginBottom: `${theme('spacing.4')}`,
          placeholderColor: theme('colors.gray'),
          resize: 'none',
          '&:focus': {
            borderColor: theme('colors.blue'),
            boxShadow: undefined,
          },
          '&::placeholder': {
            color: theme('colors.gray-dark'),
          },
        },
      },
    }),
  },
  variants: {
    opacity: ['responsive', 'hover', 'focus', 'disabled'],
    cursor: ['responsive', 'disabled', 'hover'],
    pointerEvents: ['responsive', 'disabled'],
    textColor: ['responsive', 'hover', 'focus', 'disabled'],
    backgroundColor: ['active', 'responsive', 'hover', 'focus', 'disabled'],
    fontWeight: ['hover', 'focus'],
    textDecoration: ['hover', 'focus'],
    scale: ['hover', 'focus'],
    inset: ['responsive'],
  },
  plugins: [require('@tailwindcss/custom-forms')],
  experimental: {
    applyComplexClasses: true,
  },
}
