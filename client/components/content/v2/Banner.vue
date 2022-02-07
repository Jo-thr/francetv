<template>
  <div class="flex flex-col justify-center items-end">
    <div
      v-if="post.data.illustration.image && post.data.illustration.video"
      class="flex flex-row relative z-10 top-0 w-screen h-66v desktop:h-75v"
    >
      <div
        class="flex absolute z-10 top-0 w-screen h-full bg-cover bg-center zoomIn hiddenImage"
        :style="backgroundImageB2"
      ></div>
      <div
        class="flex absolute z-10 top-0 w-screen h-full bg-cover bg-center video-container"
      >
        <iframe
          frameborder="0"
          allowfullscreen
          width="100%"
          height="100%"
          :src="backgroundVideo"
        >
        </iframe>
      </div>
      <div
        class="flex flex-row absolute desktop:top-12 desktop:left-20 z-20 items-center tablet:top-6 tablet:left-14 mobile:top-6 mobile:left-1"
      >
        <nuxt-link
          :to="
            localePath({
              name: 'topics-slug',
              params: { slug: 'recherche-narrative' },
            })
          "
          @click.native="
            $trackEvent('click', $event.target, {
              event_chapter1: 'header',
              event_name: 'recherche-narrative',
            })
          "
        >
          <h2 class="text-white tablet:flex mobile:hidden">
            <span class="font-black">Story</span
            ><span class="font-light">Lab</span>
          </h2></nuxt-link
        >

        <nuxt-link
          :to="
            localePath({
              name: 'topics-slug',
              params: { slug: 'recherche-narrative' },
            })
          "
          @click.native="
            $trackEvent('click', $event.target, {
              event_chapter1: 'header',
              event_name: 'recherche-narrative',
            })
          "
        >
          <button
            class="flex bg-yellow text-black py-2 px-4 Btn items-center text-common-legend"
            :aria-label="$t('topics.return')"
          >
            {{ $t('topics.return') }}
          </button></nuxt-link
        >
      </div>
    </div>
    <div
      v-else
      class="flex flex-row relative z-10 top-0 w-screen h-66v desktop:h-75v bg-cover bg-center zoomIn"
      :style="backgroundImageB2"
    >
      <div
        class="flex flex-row absolute desktop:top-12 desktop:left-20 z-20 items-center tablet:top-6 tablet:left-14 mobile:top-6 mobile:left-1"
      >
        <nuxt-link
          :to="
            localePath({
              name: 'topics-slug',
              params: { slug: 'recherche-narrative' },
            })
          "
          @click.native="
            $trackEvent('click', $event.target, {
              event_chapter1: 'header',
              event_name: 'recherche-narrative',
            })
          "
        >
          <h2 class="text-white tablet:flex mobile:hidden">
            <span class="font-black">Story</span
            ><span class="font-light">Lab</span>
          </h2></nuxt-link
        >

        <nuxt-link
          :to="
            localePath({
              name: 'topics-slug',
              params: { slug: 'recherche-narrative' },
            })
          "
          @click.native="
            $trackEvent('click', $event.target, {
              event_chapter1: 'header',
              event_name: 'recherche-narrative',
            })
          "
        >
          <button
            class="flex bg-yellow text-black py-2 px-4 Btn items-center text-common-legend"
            :aria-label="$t('topics.return')"
          >
            {{ $t('topics.return') }}
          </button></nuxt-link
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ContentHeader',
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      tagsData: this.post.tags.data,
    }
  },
  computed: {
    backgroundImageB2() {
      if (this.post.data.illustration.image || this.post.data.featured) {
        return {
          'background-image':
            'url(' +
            this.$config.IMAGES_DIRECTORY +
            (this.post.data.illustration.image || this.post.data.featured) +
            ')',
        }
      } else {
        return null
      }
    },
    backgroundVideo() {
      const videoRegex =
        /^https:\/\/www\.youtube\.com\/embed\/(?<videoId>[A-Za-z0-9]+)$/
      if (videoRegex.test(this.post.data.illustration.video)) {
        const {
          groups: { videoId },
        } = videoRegex.exec(this.post.data.illustration.video)
        const url = new URL(`https://www.youtube-nocookie.com/embed/${videoId}`)
        url.search = new URLSearchParams({
          mute: 1,
          autoplay: 1,
          loop: 1,
          controls: 0,
          disablekb: 1,
          showinfo: 0,
          iv_load_policy: 3,
          modestbranding: 1,
          rel: 0,
          playlist: videoId,
        })
        return url.toString()
      } else {
        return null
      }
    },
  },
}
</script>

<style lang="postcss" scoped>
li:last-child span {
  display: none;
}

.Btn {
  transition: 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
  margin-left: 18px;
}
.Btn:hover {
  transform: scale(1.05);
}

.zoomIn {
  opacity: 1;
  animation-name: zoomIn;
  animation-duration: 0.5s;
  animation-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);
  animation-fill-mode: both;
  animation-delay: 0.5s;
}
@keyframes zoomIn {
  0% {
    -webkit-transform: scale(1.03);
    transform: scale(1.03);
    opacity: 0;
  }
  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
.hiddenImage {
  animation-name: hiddenImage;
  animation-delay: 2.5s;
  animation-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);
  animation-fill-mode: both;
  opacity: 1;
}
@keyframes hiddenImage {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

.video-container > iframe {
  position: relative;
  width: 100%;
  height: 100%;
}
</style>
