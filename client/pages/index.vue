<template>
  <div v-if="!$fetchState.pending">
    <!-- Event -->
    <div v-if="layout.event" class="mb-8">
      <div
        class="flex-inline flex-col p-4 tablet:px-10 tablet:py-6 tablet:flex-row tablet:flex tablet:items-center"
      >
        <span class="bg-red text-white px-2 py-1 tablet:mr-6">{{
          $t('home.direct')
        }}</span>
        <h4 class="mt-3 tablet:mt-0">{{ layout.event.title }}</h4>
      </div>

      <div class="flex flex-col desktop:flex-row">
        <div
          :class="{ 'desktop:w-full': !layout.event.twitter }"
          class="iframe-container w-full desktop:w-2/3"
          v-html="layout.event.iframe"
        ></div>
        <div
          v-if="layout.event.twitter"
          class="iframe-container overflow-y-scroll w-full desktop:w-1/3"
          v-html="layout.event.twitter"
        ></div>
      </div>
    </div>

    <!-- MEA -->
    <HighlightWrapper
      v-if="layout.primary || layout.secondary"
      :layout="layout"
    />

    <div class="container px-4 tablet:px-0">
      <!-- A lire -->
      <div
        v-if="!$fetchState.pending && read.length > 0"
        class="mb-16 tablet:mb-12"
      >
        <Title
          tag="h2" :title="$i18n.t('posts.types.read')" class="text-center mb-6" />

        <div class="flex flex-wrap tablet:-mx-2">
          <Card
            v-for="(post, index) in read"
            :key="index"
            :post="post"
            :size="cardSize(index)"
          />
        </div>
      </div>

      <!-- A voir -->
      <div
        v-if="!$fetchState.pending && see.length > 0"
        class="mb-16 tablet:mb-12"
      >
        <Title
          tag="h2"
          :title="$i18n.t('posts.types.see')"
          class="text-center mb-6"
        />

        <div class="flex flex-wrap tablet:-mx-2">
          <Card
            v-for="(post, index) in see"
            :key="index"
            :post="post"
            :size="cardSize(index)"
          />
        </div>
      </div>

      <!-- A écouter -->
      <div
        v-if="!$fetchState.pending && listen.length > 0"
        class="mb-16 tablet:mb-12"
      >
        <Title
          tag="h2"
          :title="$i18n.t('posts.types.listen')"
          class="text-center mb-6"
        />

        <div class="flex flex-wrap tablet:-mx-2">
          <Card
            v-for="(post, index) in listen"
            :key="index"
            :post="post"
            :size="cardSize(index)"
          />
        </div>
      </div>

      <!-- A tester -->
      <div
        v-if="!$fetchState.pending && test.length > 0"
        class="mb-16 tablet:mb-12"
      >
        <Title
          tag="h2" :title="$i18n.t('posts.types.test')" class="text-center mb-6" />

        <div class="flex flex-wrap tablet:-mx-2">
          <Card
            v-for="(post, index) in test"
            :key="index"
            :post="post"
            :size="cardSize(index)"
          />
        </div>
      </div>

      <!-- Meta-media -->
      <div v-if="metamedia.length > 0" class="mb-16">
        <Title
          tag="h2"
          :title="$i18n.t('home.direct-meta-media')"
          class="text-center mb-6"
        />

        <div class="flex flex-wrap tablet:-mx-2">
          <Card
            v-for="(post, index) in metamedia"
            :key="index"
            :post="post"
            size="small"
          />
        </div>
      </div>

      <!-- A propos -->
      <TopicBanner
          tag="h2"
        class="py-24 mb-16 tablet:mb-12"
        :title="$i18n.t('home.a-propos')"
        :description-h-t-m-l="$i18n.t('home.a_propos_description')"
        underline="#FF778B"
        background="#0023FF"
        :text-black="false"
      />

      <!-- Tous les articles -->
      <div v-if="posts.length > 0">
        <Title
          tag="h2" :title="$t('home.tous-articles')" class="text-center mb-6" />
        <div class="flex flex-wrap">
          <CardWrapper
            :posts="posts"
            class="tablet:-mx-2"
            :posts-page="meta"
            @display-more="loadMorePosts()"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { createSEOMeta } from '~/utils/seo'

