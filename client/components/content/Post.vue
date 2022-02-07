<template>
  <article>
    <div class="container">
      <!-- Banner -->
      <ContentBanner :post="post" class="mb-12"/>

      <div class="px-4 desktop:px-24">
        <!-- Topic -->
        <nuxt-link
          class="inline-block text-common-legend tablet:text-common-regular mb-4 text-gray-dark underline hover:text-blue transition-all duration-300 hover:font-bold"
          :to="
            localePath({
              name: 'topics-slug',
              params: { slug: post.data.heading.meta.slug[$i18n.locale] },
            })
          "
        >
          {{ post.data.heading.data.label }}
        </nuxt-link>

        <!-- Speakers -->
        <div
          v-if="post.speakers && post.speakers.length > 0"
          class="text-gray-dark text-common-tag mb-8 tablet:mb-12"
        >
          <span>{{ $t('posts.intervenants') }}</span>
          <span v-for="(speaker, index) in post.speakers" :key="index"
          >{{ speaker }}
            <span v-if="index + 1 < post.speakers.length" class="mx-1">|</span>
          </span>
        </div>

        <!-- Excerpt -->
        <p
          v-if="post.data.excerpt"
          class="font-bold text-mobile-quote tablet:text-desktop-quote mb-8 tablet:mb-12"
        >
          {{ post.data.excerpt }}
        </p>

        <!-- Podcast iframe -->
        <div
          v-if="
            post.data.iframe &&
            (post.data.heading.id === 'podcasts') & $device.isDesktop
          "
          class="mb-8 tablet:mb-12"
          v-html="post.data.iframe"
        ></div>

        <!-- Editor.js -->
        <div
          v-if="post.data.content"
          v-viewer
          class="editor-js-content"
          v-html="post.data.content"
        ></div>

        <!-- Footer -->
        <ContentFooter id="content_footer" class="mt-24" :post="post"/>
      </div>
    </div>

    <!-- Podcast iframe for tablet and mobile -->
    <div
      v-if="
        post.data.iframe &&
        (post.data.heading.id === 'podcasts') && !$device.isDesktop
      "
      :class="{
        'sticky bottom-0 w-full left-0': fixedPodcast,
        '-mb-24 mt-12': !fixedPodcast,
      }"
      v-html="post.data.iframe"
    ></div>
  </article>
</template>

<script>
import ContentFooter from '~/components/content/Footer.vue'
import ContentBanner from '~/components/content/Banner.vue'

export default {
  name: 'Post',
  components: {
    ContentFooter,
    ContentBanner,
  },
  props: {
    post: {
      type: Object,
      required: true,
    },
    fixedPodcast: {
      type: Boolean,
      default: true
    }
  },
}
</script>
