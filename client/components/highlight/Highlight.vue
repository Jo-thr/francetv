<template>
  <article
    class="h-48 tablet:h-80 desktop:h-120 bg-cover bg-center relative hover:shadow-lg transition-all duration-300 hover:cursor-pointer"
    :class="{ '-mx-4 tablet:mx-0': !$route.name.includes('index') }"
    :style="backgroundImage"
    @click="goToPost($event)"
  >
    <!-- Logo external link -->
    <div v-if="postData.data.url" class="absolute bottom-0 right-0 bg-blue p-1">
      <img
        src="~/assets/img/icons/arrow-up-right.svg"
        aria-hidden="true"
        :alt="$t('accessibilite.img-alt.logo-lien-externe')"
      />
    </div>

    <!-- Pictogramme -->
    <div
      v-if="postData.pictogram && !postData.data.url"
      class="absolute top-0 right-0 bg-white px-2 py-1"
    >
      <img
        :src="$config.IMAGES_DIRECTORY + postData.pictogram.image"
        :alt="postData.pictogram.name"
        aria-hidden="true"
        class="h-4"
      />
    </div>

    <!-- Sponsor -->
    <div
      v-if="postData.sponsor && !postData.data.url"
      class="absolute top-0 right-0 flex mb-2 items-center bg-white px-2 py-1"
    >
      <span class="mr-2 text-common-regular">{{
        $t('posts.footer.teste_avec')
      }}</span>
      <img
        :src="$config.IMAGES_DIRECTORY + postData.sponsor.image"
        :alt="postData.sponsor.name"
        aria-hidden="true"
        class="h-4"
      />
    </div>

    <div
      class="absolute left-25 -bottom-24 tablet:bottom-24 tablet:mx-0"
      :class="{ 'text-container': $route.name.includes('index') }"
    >
      <!-- Type for tests -->
      <div v-if="$route.params.slug === 'tests'" class="flex">
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

      <!-- Default type -->
      <div v-else>
        <h2
          v-if="postData.data.type"
          class="font-bold uppercase type-container"
        >
          <span class="type">{{
            $t(`posts.types.${postData.data.type}`)
          }}</span>
        </h2>
      </div>

      <!-- Title -->
      <h2 v-if="postData.data.title || post.title" class="font-bold max-w-sm">
        <span class="title">{{
          post.title || post.block3title || postData.data.title
        }}</span>
      </h2>
    </div>
  </article>
</template>
<script>
import TestsLogo from '~/assets/img/icons/tests.svg?inline'

export default {
  name: 'Highlight',
  components: {
    TestsLogo,
  },
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      postData: this.post.block1 || this.post.block3,
    }
  },
  computed: {
    backgroundImage() {
      if (this.post.img || this.post.block3img) {
        return {
          'background-image':
            'url(' +
            this.$config.IMAGES_DIRECTORY +
            (this.post.img || this.post.block3img) +
            ')',
        }
      } else {
        return null
      }
    },
    testDaysLeft({ $dayjs }) {
      if (
        this.postData.data.status === 'open' ||
        this.postData.data.status === 'soon'
      ) {
        $dayjs.locale(this.$i18n.locale)
        const now = $dayjs()
        const endDate = $dayjs(this.postData.data.end_at)
        return now.to(endDate, true)
      } else {
        return null
      }
    },
  },
  methods: {
    goToPost(e) {
      const eventData = {
        event_chapter1: 'mise_en_avant',
        event_chapter2: null,
        event_name: null,
      }

      if (this.postData.type === 'posts') {
        eventData.event_chapter2 = this.postData.data.heading.id
        eventData.event_name = this.postData.slug
      } else if (this.postData.type === 'meta-medias') {
        eventData.event_chapter2 = 'metamedias'
        eventData.event_name = this.postData.data.title
      } else if (this.postData.type === 'tests') {
        eventData.event_chapter2 = 'tests'
        eventData.event_name = this.postData.data.slug
      }

      this.$trackEvent('click', e.target, eventData)

      if (this.postData.data.url) {
        window.open(this.post.block1.data.url, '_blank')
      } else if (this.postData.type === 'posts') {
        this.$router.push(
          this.localeRoute({
            name: `articles-slug`,
            params: { slug: this.postData.meta.slug[this.$i18n.locale] },
          })
        )
      } else if (this.postData.type === 'tests') {
        this.$router.push(
          this.localeRoute({
            name: `tests-slug`,
            params: {
              slug: this.postData.meta.slug[this.$i18n.locale],
            },
          })
        )
      }
    },
  },
}
</script>

<style lang="postcss" scoped>
@media screen and (min-width: 768px) {
  .text-container {
    left: 50%;
    transform: translateX(-50%);
  }
}

.type-container {
  margin-bottom: 3px;
}

.type {
  @apply bg-white text-blue inline-block;

  -webkit-box-shadow: 10px 4px 0 theme('colors.white'),
    -10px -3px 0 theme('colors.white'), -10px 4px 0 theme('colors.white'),
    10px -3px 0 theme('colors.white');
  box-decoration-break: clone;
}
.title {
  @apply bg-blue text-white;

  -webkit-box-shadow: 10px 4px 0 theme('colors.blue'),
    -10px -3px 0 theme('colors.blue'), -10px 4px 0 theme('colors.blue'),
    10px -3px 0 theme('colors.blue');
  box-decoration-break: clone;
}
.test-logo {
  margin-left: -10px;
}
</style>
