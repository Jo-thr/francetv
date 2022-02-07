<template>
  <div
    class="mt-12 flex desktop:flex-row tablet:flex-col mobile:flex-col h-full mb-24"
  >
    <!-- SECOND MEA -->
    <div
      class="flex flex-col desktop:w-1/2 desktop:pr-10 mobile:w-full desktop:pb-0 tablet:pb-8 tablet:w-full tablet:pr-0 mobile:pb-8 mobile:pr-0"
      tabindex="0"
    >
      <!-- Tag & Age -->
      <div
        class="flex flex-row mb-2 items-center desktop:mx-0 tablet:mx-6 mobile:mx-6"
      >
        <ul class="flex flex-row flex-nowrap">
          <li v-for="(tag, index) in tagsData2" :key="index" class="font-bold">
            <nuxt-link
              :to="
                localePath({
                  name: 'tags-slug',
                  params: { slug: tag.data.slug },
                })
              "
              :aria-label="tag.data.name"
              >{{ tag.data.name }}</nuxt-link
            >
            <span class="font-bold pr-1">,</span>
          </li>
        </ul>
        <div
          class="ml-3 px-1 py-px rounded border border-gray text-common-legend"
          tabindex="0"
        >
          <p
            v-if="postData2.data.age && $i18n.locale === 'fr'"
            :aria-label="postData2.data.age.fr"
          >
            {{ postData2.data.age.fr }}
          </p>
          <p
            v-if="postData2.data.age && $i18n.locale === 'en'"
            :aria-label="postData2.data.age.en"
          >
            {{ postData2.data.age.en }}
          </p>
        </div>
      </div>
      <!-- Video & Image -->
      <article
        class="flex flex-col tablet:h-full bg-cover bg-center relative hover:cursor-pointer hoverBtn h-72 justify-between"
        :class="{ '-mx-4 tablet:mx-0': !$route.name.includes('index') }"
        @click="goToPostArt2($event)"
      >
        <div
          class="relative mb-4 desktop:mx-0 tablet:mx-6 mobile:mx-10"
          :class="{ 'text-container': $route.name.includes('index') }"
        >
          <!-- Title -->
          <h3
            v-if="postData2.data.title"
            class="max-w font-normal"
            tabindex="0"
            :aria-label="postData2.data.title"
          >
            {{ postData2.data.title }}
          </h3>
        </div>

        <div
          v-if="postData2.data.video"
          class="flex relative bg-cover h-96 items-center justify-center"
          :class="{ '-mx-4 tablet:mx-0': !$route.name.includes('index') }"
          @click="goToPostArt2($event)"
        >
          <iframe
            id="videoIframe"
            frameborder="0"
            allowfullscreen
            height="100%"
            width="100%"
            :src="postData2.data.video + '?mute=1'"
            @mouseover="playVideo()"
            @mouseleave="stopVideo()"
          >
          </iframe>
          <button
            class="absolute bottom-16 bg-white rounded-full px-8 py-2 text-common-regular"
            :aria-label="$t('topics.goToPost')"
          >
            {{ $t('topics.goToPost') }}
          </button>
        </div>
        <div
          v-else
          class="flex relative w-full h-96 bg-cover bg-center items-end justify-center hoverBtn mobile:h-64"
          :class="{ '-mx-4 tablet:mx-0': !$route.name.includes('index') }"
          :style="backgroundImageB2"
          @click="goToPostArt2($event)"
        >
          <button
            class="absolute bottom-16 bg-white rounded-full px-8 py-2 text-common-regular"
            :aria-label="$t('topics.goToPost')"
          >
            {{ $t('topics.goToPost') }}
          </button>
        </div>
      </article>
    </div>

    <!-- THIRD MEA -->
    <div
      class="flex flex-col desktop:w-1/2 desktop:pl-10 pl-0 w-full tablet:mt-0 mt-12"
      tabindex="0"
    >
      <!-- Tag & Age -->
      <div
        class="flex flex-row mb-2 items-center desktop:mx-0 tablet:mx-6 mobile:mx-6"
      >
        <ul class="flex flex-row flex-nowrap">
          <li v-for="(tag, index) in tagsData3" :key="index" class="font-bold">
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
            v-if="postData3.data.age && $i18n.locale === 'fr'"
            :aria-label="postData3.data.age.fr"
          >
            {{ postData3.data.age.fr }}
          </p>
          <p
            v-if="postData3.data.age && $i18n.locale === 'en'"
            :aria-label="postData3.data.age.en"
          >
            {{ postData3.data.age.en }}
          </p>
        </div>
      </div>
      <!-- Video & Image -->
      <article
        class="flex flex-col tablet:h-full bg-cover bg-center relative hover:cursor-pointer hoverBtn h-72 justify-between"
        @click="goToPostArt3($event)"
      >
        <div
          class="flex relative mb-4 desktop:mx-0 tablet:mx-6 mx-10"
          :class="{ 'text-container': $route.name.includes('index') }"
        >
          <!-- Title -->
          <h3
            v-if="postData3.data.title"
            class="max-w font-normal"
            tabindex="0"
            :aria-label="postData3.data.title"
          >
            {{ postData3.data.title }}
          </h3>
        </div>

        <div
          v-if="postData3.data.video"
          class="flex relative bg-cover h-96 items-center justify-center"
          :class="{ '-mx-4 tablet:mx-0': !$route.name.includes('index') }"
          @click="goToPostArt3($event)"
        >
          <iframe
            id="videoIframe3"
            allowfullscreen
            frameborder="0"
            showinfo="0"
            width="100%"
            height="100%"
            :src="postData3.data.video + '?mute=1' + '&controls=0'"
            @mouseover="playVideo3()"
            @mouseleave="stopVideo3()"
          >
          </iframe>
          <button
            class="absolute bottom-16 bg-white rounded-full px-8 py-2 text-common-regular"
            :aria-label="$t('topics.goToPost')"
          >
            {{ $t('topics.goToPost') }}
          </button>
        </div>
        <div
          v-else
          class="flex relative w-full h-96 bg-cover bg-center items-end justify-center hoverBtn mobile:h-64"
          :class="{ '-mx-4 tablet:mx-0': !$route.name.includes('index') }"
          :style="backgroundImageB3"
          @click="goToPostArt3($event)"
        >
          <button
            class="absolute bottom-16 bg-white rounded-full px-8 py-2 text-common-regular"
            :aria-label="$t('topics.goToPost')"
          >
            {{ $t('topics.goToPost') }}
          </button>
        </div>
      </article>
    </div>
  </div>
