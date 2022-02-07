<template>
  <div class="mt-6 mb-24">
    <!-- Tag & Age -->
    <div
      class="flex flex-row mb-2 items-center desktop:mx-0 tablet:mx-6 mobile:mx-6"
    >
      <ul class="flex flex-row flex-nowrap">
        <li v-for="tag in tagsData" :key="tag" class="font-bold">
          <nuxt-link
            :to="
              localePath({
                name: 'tags-slug',
                params: { slug: tag.data.slug },
              })
            "
            :aria-label="tag.data.name"
            >{{ tag.data.name }}</nuxt-link
          ><span class="font-bold pr-1">,</span>
        </li>
      </ul>
      <div
        class="ml-3 px-1 py-px rounded border border-gray text-common-legend"
        tabindex="0"
      >
        <p
          v-if="postData.data.age && $i18n.locale === 'fr'"
          :aria-label="postData.data.age.fr"
        >
          {{ postData.data.age.fr }}
        </p>
        <p
          v-if="postData.data.age && $i18n.locale === 'en'"
          :aria-label="postData.data.age.en"
        >
          {{ postData.data.age.en }}
        </p>
      </div>
    </div>

    <article
      class="h-full bg-cover bg-center relative hover:cursor-pointer"
      :class="{ '-mx-4 tablet:mx-0': !$route.name.includes('index') }"
      @click="goToPost($event)"
    >
      <div
        class="relative mb-4 desktop:mx-0 tablet:mx-6 mobile:mx-10"
        :class="{ 'text-container': $route.name.includes('index') }"
      >
        <!-- Title -->
        <h3
          v-if="postData.data.title"
          class="max-w font-normal"
          :aria-label="postData.data.title"
        >
          {{ postData.data.title }}
        </h3>
      </div>

      <div
        class="flex relative w-full h-48 tablet:h-80 desktop:h-120 bg-cover bg-center items-end justify-center hoverBtn"
        :class="{ '-mx-4 tablet:mx-0': !$route.name.includes('index') }"
        :style="backgroundImage"
        @click="goToPost($event)"
      >
        <button
          class="absolute bottom-20 bg-white rounded-full px-8 py-2 text-common-regular"
          :aria-label="$t('topics.goToPost')"
        >
          {{ $t('topics.goToPost') }}
        </button>
      </div>
    </article>
  </div>
</template>
<script>
export default {
  name: 'TopicsOptional',
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      postData: this.post.block4,
      tagsData: this.post.block4.tags.data,
    }
  },
  computed: {
    backgroundImage() {
      return {
        'background-image':
          'url(' +
          this.$config.IMAGES_DIRECTORY +
          (this.post.img || this.post.block4.data.featured) +
          ')',
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

<style lang="scss" scoped>
li:last-child span {
  @apply hidden;
}

.hoverBtn button {
  @apply opacity-0;
  transition: transform 0.5s cubic-bezier(0.645, 0.045, 0.355, 1),
    opacity 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
}
.hoverBtn:hover button {
  @apply opacity-100;
  transform: translateY(20px);
}
</style>
