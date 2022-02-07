<template>
  <div
    class="banner relative h-48 tablet:h-80 desktop:h-120 bg-center bg-cover"
    :style="{
      'background-image':
        'url(' + $config.IMAGES_DIRECTORY + post.data.featured + ')',
    }"
    :title="post.data.featuredalt !== '' ? post.data.featuredalt : null"
  >
    <div
      class="absolute -bottom-24 left-25 tablet:bottom-24 tablet:mx-0 tablet:left-96"
    >
      <!-- Type for tests -->
      <div v-if="post.type === 'tests'" class="flex">
        <div class="bg-blue test-logo p-4">
          <TestsLogo class="text-white fill-current" />
        </div>
        <p
          class="bg-white text-blue py-1 px-3 text-mobile-h5 tablet:text-desktop-h5 font-bold self-end"
        >
          <span class="uppercase">{{ $t(`posts.types.test`) }}</span>
          <span v-if="testDaysLeft"> | </span>
          <span v-if="testDaysLeft && $i18n.locale === 'fr'"
            >il reste {{ testDaysLeft }}</span
          >
          <span v-if="testDaysLeft && $i18n.locale === 'en'"
            >{{ testDaysLeft }} left</span
          >
        </p>
      </div>

      <!-- Posts type -->
      <div v-else>
        <h5
          v-if="post.data.type || post.data.time"
          class="font-bold uppercase bg-white text-blue type py-1 px-3 inline-flex"
        >
          <span v-if="post.data.type">{{
            $t(`posts.types.${post.data.type}`)
          }}</span>
          <span v-if="post.data.type && post.data.time" class="mx-1">|</span>
          <span v-if="post.data.time"
            >{{ post.data.time }}{{ $t('posts.cards.min') }}</span
          >
        </h5>
      </div>

      <!-- Title -->
      <h2 class="font-bold max-w-sm">
        <span class="title">{{ post.data.title }}</span>
      </h2>
    </div>

    <!-- Share -->
    <div v-if="$mq === 'desktop'" class="absolute share">
      <ContentShare
        :post="post"
        size="small"
        orientation="horizontal"
        @shared="$emit('shared')"
      />
    </div>
  </div>
</template>

<script>
import TestsLogo from '~/assets/img/icons/tests.svg?inline'
import ContentShare from '~/components/content/Share.vue'

export default {
  name: 'ContentBanner',
  components: {
    TestsLogo,
    ContentShare,
  },
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  computed: {
    testDaysLeft({ $dayjs }) {
      if (
        this.post.data.status === 'open' ||
        this.post.data.status === 'soon'
      ) {
        $dayjs.locale(this.$i18n.locale)
        const now = $dayjs()
        const endDate = $dayjs(this.post.data.end_at)
        return now.to(endDate, true)
      } else {
        return null
      }
    },
  },
}
</script>

<style lang="postcss" scoped>
.type,
.test-logo {
  margin-left: -10px;
}
.title {
  @apply bg-blue text-white;

  -webkit-box-shadow: 10px 4px 0 theme('colors.blue'),
    -10px -3px 0 theme('colors.blue'), -10px 4px 0 theme('colors.blue'),
    10px -3px 0 theme('colors.blue');
  box-decoration-break: clone;
}
.share {
  left: -40px;
  top: 50%;
  transform: translateY(-50%);
}
</style>
