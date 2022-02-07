<template>
  <div>
    <!-- Banner -->
    <TopicBanner
      v-if="layout.description && layout.title"
      class="pt-12 pb-24"
      :title="layout.title"
      :description="layout.description"
      :background="layout.background"
      :underline="layout.underline"
      :text-black="layout.font_black"
    />

    <!-- MEA -->
    <div
      class="container px-4 tablet:px-0"
      :class="{ 'desktop:-mt-12': layout.primary || layout.secondary }"
    >
      <HighlightWrapper
        v-if="layout.primary || layout.secondary"
        :layout="layout"
      />

      <!-- List of tests -->
      <CardTestsWrapper
        v-if="$route.params.slug === 'tests'"
        :open-tests-page="postsPage"
        :open-tests="posts"
        :layout="layout"
        @display-more="loadMorePosts()"
      />

      <!-- Default list of posts -->
      <CardWrapper
        v-if="posts.length > 0 && $route.params.slug !== 'tests'"
        :posts="posts"
        :posts-page="postsPage"
        class="-mx-2"
        @display-more="loadMorePosts()"
      />
    </div>
  </div>
</template>

<script>
import { createSEOMeta } from '~/utils/seo'

export default {
  name: 'TopicIndex',
  auth: false,
  async asyncData(context) {
    let validateSlugTopic = true
    let topic = null
    let layout = null

    // Get topic
    if (
      context.params.slug !== 'meta-media' &&
      context.params.slug !== 'tests'
    ) {
      try {
        topic = await context.$axios.$get(
          `/headings/slug=${context.params.slug}`,
          {
            params: { lang: context.app.i18n.locale },
          }
        )
      } catch (err) {
        validateSlugTopic = false
      }
    }

    // Validate slug
    if (
      context.params.slug !== 'meta-media' &&
      context.params.slug !== 'tests' &&
      validateSlugTopic === false
    ) {
      context.error({ statusCode: 404, message: 'Topic undefined' })
    } else {
      // Definition of slugs in different languages
      const topicSlug = {}

      if (context.params.slug === 'meta-media') {
        topicSlug.en = 'meta-media'
        topicSlug.fr = 'meta-media'
      } else if (context.params.slug === 'tests') {
        topicSlug.en = 'tests'
        topicSlug.fr = 'tests'
      } else {
        topicSlug.en = topic.meta.slug.en
        topicSlug.fr = topic.meta.slug.fr
      }

      await context.store.dispatch('i18n/setRouteParams', {
        en: { slug: topicSlug.en },
        fr: { slug: topicSlug.fr },
      })

      // Set URI to get specific layout
      let layoutURI = null

      if (context.params.slug === 'meta-media') {
        layoutURI = '/layouts/meta-media'
      } else if (context.params.slug === 'tests') {
        layoutURI = '/layouts/tests'
      } else {
        layoutURI = `/layouts/${topicSlug.en}`
      }
      // Get layout
      try {
        layout = await context.$axios.$get(layoutURI, {
          params: { lang: context.app.i18n.locale },
        })
      } catch (err) {
        throw new Error(err.message)
      }

      let allPostsURI = ''

      // Set URI to get all posts
      if (context.params.slug === 'meta-media') {
        topic = 'meta-media'
        allPostsURI = '/meta-media'
      } else if (context.params.slug === 'tests') {
        topic = 'tests'
        allPostsURI = '/tests?type=open'
      } else {
        allPostsURI = `/headings/${context.params.slug}/posts`
      }

      return { topic, layout: layout.data, allPostsURI }
    }
  },
  data() {
    return {
      posts: [],
      postsPage: {},
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const { title, description } = this.layout
    const image = this.$config.HOST_NAME + '/social_image.png'

    return {
      title: `${title} - France tv lab`,
      meta: createSEOMeta({ title, description, url, image }),
    }
  },
  mounted() {
    // Get all posts
    this.getPosts(1)

    this.$wrapper.setTcVars({
      environnement: this.$config.LIVE_ENV,
      offre: 'lab',
      categorie: 'topic',
      sous_categorie: this.topic.id ? this.topic.id : this.topic,
      nom_page: 'accueil_topic',
      langue: `[${this.$i18n.locale.toUpperCase()}]`,
    })

    this.$trackEvent('datalayer', window, { id: 'datalayer' })
  },
  methods: {
    loadMorePosts() {
      if (this.postsPage.current_page <= this.postsPage.last_page) {
        this.getPosts(this.postsPage.current_page + 1)
      }
    },
    async getPosts(requestedPage) {
      try {
        const posts = await this.$axios.$get(this.allPostsURI, {
          params: { lang: this.$i18n.locale, page: requestedPage },
        })

        posts.data.forEach((element) => {
          this.posts.push(element)
        })
        this.postsPage = posts.meta
      } catch (err) {
        throw new Error(err.message)
      }
    },
  },
}
</script>
