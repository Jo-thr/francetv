<template>
  <article
    class="hover:cursor-pointer desktop:w-1/3 desktop:p-8 tablet:w-1/2 mobile:w-full tablet:p-4 mobile:p-4"
    tabindex="0"
  >
    <div class="flex flex-col h-full justify-between">
      <!-- Tag -->
      <div class="flex flex-row mb-2 items-center">
        <ul class="flex flex-wrap widthMax">
          <li
            v-for="tag in post.tags.data"
            :key="tag.data.slug"
            class="uppercase font-bold"
          >
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
      </div>
      <!-- Title -->
      <h3
        class="max-w font-normal"
        :aria-label="post.data.title"
        tabindex="0"
        @click="goToPost($event)"
      >
        {{ post.data.title }}
      </h3>

      <!-- IMAGE -->
      <div
        id="imgCard"
        class="flex relative h-full bg-cover bg-center hover:cursor-pointer mt-5 items-end"
      >
        <div
          class="flex relative w-full h-60 bg-cover bg-center items-end justify-center hoverBtn"
          :class="{
            '-mx-4 tablet:mx-0 mobile:mx-0': !$route.name.includes('index'),
          }"
          :alt="post.featuredalt"
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
  name: 'Card',
  props: {
    post: {
      type: Object,
      required: true,
    },
    title: {
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
          this.post.data.featured +
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

<style lang="postcss" scoped>
li:last-child span {
  display: none;
}

.hoverBtn button {
  opacity: 0;
  transition: transform 0.5s cubic-bezier(0.645, 0.045, 0.355, 1),
    opacity 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
}
.hoverBtn:hover button {
  opacity: 1;
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