</template>
<script>
export default {
  name: 'TopicsSecondary',
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      postData2: this.post.block2,
      postData3: this.post.block3,
      tagsData2: this.post.block2.tags.data,
      tagsData3: this.post.block3.tags.data,
    }
  },
  computed: {
    backgroundImageB2() {
      if (this.post.img || this.post.block2.data.featured) {
        return {
          'background-image':
            'url(' +
            this.$config.IMAGES_DIRECTORY +
            (this.post.img || this.post.block2.data.featured) +
            ')',
        }
      } else {
        return null
      }
    },
    backgroundImageB3() {
      if (this.post.img || this.post.block3.data.featured) {
        return {
          'background-image':
            'url(' +
            this.$config.IMAGES_DIRECTORY +
            (this.post.img || this.post.block3.data.featured) +
            ')',
        }
      } else {
        return null
      }
    },
  },

  methods: {
    goToPostArt2(e) {
      const eventData = {
        event_chapter1: 'mise_en_avant',
        event_chapter2: null,
        event_name: null,
      }

      if (this.postData2.type === 'posts') {
        eventData.event_chapter2 = this.postData2.data.heading.id
        eventData.event_name = this.postData2.slug
      } else if (this.postData2.type === 'meta-medias') {
        eventData.event_chapter2 = 'metamedias'
        eventData.event_name = this.postData2.data.title
      } else if (this.postData2.type === 'tests') {
        eventData.event_chapter2 = 'tests'
        eventData.event_name = this.postData2.data.slug
      }

      this.$trackEvent('click', e.target, eventData)

      if (this.postData2.data.url) {
        window.open(this.post.block2.data.url, '_blank')
      } else if (this.postData2.type === 'posts') {
        this.$router.push(
          this.localeRoute({
            name: `articles-slug`,
            params: { slug: this.postData2.meta.slug[this.$i18n.locale] },
          })
        )
      } else if (this.postData2.type === 'tests') {
        this.$router.push(
          this.localeRoute({
            name: `tests-slug`,
            params: {
              slug: this.postData2.meta.slug[this.$i18n.locale],
            },
          })
        )
      }
    },
    goToPostArt3(e) {
      const eventData = {
        event_chapter1: 'mise_en_avant',
        event_chapter2: null,
        event_name: null,
      }

      if (this.postData3.type === 'posts') {
        eventData.event_chapter2 = this.postData3.data.heading.id
        eventData.event_name = this.postData3.slug
      } else if (this.postData3.type === 'meta-medias') {
        eventData.event_chapter2 = 'metamedias'
        eventData.event_name = this.postData3.data.title
      } else if (this.postData3.type === 'tests') {
        eventData.event_chapter2 = 'tests'
        eventData.event_name = this.postData3.data.slug
      }

      this.$trackEvent('click', e.target, eventData)

      if (this.postData3.data.url) {
        window.open(this.post.block3.data.url, '_blank')
      } else if (this.postData3.type === 'posts') {
        this.$router.push(
          this.localeRoute({
            name: `articles-slug`,
            params: { slug: this.postData3.meta.slug[this.$i18n.locale] },
          })
        )
      } else if (this.postData3.type === 'tests') {
        this.$router.push(
          this.localeRoute({
            name: `tests-slug`,
            params: {
              slug: this.postData3.meta.slug[this.$i18n.locale],
            },
          })
        )
      }
    },

    playVideo() {
      document.getElementById('videoIframe').src += '&autoplay=1'
    },
    stopVideo() {
      const ytbsrc = document.getElementById('videoIframe').src
      const newsrc = ytbsrc.replace('&autoplay=1', '')
      document.getElementById('videoIframe').src = newsrc
    },
    playVideo3() {
      document.getElementById('videoIframe3').src += '&autoplay=1'
    },
    stopVideo3() {
      const ytbsrc = document.getElementById('videoIframe3').src
      const newsrc = ytbsrc.replace('&autoplay=1', '')
      document.getElementById('videoIframe3').src = newsrc
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
