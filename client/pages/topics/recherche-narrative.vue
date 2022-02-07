<template>
  <div class="w-full overflow-x-hidden">
    <!-- Title -->
    <TopicHeader
      v-if="layout.subtitle && layout.shortcut"
      class="desktop:mx-20 mt-14 mobile:mx-4 tablet:mx-4"
      :shortcut="layout.shortcut"
      :description="layout.subtitle"
    />

    <!-- MEA -->
    <TopicsWrapper
      v-if="layout.primary || layout.secondary"
      :layout="layout"
      class="slideTop"
      style="animation-delay: 1.5s"
    />

    <!-- PARTICIPEZ -->
    <template
      v-if="
        layout.participate &&
        layout.participate.title &&
        layout.participate.posts &&
        layout.participate.posts.length > 0
      "
    >
      <SubtitleTopic
        class="desktop:mx-20 mt-14 mobile:mx-4 tablet:mx-4"
        :title="layout.participate.title"
        :description="layout.participate.subtitle"
      />
      <ParticipateWrapper :participateposts="layout.participate.posts" />
    </template>

    <!-- CO-PRODUCTION -->
    <template
      v-if="
        layout.coProduction &&
        layout.coProduction.title &&
        postCoProd &&
        postCoProd.length > 0
      "
    >
      <SubtitleTopic
        class="desktop:mx-20 mt-14 mobile:mx-4 tablet:mx-4"
        :title="layout.coProduction.title"
        :description="layout.coProduction.subtitle"
      />
      <WrapperTopicCard
        class="flex flex-wrap desktop:mx-16 mt-8 mobile:mx-4 tablet:mx-4"
        :posts="postCoProd"
        :cta="$t('topics.calltoaction') + ' ' + $t('topics.coproduction')"
      />
    </template>

    <!-- AGENDA -->
    <template
      v-if="
        layout.agenda &&
        layout.agenda.title &&
        layout.agenda.posts &&
        layout.agenda.posts.length > 0
      "
    >
      <SubtitleTopic
        class="desktop:mx-20 mt-14 mobile:mx-4 tablet:mx-4"
        :title="layout.agenda.title"
        :description="layout.agenda.subtitle"
      />
      <AgendaWrapper
        class="flex flex-wrap desktop:mx-16 mt-8 mobile:mx-4 tablet:mx-4"
        :posts="layout.agenda.posts"
      />
    </template>

    <!-- ARCHIVE -->
    <template
      v-if="
        layout.archive &&
        layout.archive.title &&
        postArchive &&
        postArchive.length > 0
      "
    >
      <SubtitleTopic
        class="desktop:mx-20 mt-14 mobile:mx-4 tablet:mx-4"
        :title="layout.archive.title"
        :description="layout.archive.subtitle"
      />
      <WrapperTopicCard
        class="flex flex-wrap desktop:mx-16 mt-8 mobile:mx-4 tablet:mx-4"
        :posts="postArchive"
        :cta="$t('topics.calltoaction') + ' ' + $t('topics.archive')"
      />
    </template>
  </div>
</template>

<script>
import ParticipateWrapper from '../../components/topics/card/ParticipateWrapper.vue'
import SubtitleTopic from '../../components/topics/card/Subtitle.vue'
import TopicHeader from '../../components/topics/Header.vue'
import TopicsWrapper from '../../components/topics/highlight/Wrapper.vue'
import WrapperTopicCard from '../../components/topics/card/Wrapper.vue'
import AgendaWrapper from '../../components/topics/card/AgendaWrapper.vue'

import { createSEOMeta } from '~/utils/seo'
export default {
  name: 'Storylab',
  auth: false,
  components: {
    TopicHeader,
    SubtitleTopic,
    TopicsWrapper,
    ParticipateWrapper,
    WrapperTopicCard,
    AgendaWrapper,
  },
  data() {
    return {
      layout: {},
      participate: [],
      postArchive: [],
      postCoProd: [],
    }
  },
  async fetch() {
    // SSR Only
    if (process.server) {
      await this.getLayout()
      await this.getPostArchive()
      await this.getPostCoProd()
    } else {
      // Optimize calls on client side
      await this.getLayout()
      this.getPostArchive()
      this.getPostCoProd()
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const { name, subtitle } = this.layout
    const image = this.$config.HOST_NAME + '/social_image.png'

    return {
      title: `${name} - France tv lab`,
      meta: createSEOMeta({ name, subtitle, url, image }),
    }
  },
  computed: {},

  methods: {
    async getLayoutSSR() {
      try {
        const data = await this.$axios.$get(
          '/layouts/narrative-research/filtered',
          {
            params: { lang: this.$i18n.locale },
          }
        )
        Object.keys(data).forEach((key) => (this[key] = data[key].data))
        this.meta = data.posts.meta
      } catch (err) {
        throw new Error(err.message)
      }
    },
    async getLayout() {
      try {
        const data = await this.$axios.$get('/layouts/narrative-research', {
          params: { lang: this.$i18n.locale },
        })
        this.layout = {
          ...data.data,
          shortcut: data.data.shortcut,
        }
      } catch (err) {
        throw new Error(err.message)
      }
    },
    async getPostArchive() {
      try {
        const archive = await this.$axios.$get('/posts?section=archive', {
          params: { lang: this.$i18n.locale },
        })
        this.postArchive = archive.data
      } catch (err) {
        throw new Error(err.message)
      }
    },
    async getPostCoProd() {
      try {
        const coProd = await this.$axios.$get('/posts?section=co-production', {
          params: {
            lang: this.$i18n.locale,
          },
        })
        this.postCoProd = coProd.data
      } catch (err) {
        throw new Error(err.message)
      }
    },
  },
}
</script>

<style scoped>
.slideTop {
  animation-name: slide-top;
  animation-duration: 0.4s;
  animation-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);
  animation-fill-mode: both;
}
@keyframes slide-top {
  0% {
    -webkit-transform: translateY(-100px);
    transform: translateY(-100px);
    opacity: 0;
  }
  50% {
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}
</style>
