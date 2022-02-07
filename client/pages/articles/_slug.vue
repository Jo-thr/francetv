<template>
  <div v-if="post && post.data">
    <Post v-if="post.version === 'v1'" :post="post" :fixed-podcast="fixedPodcast" />
    <PostV2 v-else-if="post.version === 'v2'" :post="post" :fixed-podcast="fixedPodcast" />
  </div>
</template>

<script>
import { createSEOMeta } from '~/utils/seo'
import Post from '~/components/content/Post.vue'
import PostV2 from '~/components/content/v2/Post.vue'

export default {
  name: 'Article',
  auth: false,
  components: {
    Post,
    PostV2,
  },
  async asyncData(context) {
    try {
      const post = await context.$axios.$get(
        `/posts/slug=${context.params.slug}`,
        {
          params: { lang: context.app.i18n.locale },
        }
      )

      context.store.dispatch('i18n/setRouteParams', {
        en: { slug: post.meta.slug.en },
        fr: { slug: post.meta.slug.fr },
      })

      return { post }
    } catch (error) {
      context.error({ statusCode: error.code, message: error.message })
    }
  },
  data() {
    return {
      fixedPodcast: true,
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const image = this.$config.IMAGES_DIRECTORY + this.post.data.featured
    const title = this.post.data.title
    const description = this.post.data.excerpt || ''

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
  beforeMount() {
    // eslint-disable-next-line no-console
    console.log("beforeMount")
    if (this.post.data.heading.id === 'podcasts') {
      window.addEventListener('scroll', this.handleScroll)
    }
  },
  beforeDestroy() {
    if (this.post.data.heading.id === 'podcasts') {
      window.removeEventListener('scroll', this.handleScroll)
    }
  },
  mounted() {
    // Add a specific class for youtube iframes
    if (
      this.post.data.content
      && document
        .getElementsByClassName('editor-js-content').length > 0
      && document
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

    if (this.post.data.heading.id === 'podcasts') {
      this.$wrapper.setTcVars({
        offre: 'lab',
        categorie: 'topic',
        sous_categorie: 'podcasts',
        nom_page: this.post.slug,
        langue: `[${this.$i18n.locale.toUpperCase()}]`,
      })
    } else {
      this.$wrapper.setTcVars({
        environnement: this.$config.LIVE_ENV,
        offre: 'lab',
        categorie: 'topic',
        sous_categorie: this.post.data.heading.id,
        rubrique: `article_${this.post.data.type}`,
        nom_page: this.post.slug,
        langue: `[${this.$i18n.locale.toUpperCase()}]`,
      })
    }

    this.$trackEvent('datalayer', window, { id: 'datalayer' })
  },
  methods: {
    handleScroll() {
      const contentFooter = document.getElementById('content_footer')

      if (
        contentFooter.getBoundingClientRect().bottom <
        (window.innerHeight || document.documentElement.clientHeight)
      ) {
        this.fixedPodcast = false
      } else {
        this.fixedPodcast = true
      }
    },
  },
  nuxtI18n: {
    paths: {
      en: '/posts/:slug',
      fr: '/articles/:slug',
    },
  },
}
</script>
