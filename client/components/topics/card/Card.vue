<template>
  <article
    class="hover:cursor-pointer desktop:w-1/3 desktop:p-8 tablet:w-1/2 mobile:w-full tablet:p-4 mobile:p-4"
    tabindex="0"
  >
    <div class="flex flex-col h-full justify-between">
      <!-- Tag & Age -->
      <div class="flex flex-row mb-2 items-center">
        <ul class="flex flex-wrap widthMax">
          <li v-for="tag in tags" :key="tag" class="flex font-bold">
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
          class="ml-3 px-1 py-px rounded border border-gray text-common-legend min-w-max"
          tabindex="0"
        >
          <p v-if="age && $i18n.locale === 'fr'" :aria-label="age.fr">
            {{ age.fr }}
          </p>
          <p v-if="age && $i18n.locale === 'en'" :aria-label="age.en">
            {{ age.en }}
          </p>
        </div>
      </div>
      <!-- Title -->
      <h3
        v-if="title"
        class="max-w font-normal"
        :aria-label="title"
        tabindex="0"
        @click="goToPost($event)"
      >
        {{ title }}
      </h3>

      <!-- IMAGE -->
      <div
        id="imgCard"
        class="flex relative h-full bg-cover bg-center hover:cursor-pointer mt-5 items-end"
      >
        <div
          v-if="image"
          class="flex relative w-full h-60 bg-cover bg-center items-end justify-center hoverBtn"
          :class="{
            '-mx-4 tablet:mx-0 mobile:mx-0': !$route.name.includes('index'),
          }"
          :alt="post.data.featuredalt"
          :style="backgroundImage"
          @click="goToPost($event)"
        >
          <button
            class="absolute bottom-16 bg-white rounded-full px-8 py-2 text-common-regular"
            :aria-label="$t('topics.goToPost')"
          >
            {{ $t('topics.goToPost') }}
          </button>
        </div>
      </div>
    </div>
  </article>
</template>

<script>
export default {
  name: 'TopicCard',
  props: {
    post: {
      type: Object,
      required: true,
    },
    title: {
      type: String,
      default: null,
    },
    tags: {
      type: Array,
      required: true,
    },
    age: {
      type: Object,
      default: null,
    },
    image: {
      type: String,
      default: null,
    },
  },
  computed: {
    backgroundImage() {
      return {
        'background-image':
          'url(' +
          this.$config.IMAGES_DIRECTORY +
          (this.image || this.post.data.featured) +
          ')',
      }
    },
  },
  methods: {
    goToPost(e) {
      if (this.post.type === 'posts') {
        this.$router.push(
          this.localeRoute({
            name: `articles-slug`,
            params: {
              slug: this.post.meta.slug[this.$i18n.locale],
            },
          })
        )
      } else if (this.post.type === 'tests') {
        this.$router.push(
          this.localeRoute({
            name: `tests-slug`,
            params: {
              slug: this.post.meta.slug[this.$i18n.locale],
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
li > a::first-letter {
  text-transform: uppercase;
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

#imgCard {
  transition: 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
}
#imgCard:hover {
  transform: scale(1.03);
}
.widthMax {
  max-width: 85%;
}
</style>
