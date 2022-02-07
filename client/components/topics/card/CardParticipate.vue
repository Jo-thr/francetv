<template>
  <article
    v-if="article != null"
    class="relative flex flex-col desktop:mr-0 tablet:mr-4 mobile:mr-4"
    :class="{
      ' desktop:w-8/12 tablet:w-full mobile:w-full desktop:px-8 mobile:px-2':
        size === 'large',
      'desktop:w-1/2 tablet:w-1/2 mobile:w-full desktop:px-8 mobile:px-2  minWidth':
        size === 'medium',
      'desktop:w-1/3 tablet:w-1/2 mobile:w-full desktop:px-8 mobile:px-2  minWidth':
        size === 'small',
    }"
  >
    <div class="flex flex-col bg-blue text-white p-8 w-full minWidth">
      <h2
        v-if="article"
        class="relative float-left italic mb-5 w-full"
        tabindex="0"
        :aria-label="article.data.title"
      >
        {{ article.data.title }}
      </h2>
      <p
        v-if="description && $i18n.locale === 'fr'"
        class="relative pt-5 mb-10 border-white border-solid border-t w-full float-left descEllipsis"
      >
        {{ description.fr }}
      </p>
      <p
        v-if="description && $i18n.locale === 'en'"
        class="relative pt-5 mb-10 border-white border-solid border-t w-full float-left descEllipsis"
      >
        {{ description.en }}
      </p>
    </div>

    <button
      v-if="button && $i18n.locale === 'fr'"
      class="hover:cursor-pointer relative bg-yellow w-max ml-auto mr-8 py-4 px-6 text-black -top-10 float-right mobile:w-max mobile:mx-auto"
      :aria-label="button.fr"
      @click="goToPost($event)"
    >
      {{ button.fr }}
    </button>
    <button
      v-if="button && $i18n.locale === 'en'"
      class="hover:cursor-pointer relative bg-yellow w-max ml-auto mr-8 py-4 px-6 text-black -top-10 float-right mobile:w-max mobile:mx-auto"
      :aria-label="button.en"
      @click="goToPost($event)"
    >
      {{ button.en }}
    </button>
  </article>
</template>

<script>
export default {
  name: 'ParticipateCard',
  props: {
    article: {
      type: Object,
      default: null,
    },
    data: {
      type: Object,
      default: null,
    },
    title: {
      type: String,
      default: null,
    },
    index: {
      type: String,
      default: null,
    },
    description: {
      type: Object,
      default: null,
    },
    button: {
      type: Object,
      default: null,
    },
    size: {
      type: String,
      default: null,
    },
  },
  methods: {
    goToPost(e) {
      if (this.article.type === 'posts') {
        this.$router.push(
          this.localeRoute({
            name: `articles-slug`,
            params: {
              slug: this.article.meta.slug[this.$i18n.locale],
            },
          })
        )
      } else if (this.article.type === 'tests') {
        this.$router.push(
          this.localeRoute({
            name: `tests-slug`,
            params: {
              slug: this.article.meta.slug[this.$i18n.locale],
            },
          })
        )
      }
    },
  },
}
</script>

<style lang="scss" scoped>
.minWidth {
  min-width: 80vw;
  height: 353px;

  @screen tablet {
    min-width: 40vw;
    height: 353px;
  }

  @screen desktop {
    min-width: auto;
    height: 386px;
  }
}
.descEllipsis {
  @apply overflow-hidden font-normal;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 8;
  font-size: 14px;
  line-height: 22px;

  @screen tablet {
    @apply overflow-hidden font-normal;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 7;
    font-size: 14px;
    line-height: 22px;
  }

  @screen desktop {
    @apply overflow-hidden font-normal;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 7;
    font-size: 16px;
    line-height: 24px;
  }
}
</style>
