<template>
  <div v-if="!$fetchState.pending" class="container px-4 tablet:px-0 pt-16">
    <transition
      name="fade"
      enter-active-class="animate__animated animate__fadeIn"
    >
      <!-- Results -->
      <div v-if="posts.length > 0" key="1">
        <!-- Query -->
        <Title
          v-if="$route.query.query"
          :title="$route.query.query"
          class="text-center mb-4"
        />
        <p class="text-gray-dark mb-12 text-center">
          {{ $t('recherche.description') }}
        </p>

        <div class="flex flex-wrap">
          <CardWrapper
            :posts="posts"
            :from-search-query="$route.query.query"
            class="tablet:-mx-2"
            :posts-page="postsPage"
            @display-more="loadMorePosts()"
          />
        </div>
      </div>

      <!-- No result -->
      <div v-if="posts.length === 0" key="2" class="text-center">
        <p class="text-mobile-regular tablet:text-desktop-regular font-bold">
          {{ $t('recherche.aucun-resultat') }}
        </p>

        <NuxtLink
          :to="localePath('/')"
          class="mt-12 inline-block rounded-button hover:bg-blue hover:border-blue transition-all duration-500 text-black border-black hover:text-white text-common-body-ftv px-5 py-2 border-2"
          >{{ $t('erreurs.retour-accueil') }}</NuxtLink
        >
      </div>
    </transition>
  </div>
</template>

<script>
import { createSEOMeta } from '~/utils/seo'

export default {
  name: 'Search',
  auth: false,
  validate({ query }) {
    if (query.query) {
      return true
    } else {
      return false
    }
  },
  data() {
    return {
      posts: [],
      postsPage: null,
      fromServerSide: false,
    }
  },
  async fetch() {
    await this.getPosts(1)

    if (process.server) {
      this.fromServerSide = true
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const title =
      this.$i18n.t('seo.meta.recherche.titre') + this.$route.query.query
    const description = this.$i18n.t('recherche.description')
    const image = this.$config.HOST_NAME + '/social_image.png'

    return {
      title: `${title} - France tv lab`,
      meta: createSEOMeta({ title, description, url, image }),
    }
  },
  watch: {
    '$route.query'() {
      this.$fetch()
      this.posts = []
    },
    '$fetchState.pending'() {
      if (this.$fetchState.pending === false) {
        this.trackPage()
      }
    },
  },
  deactivated() {
    this.$destroy()
  },
  mounted() {
    if (this.fromServerSide) {
      this.trackPage()
    }
  },
  methods: {
    async getPosts(requestedPage) {
      try {
        const search = await this.$axios.$get('/search', {
          params: {
            lang: this.$i18n.locale,
            page: requestedPage,
            q: this.$route.query.query.split(' ').join('+'),
          },
          query: {},
        })
        search.data.forEach((element) => {
          this.posts.push(element)
        })
        this.postsPage = search.meta
      } catch (err) {
        throw new Error(err.message)
      }
    },
    loadMorePosts() {
      if (this.postsPage.current_page <= this.postsPage.last_page) {
        this.getPosts(this.postsPage.current_page + 1)
      }
    },
    trackPage() {
      if (this.$route.query.query.length > 0) {
        this.$wrapper.setTcVars({
          offre: 'lab',
          categorie: 'recherche',
          nom_page: 'recherche',
          langue: `[${this.$i18n.locale.toUpperCase()}]`,
        })
      }
      if (this.posts.length > 0) {
        this.$wrapper.setTcVars({
          environnement: this.$config.LIVE_ENV,
          offre: 'lab',
          categorie: 'recherche',
          nom_page: 'resultat',
          langue: `[${this.$i18n.locale.toUpperCase()}]`,
          keyword_moteur_interne: this.$route.query.query,
        })
      } else {
        this.$wrapper.setTcVars({
          environnement: this.$config.LIVE_ENV,
          offre: 'lab',
          categorie: 'recherche',
          nom_page: 'pas_de_resultat',
          numero_page_resultats: 0,
          langue: `[${this.$i18n.locale.toUpperCase()}]`,
          keyword_moteur_interne: this.$route.query.query,
        })
      }
      this.$trackEvent('datalayer', window, { id: 'datalayer' })
    },
  },
  nuxtI18n: {
    paths: {
      en: '/search',
      fr: '/recherche',
    },
  },
}
</script>
