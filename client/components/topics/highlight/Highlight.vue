<template>
  <div class="mt-12">
    <!-- Tag & Age -->
    <div
      class="flex flex-row mb-2 desktop:mx-24 items-center tablet:mx-6 mobile:mx-6"
    >
      <ul class="flex flex-row flex-nowrap">
        <li v-for="(tag, index) in tagsData" :key="index" class="font-bold">
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
      class="tablet:h-176 bg-cover bg-center relative hover:cursor-pointer h-auto"
      :class="{ '-mx-4 tablet:mx-0': !$route.name.includes('index') }"
      @click="goToPost($event)"
    >
      <div
        class="relative desktop:mx-24 mb-4 tablet:mx-6 mobile:mx-10"
        :class="{ 'text-container': $route.name.includes('index') }"
      >
        <!-- Title -->
        <h3
          v-if="postData.data.title || post.title"
          class="max-w font-normal"
          tabindex="0"
          :aria-label="postData.data.title"
        >
          {{ post.title || post.block3title || postData.data.title }}
        </h3>
      </div>

      <!-- DESKTOP & TABLET -->
      <div>
        <div
          v-if="postData.data.video"
          class="tablet:flex relative bg-cover w-full h-160 items-end justify-center hoverBtn mobile:hidden"
        >
          <iframe
            id="videoFirst"
            frameborder="0"
            height="100%"
            width="100%"
            allow="autoplay 'src'"
            :src="postData.data.video + '?mute=1' + '&autoplay=1'"
          >
          </iframe>
          <button
            class="absolute bottom-20 bg-white rounded-full px-8 py-2 text-common-regular"
          >
            {{ $t('topics.goToPost') }}
          </button>
        </div>

        <div
          v-else
          class="tablet:flex relative bg-cover w-full h-176 items-end justify-center hoverBtn mobile:hidden"
          :style="backgroundImageB1"
          @click="goToPost($event)"
        >
          <button
            class="absolute bottom-20 bg-white rounded-full px-8 py-2 text-common-regular"
          >
            {{ $t('topics.goToPost') }}
          </button>
        </div>
      </div>
      <!-- MOBILE ONLY-->
      <div
        v-if="postData.data.video_square"
        class="tablet:hidden mobile:flex relative square bg-cover w-full h-full items-end justify-center hoverBtn"
      >
        <iframe
          id="videoFirst"
          class="absolute"
          frameborder="0"
          height="100%"
          :alt="postData.data.video_alt"
          width="100%"
          allow="autoplay 'src'"
          :src="postData.data.video_square + '?mute=1' + '&autoplay=1'"
        >
        </iframe>
        <button
          class="absolute bottom-20 bg-white rounded-full px-8 py-2 text-common-regular"
        >
          {{ $t('topics.goToPost') }}
        </button>
      </div>
      <div
        v-else-if="postData.data.video"
        class="tablet:hidden mobile:flex relative h-72 bg-cover w-full items-end justify-center hoverBtn"
      >
        <iframe
          id="videoFirst"
          class="absolute"
          frameborder="0"
          height="100%"
          :alt="postData.data.video_alt"
          width="100%"
          allow="autoplay 'src'"
          :src="postData.data.video + '?mute=1' + '&autoplay=1'"
        >
        </iframe>
        <button
          class="absolute bottom-20 bg-white rounded-full px-8 py-2 text-common-regular"
        >
          {{ $t('topics.goToPost') }}
        </button>
      </div>
      <div
        v-else
        class="tablet:hidden flex relative bg-cover w-full h-72 items-end justify-center hoverBtn"
        :style="backgroundImageB1"
        @click="goToPost($event)"
      >
        <button
          class="absolute bottom-20 bg-white rounded-full px-8 py-2 text-common-regular"
        >
          {{ $t('topics.goToPost') }}
        </button>
      </div>
    </article>
  </div>
</template>
<script>
export default {
  name: 'TopicsHighlight',
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      postData: this.post.block1 || this.post.block3,
      tagsData: this.post.block1.tags.data,
    }
  },
  computed: {
    backgroundImageB1() {
      if (this.postData.data.featured || this.post.block1.data.featured) {
        return {
          'background-image':
            'url(' +
            this.$config.IMAGES_DIRECTORY +
            (this.postData.data.featured || this.post.block1.data.featured) +
            ')',
        }
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

.ytp-gradient-top {
  @apply hidden;
}

.square {
  @apply relative w-full;
}

.square::after {
  @apply block;
  content: '';
  padding-bottom: 100%;
}
</style>