export default {
  name: 'Index',
  auth: false,
  script: [
    {
      src: 'https://platform.twitter.com/widgets.js',
      async: true,
      charset: 'utf-8',
    },
  ],
  data() {
    return {
      layout: {},
      metamedia: [],
      posts: [],
      read: [],
      see: [],
      listen: [],
      test: [],
      meta: null,
    }
  },
  async fetch() {
    // SSR Only
    if (process.server) {
      await this.getLayout()
      await this.getMetaMedia()
      await this.getPost('see')
      await this.getPost('read')
      await this.getPost('listen')
      await this.getPost('test')
      await this.getOthersPosts()
    } else {
      // Optimize calls on client side
      await this.getLayout()
      this.getMetaMedia()
      this.getPost('see')
      this.getPost('read')
      this.getPost('listen')
      this.getPost('test')
      this.getOthersPosts()
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const title = this.$i18n.t('seo.meta.index.titre')
    const description = this.$i18n.t('seo.meta.index.description')
    const image = this.$config.HOST_NAME + '/social_image.png'

    return {
      title: `${title}`,
      meta: createSEOMeta({ title, description, url, image }),
    }
  },
  mounted() {
    this.$wrapper.setTcVars({
      environnement: this.$config.LIVE_ENV,
      offre: 'lab',
      categorie: 'accueil',
      nom_page: 'accueil',
      langue: `[${this.$i18n.locale.toUpperCase()}]`,
    })

    this.$trackEvent('datalayer', window, { id: 'datalayer' })
  },
  methods: {
    cardSize(index) {
      if (this.$mq === 'mobile') {
        if (index < 1) {
          return 'large'
        } else {
          return 'small'
        }
      } else if (index < 2) {
        return 'large'
      } else {
        return 'medium'
      }
    },
    async getLayoutSSR() {
      try {
        const data = await this.$axios.$get('/layouts/home/filtered', {
          params: { lang: this.$i18n.locale },
        })
        Object.keys(data).forEach((key) => (this[key] = data[key].data))
        this.meta = data.posts.meta
      } catch (err) {
        throw new Error(err.message)
      }
    },
    async getLayout() {
      try {
        const data = await this.$axios.$get('/layouts/home', {
          params: { lang: this.$i18n.locale },
        })
        this.layout = data.data
      } catch (err) {
        throw new Error(err.message)
      }
    },
    async getMetaMedia() {
      try {
        const data = await this.$axios.$get('/meta-media/last', {
          params: { lang: this.$i18n.locale },
        })
        this.metamedia = data.data
      } catch (err) {
        throw new Error(err.message)
      }
    },
    async getPost(type) {
      try {
        const data = await this.$axios.$get('/posts', {
          params: {
            lang: this.$i18n.locale,
            limit: 5,
            home: true,
            'filter[category]': 'external,default',
            'filter[type]': type,
          },
        })
        this[type] = data.data
      } catch (err) {
        throw new Error(err.message)
      }
    },
    async getOthersPosts(page) {
      try {
        const data = await this.$axios.$get('/posts/filtered', {
          params: {
            lang: this.$i18n.locale,
            page,
          },
        })
        this.posts = [...this.posts, ...data.data]
        this.meta = data.meta
      } catch (err) {
        throw new Error(err.message)
      }
    },
    loadMorePosts() {
      if (this.meta.current_page <= this.meta.last_page) {
        this.getOthersPosts(this.meta.current_page + 1)
      }
    },
  },
}
</script>

<style lang="postcss" scoped>
.iframe-container {
  @apply relative h-0;

  padding-bottom: 50%;
}

.iframe-container >>> iframe {
  @apply absolute top-0 left-0 w-full h-full;
}
</style>
