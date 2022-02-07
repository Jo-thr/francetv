<template>
  <div class="container px-4 tablet:px-0">
    <Title
      v-if="tag.data.name"
      :title="tag.data.name"
      class="mt-12 tablet:mt-16 mb-4 text-center"
    />

    <p class="text-gray-dark text-center mb-12">{{ $t('tags.description') }}</p>

    <CardWrapper
      v-if="posts.length > 0"
      :posts="posts"
      :posts-page="postPage"
      class="tablet:-mx-2"
    />
  </div>
</template>

<script>
import { createSEOMeta } from '~/utils/seo'

export default {
  name: 'TagIndex',
  auth: false,
  async asyncData(context) {
    try {
      const tag = await context.$axios.$get(
        `/tags/slug=${context.params.slug}`,
        {
          params: { lang: context.app.i18n.locale },
        }
      )

      context.store.dispatch('i18n/setRouteParams', {
        en: { slug: tag.meta.slug.en },
        fr: { slug: tag.meta.slug.fr },
      })

      try {
        const posts = await context.$axios.$get(
          `/tags/slug=${context.params.slug}/all`,
          {
            params: { lang: context.app.i18n.locale },
          }
        )

        return { tag, posts: posts.data, postPage: posts.meta }
      } catch (error) {
        context.error({ statusCode: error.code, message: error.message })
      }
    } catch (error) {
      context.error({ statusCode: error.code, message: error.message })
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const title = this.tag.data ? this.tag.data.name : 'Tag'
    const description = this.$i18n.t('tags.description')
    const image = this.$config.HOST_NAME + '/social_image.png'

    return {
      title: `${title} - France tv lab`,
      meta: createSEOMeta({ title, description, url, image }),
    }
  },
  mounted() {
    this.$wrapper.setTcVars({
      environnement: this.$config.LIVE_ENV,
      offre: 'lab',
      categorie: 'tag',
      nom_page: this.tag.data.slug,
      langue: `[${this.$i18n.locale.toUpperCase()}]`,
    })

    this.$trackEvent('datalayer', window, { id: 'datalayer' })
  },
}
</script>
