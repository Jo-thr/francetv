<template>
  <article class="container">
    <!-- Banner -->
    <ContentBanner :post="test" class="mb-12" @shared="shared()" />

    <!-- Content -->
    <div class="px-4 desktop:px-24">
      <!-- Test info -->
      <ContentTestInformations :test="test" />

      <!-- Excerpt -->
      <p
        v-if="test.data.excerpt"
        class="font-bold text-mobile-quote tablet:text-desktop-quote mb-8 tablet:mb-12"
      >
        {{ test.data.excerpt }}
      </p>

      <!-- editor-js -->
      <div
        v-if="test.data.content"
        v-viewer
        class="editor-js-content"
        v-html="test.data.content"
      ></div>

      <!-- iFrame -->
      <ContentTestIframe v-if="test.data.iframe" :test="test" />

      <!-- Feedback -->
      <div
        v-if="isLoggedIn && triggerUsabilla"
        class="bg-blue-light text-center py-12 px-4 mt-12"
      >
        <h3 class="mb-2">{{ $t('tests.feedback.titre') }}</h3>
        <p class="mb-6 max-w-xl mx-auto">
          {{ $t('tests.feedback.description') }}
        </p>
        <Button @click.native="usabilla($event, 'manual')">{{
          $t('tests.feedback.bouton')
        }}</Button>
      </div>

      <!-- Vote -->
      <p v-if="isLoggedIn" class="mt-12 mx-auto text-center max-w-sm">
        {{ $t('tests.donner_avis_voter[0]') }}
        <button
          :disabled="hasAlreadyVoted"
          class="underline text-blue"
          :class="{ 'cursor-not-allowed text-gray-dark': hasAlreadyVoted }"
          @click="voted($event)"
        >
          {{ $t('tests.donner_avis_voter[1]') }}
        </button>
      </p>

      <!-- Footer -->
      <ContentFooter class="mt-16" :post="test" @shared="shared()" />
    </div>
  </article>
</template>

<script>
import { createSEOMeta } from '~/utils/seo'

export default {
  name: 'Tests',
  auth: false,
  async asyncData(context) {
    try {
      const test = await context.$axios.$get(
        `/tests/slug=${context.params.slug}`,
        {
          params: { lang: context.app.i18n.locale },
        }
      )

      context.store.dispatch('i18n/setRouteParams', {
        en: { slug: test.meta.slug.en },
        fr: { slug: test.meta.slug.fr },
      })
      return { test }
    } catch (error) {
      context.error({ statusCode: error.code, message: error.message })
    }
  },
  data() {
    return {
      hasAlreadyVoted: false,
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const image = this.$config.IMAGES_DIRECTORY + this.test.data.featured
    const title = this.test.data.title
    const description = this.test.data.excerpt || ''

    return {
      title: `${title} - France tv lab`,
      description,
      meta: createSEOMeta({
        title,
        description,
        image,
        url,
        type: 'article',
      }),
      script: [
        {
          src: 'https://platform.twitter.com/widgets.js',
          async: true,
          charset: 'utf-8',
        },
        {
          src: 'https://www.instagram.com/embed.js',
          async: true,
        },
        {
          src: 'https://www.tiktok.com/embed.js',
          async: true,
        },
      ],
    }
  },
  computed: {
    isLoggedIn() {
      return this.$store.state.auth.loggedIn
    },
    triggerUsabilla() {
      if (this.$device.isMobileOrTablet) {
        return !!this.test.usabilla.mobile_trigger
      } else {
        return !!this.test.usabilla.desktop_trigger
      }
    },
  },
  watch: {
    isLoggedIn() {
      this.init()
    },
  },
  mounted() {
    if (this.test.usabilla.time) {
      setTimeout(this.usabilla, this.test.usabilla.time * 1000)
    }

    this.$wrapper.setTcVars({
      environnement: this.$config.LIVE_ENV,
      offre: 'lab',
      categorie: 'topic',
      sous_categorie: 'tests',
      nom_page: this.test.data.slug,
      langue: `[${this.$i18n.locale.toUpperCase()}]`,
    })

    this.$trackEvent('datalayer', window, { id: 'datalayer' })

    // Add a specific class for youtube iframes
    if (
      this.test.data.content &&
      document
        .getElementsByClassName('editor-js-content')[0]
        .getElementsByTagName('iframe').length > 0
    ) {
      for (let i = 0; i < document.getElementsByTagName('iframe').length; i++) {
        const iframe = document.getElementsByTagName('iframe')[i]
        if (iframe.src.includes('youtube')) {
          const container = iframe.closest('div.iframe-container')
          container.classList.add('youtube')
        }
      }
    }

    this.init()
  },

  methods: {
    init() {
      this.hasTheUserAlreadyVoted()
      this.tested()
    },
    usabilla(e, from) {
      if (window.usabilla_live && this.isLoggedIn) {
        if (this.$device.isMobileOrTablet) {
          window.usabilla_live('trigger', this.test.usabilla.mobile_trigger)
        } else {
          window.usabilla_live('trigger', this.test.usabilla.desktop_trigger)
        }
      }
      if (from === 'manual') {
        this.$trackEvent('click', e.target, {
          event_chapter1: 'tester',
          event_chapter2: 'usabilla_manuel',
          event_name: this.test.data.slug,
        })
      }
    },
    voted(e) {
      if (this.isLoggedIn && !this.hasAlreadyVoted) {
        this.$trackEvent('click', e.target, {
          event_chapter1: 'tester',
          event_chapter2: 'vote',
          event_name: this.test.data.slug,
        })
        this.$axios({
          method: 'post',
          url: `/tests/${this.test.id}/votes`,
          data: {
            token: this.$store.state.auth.user.id,
          },
        }).then(() => {
          this.hasAlreadyVoted = true
          this.test.data.votes = this.test.data.votes + 1
        })
      }
    },
    shared() {
      this.$axios.patch(`/tests/${this.test.id}/share`)
      this.test.data.shares = this.test.data.shares + 1
    },
    tested() {
      if (this.isLoggedIn) {
        this.$axios({
          method: 'patch',
          url: `/tests/${this.test.id}/tested`,
          data: {
            token: this.$store.state.auth.user.id,
          },
        }).then(() => {
          this.test.data.tested = this.test.data.tested + 1
        })
      }
    },
    hasTheUserAlreadyVoted() {
      if (this.isLoggedIn) {
        this.$axios
          .$get(
            `/tests/${this.test.id}/votes/${this.$store.state.auth.user.id}`
          )
          .then((res) => {
            this.hasAlreadyVoted = res
          })
      }
    },
  },
}
</script>
