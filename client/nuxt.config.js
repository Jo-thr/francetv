import { createSEOMeta } from './utils/seo'
import { fetchSitemapRoutes } from './utils/sitemap'

const isDev = () => process.env.NODE_ENV === 'development'

export default async () => {
  const routes = await fetchSitemapRoutes()

  return {
    /*
     ** Nuxt rendering mode
     ** See https://nuxtjs.org/api/configuration-mode
     */
    // mode: 'universal',
    /*
     ** Nuxt target
     ** See https://nuxtjs.org/api/configuration-target
     */
    target: 'server',

    /*
     ** Headers of the page
     ** See https://nuxtjs.org/api/configuration-head
     */
    head: {
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { name: 'version', content: process.env.BUILD },
        ...createSEOMeta({}),
      ],
      link: [],
      script: [
        { innerHTML: 'window.tc_vars = {}' },
        {
          src: process.env.TAG_COMMANDER_CONTAINER_URL,
          body: false,
        },
      ],
    },
    /*
     ** Global CSS
     */
    css: [
      '@/assets/css/app.scss'
    ],
    /*
     ** Plugins to load before mounting the App
     ** https://nuxtjs.org/guide/plugins
     */
    plugins: [
      '~plugins/vee-validate.js',
      '~plugins/usabilla.client.js',
      '~plugins/consent.client.js',
      '~plugins/vue-tag-commander.client.js',
      '~/plugins/v-viewer.client.js',
      '~/plugins/datepicker.client.js',
    ],

    robots:
      process.env.LIVE_ENV !== 'production'
        ? {
            UserAgent: '*',
            Disallow: '/',
          }
        : {},

    /*
     ** Auto import components
     ** See https://nuxtjs.org/api/configuration-components
     */
    components: true,
    /*
     ** Nuxt.js dev-modules
     */
    buildModules: [
      // Doc: https://github.com/nuxt-community/eslint-module
      '@nuxtjs/eslint-module',
      // https://go.nuxtjs.dev/stylelint
      '@nuxtjs/stylelint-module',
      // Doc: https://github.com/nuxt-community/nuxt-tailwindcss
      '@nuxtjs/tailwindcss',
      // Doc: https://github.com/nuxt-community/dotenv-module
      '@nuxtjs/dotenv',
      // Doc: https://github.com/nuxt-community/analytics-module
      '@nuxtjs/google-analytics',
      // Doc: https://html-validator.nuxtjs.org
      // '@nuxtjs/html-validator',
      // Doc: https://github.com/nuxt-community/svg-module
      '@nuxtjs/svg',
      // Doc: https://pwa.nuxtjs.org/
      '@nuxtjs/pwa',
    ],
     /*
     ** Nuxt.js modules
     */
    modules: [
      // Doc: https://github.com/nuxt-community/device-module
      '@nuxtjs/device',
      // Doc: https://axios.nuxtjs.org/usage
      '@nuxtjs/axios',
      // Doc: https://github.com/lewyuburi/nuxt-validate
      ['@mole-inc/nuxt-validate', { nuxti18n: true }],

      // Doc: https://github.com/nuxt-community/i18n-module
      'nuxt-i18n',
      // Doc: https://github.com/nuxt-community/sitemap-module
      '@nuxtjs/sitemap',
      // Doc: https://auth.nuxtjs.org
      '@nuxtjs/auth',
      // Doc: https://github.com/nicolasbeauvais/vue-social-sharing
      'vue-social-sharing/nuxt',
      // Doc: https://github.com/nuxt-community/dayjs-module
      '@nuxtjs/dayjs',
      // Doc: https://github.com/nuxt-community/recaptcha-module
      '@nuxtjs/recaptcha',

      '@nuxtjs/proxy',

      '@nuxtjs/robots',

      [
        'nuxt-mq',
        {
          // Default breakpoint for SSR
          defaultBreakpoint: 'mobile',
          breakpoints: {
            mobile: 768,
            tablet: 1024,
            desktop: Infinity,
          },
        },
      ],
    ],
    proxy: {
      '/api/': {
        target: `${process.env.GIN_PROXY_ENDPOINT}`,
        pathRewrite: { '^/api/': '' },
      },
    },
    /*
     ** Axios module configuration
     ** See https://axios.nuxtjs.org/options
     */
    axios: {
      baseURL: process.env.BASE_URL,
    },
    /*
     ** Auth module configuration
     ** See https://auth.nuxtjs.org/
     */
    auth: {
      redirect: false,
      strategies: {
        gin: {
          _scheme: '~/utils/auth/ginProxy',
          cookie: false,
          endpoints: {
            login: {
              url: `${process.env.HOST_NAME}/api/v3/${process.env.GIN_APP}/user/login`,
              method: 'post',
            },
            user: {
              url: `${process.env.HOST_NAME}/api/v3/${process.env.GIN_APP}/user/get-info`,
              method: 'get',
            },
            logout: {
              url: `${process.env.HOST_NAME}/api/v3/${process.env.GIN_APP}/user/logout`,
              method: 'get',
            },
          },
          autoFetchUser: true,
          headers: {
            app: process.env.GIN_APP,
            contentType: 'application/json',
            hmacKey: process.env.GIN_HMAC,
            xsource: process.env.GIN_X_SOURCE,
            xuser: process.env.GIN_X_USER,
          },
        },
      },
      plugins: ['~/plugins/auth.client.js'],
    },
    /*
     ** Storybook module configuration
     ** See https://storybook.nuxtjs.org/options
     */
    storybook: {
      addons: [
        '@storybook/addon-backgrounds',
        '@storybook/addon-viewport',
        '@storybook/addon-controls',
      ],
    },
    /*
     ** i18n module configuration
     ** See https://i18n.nuxtjs.org/
     */
    i18n: {
      defaultLocale: 'fr',
      locales: [
        {
          code: 'en',
          iso: 'en-US',
          file: 'en-US.js',
          name: 'English',
        },
        {
          code: 'fr',
          iso: 'fr-FR',
          file: 'fr-FR.js',
          name: 'Français',
        },
      ],
      lazy: true,
      langDir: 'lang/',
    },
    /*
     ** Google Analytics module configuration
     ** See https://github.com/nuxt-community/analytics-module
     */
    googleAnalytics: {
      id: 'UA-178289804-2', // Used as fallback if no runtime config is provided
      disabled: true,
      debug: {
        sendHitTask: true,
      },
    },
    /*
     ** dayjs module configuration
     ** See https://github.com/nuxt-community/dayjs-module
     */
    dayjs: {
      locales: ['en', 'fr'],
      defaultLocale: 'fr',
      plugins: ['relativeTime', 'localizedFormat'],
    },
    /*
     ** Sitemap module configuration
     ** See https://github.com/nuxt-community/sitemap-module#readme
     */
    sitemap: {
      hostname: process.env.HOST_NAME,
      routes,
      gzip: true,
      cacheTime: 1000 * 60 * 3600,
      defaults: {
        changefreq: 'daily',
        priority: 1,
        lastmod: new Date(),
      },
    },
    /*
     ** reCAPTCHA module configuration
     ** See https://github.com/nuxt-community/sitemap-module#readme
     */
    recaptcha: {
      hideBadge: false, // Hide badge element (v3 & v2 via size=invisible)
      language: 'English', // Recaptcha language (v2)
      siteKey: '6Ld2pNQZAAAAAEkbI6SNYthg6E_ezRZYn0XPMmAO', // Site key for requests
      version: 2, // Version
      size: 'normal', // Size: 'compact', 'normal', 'invisible' (v2)
    },
    pwa: {
      manifest: {
        name: 'France tv lab',
        short_name: 'ftv lab',
        lang: 'fr',
        useWebmanifestExtension: false,
      },
      workbox: false,
      oneSignal: false,
    },
    /*
     ** Tailwind configuration
     ** See https://tailwindcss.nuxtjs.org/options
     */
    tailwindcss: {
      cssPath: '~/assets/css/tailwind.css',
      configPath: 'tailwind.config.js',
    },
    /*
     ** Build configuration
     ** See https://nuxtjs.org/api/configuration-build/
     */
    build: {
      transpile: ['@nuxtjs/auth', 'vue-tag-commander'],
      // Postcss config : https://id.nuxtjs.org/faq/postcss-plugins/
      postcss: {},
      standalone: true,
      cache: isDev(),
      parallel: isDev(),
      devtools: isDev(),
    },
    /*
     ** Router configuration
     ** See https://nuxtjs.org/guides/configuration-glossary/configuration-router
     */
    router: {
      middleware: ['auth', 'vue-tag-commander'],
      linkPrefetchedClass: 'nuxt-link-prefetched',
    },
    /*
     ** Runtime configuration
     ** See https://nuxtjs.org/guide/runtime-config
     */
    publicRuntimeConfig: {
      USABILLA_ID: process.env.USABILLA_ID,
      HOST_NAME: process.env.HOST_NAME,
      CAPTCHA_SITE_KEY: process.env.CAPTCHA_SITE_KEY,
      IMAGES_DIRECTORY: process.env.IMAGES_DIRECTORY,
      LIVE_ENV: process.env.ENV || 'local',
      googleAnalytics: {
        id: process.env.GOOGLE_ANALYTICS_ID,
      },
      gin: {
        app: process.env.GIN_APP,
        endpoint: `${process.env.HOST_NAME}/api`,
        hmacKey: process.env.GIN_HMAC,
        xsource: process.env.GIN_X_SOURCE,
        xuser: process.env.GIN_X_USER,
      },
    },
  }
}
