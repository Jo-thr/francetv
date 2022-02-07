<template>
  <article
    class="hover:cursor-pointer"
    :class="{
      'w-full tablet:w-1/2 mobile:py-2 tablet:p-2': size === 'large',
      'w-full tablet:w-1/3 mobile:py-2 tablet:p-2': size === 'medium',
      'w-full tablet:w-1/3 desktop:w-1/4 mobile:py-2 tablet:p-2':
        size === 'small',
    }"
    tabindex="0"
    @mouseover="hover = true"
    @mouseleave="hover = false"
    @click="goToPost($event)"
  >
    <div
      class="flex overflow-hidden hover:shadow-lg transition-shadow duration-300 bg-white h-full"
      :class="{
        'flex-col': size === 'large' || size === 'medium',
        'flex-row tablet:flex-col': size === 'small',
      }"
    >
      <!-- Image section -->
      <div
        class="relative"
        :class="{
          'w-1/3 tablet:w-full': size === 'small',
          'card-hover transition-colors duration-300': hover,
        }"
      >
        <div
          v-if="post.data.url"
          class="absolute bottom-0 left-0 bg-blue tablet:p-1"
          :class="{ 'z-10': hover }"
        >
          <!-- Logo external link -->
          <img
            src="~/assets/img/icons/arrow-up-right.svg"
            aria-hidden="true"
            :alt="$t('accessibilite.img-alt.logo-lien-externe')"
          />
        </div>

        <!-- Pictogramme -->
        <div
          v-if="post.pictogram && !post.data.url"
          class="absolute top-0 right-0 bg-white p-1"
          :class="{
            'top-0 left-0 right-auto': size === 'small' && $mq === 'mobile',
            'z-10': hover,
          }"
        >
          <img
            :src="$config.IMAGES_DIRECTORY + post.pictogram.image"
            :alt="post.pictogram.name"
            aria-hidden="true"
            class="h-4"
          />
        </div>

        <!-- Sponsor -->
        <div
          v-if="post.sponsor && !post.data.url"
          class="absolute top-0 right-0 bg-white p-1"
          :class="{
            'top-0 left-0 right-auto': size === 'small' && $mq === 'mobile',
            'z-10': hover,
          }"
        >
          <img
            :src="$config.IMAGES_DIRECTORY + post.sponsor.image"
            aria-hidden="true"
            class="h-4"
          />
        </div>

        <!-- Image -->
        <img
          v-if="displayImage"
          class="object-cover object-center"
          aria-hidden="true"
          :class="{
            'w-full tablet:h-56 desktop:h-80': size === 'large',
            'w-full tablet:h-40 desktop:h-56': size === 'medium',
            'w-full h-full tablet:w-full tablet:h-40': size === 'small',
            'opacity-50 transition-opacity duration-300': hover,
          }"
          :src="displayImage"
        />
      </div>

      <!-- Text section -->
      <div
        class="flex flex-col items-start flex-1"
        :class="{
          'p-3 tablet:p-5': size === 'small',
          'p-5': size !== 'small',
        }"
      >
        <!-- Topic -->
        <nuxt-link
          v-if="post.data.heading && !$route.name.includes('topics')"
          :aria-label="'Aller à la catégorie ' + post.data.heading.data.label"
          class="text-common-legend inline-block mb-2 tablet:text-common-regular text-gray-dark underline hover:text-blue transition-all duration-300 hover:font-bold"
          :class="{
            'tablet:mb-4': size === 'large' || size === 'medium',
            'tablet:mb-3': size === 'small',
          }"
          :to="
            localePath({
              name: 'topics-slug',
              params: { slug: post.data.heading.meta.slug[$i18n.locale] },
            })
          "
          @click.native.stop
        >
          {{ post.data.heading.data.label }}
        </nuxt-link>

        <!-- Title -->
        <h2
          v-if="post.data.title || highlightTitle"
          class="mb-2"
          :class="{
            'tablet:mb-4 text-mobile-h3 tablet:text-desktop-h3':
              size === 'large',
            'tablet:mb-4 text-mobile-h5 tablet:text-mobile-h2':
              size === 'medium',
            'tablet:mb-3 text-mobile-h5': size === 'small',
          }"
          :style="lineLimit(3, 'title')"
        >
          {{ highlightTitle || post.data.title }}
        </h2>

        <!-- Description -->
        <p
          v-if="showDescription"
          class="mb-2 tablet:mb-4"
          :class="{
            'tablet:mb-4 text-common-tag tablet:text-common-regular':
              size === 'large' || size === 'medium',
            'tablet:mb-3': size === 'small',
          }"
          :style="lineLimit(3, 'description')"
          v-html="
            post.data.description ? post.data.description : post.data.excerpt
          "
        >
          {{
            post.data.description ? post.data.description : post.data.excerpt
          }}
        </p>

        <div
          class="flex items-center justify-between mt-auto w-full"
          :class="{
            'flex-col items-baseline justify-start':
              size === 'small' && $mq === 'mobile',
          }"
        >
          <!-- Type & Time -->
          <div
            v-if="showTypeTime"
            class="text-gray-dark text-common-legend tablet:text-common-tag mb-2 tablet:mb-0"
          >
            <span v-if="post.data.type" class="uppercase">{{
              $t(`posts.types.${post.data.type}`)
            }}</span>
            <span v-if="post.data.type && post.data.time">|</span>
            <span
              v-if="post.data.time"
              :aria-hidden="true"
              :aria-labelledby="post.data.time + ' minute'"
              >{{ post.data.time }} {{ $tc('posts.cards.min') }}</span
            >
          </div>

          <!-- Tag -->
          <Tag v-if="showTag" :tag="post.tags.data[0]" @click.native.stop />
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
    size: {
      type: String,
      default: 'medium',
    },
    highlight: {
      type: Boolean,
      default: false,
    },
    highlightTitle: {
      type: String,
      default: null,
    },
    index: {
      type: Number,
      default: null,
    },
    fromSearchQuery: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      hover: false,
    }
  },
  computed: {
    showTypeTime() {
      if (this.size === 'small' && this.$mq === 'mobile') {
        return false
      } else if (this.post.data.type || this.post.data.time) {
        return true
      } else {
        return false
      }
    },
    showTag() {
      if (
        this.post.tags &&
        this.post.tags.data[0] &&
        !this.$route.name.includes('tags')
      ) {
        return true
      } else {
        return false
      }
    },
    showDescription() {
      if (!this.post.data.description && !this.post.data.excerpt) {
        return false
      } else if (this.highlight) {
        return false
      } else if (this.size === 'small') {
        return false
      } else if (this.$mq === 'mobile' && this.size === 'medium') {
        return false
      }

      return true
    },
    displayImage() {
      if (this.post.data.image) {
        return this.post.data.image
      } else if (this.post.data.featured) {
        return this.$config.IMAGES_DIRECTORY + this.post.data.featured
      } else {
        return null
      }
    },
  },
  methods: {
    lineLimit(maxLine, from) {
      let max = maxLine

      if (this.$mq === 'mobile' && (from === 'title' || from === 'description'))
        max--

      return `overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: ${max}; -webkit-box-orient: vertical;`
    },
    goToPost(e) {
      if (this.$route.name.includes('recherche')) {
        this.$wrapper.setTcVars({
          offre: 'lab',
          categorie: 'recherche',
          nom_page: 'selection_resultat',
          langue: `[${this.$i18n.locale.toUpperCase()}]`,
          keyword_moteur_interne: this.fromSearchQuery,
          numero_page_resultats: Math.round(this.index / 15) + 1,
          result_position: this.index,
        })
      }

      if (this.highlight) {
        const eventData = {
          event_chapter1: 'mise_en_avant',
          event_chapter2: null,
          event_name: this.post.slug,
        }

        if (this.post.type === 'posts') {
          eventData.event_chapter2 = this.post.data.heading.id
        } else if (this.post.type === 'meta-medias') {
          eventData.event_chapter2 = 'metamedias'
        } else if (this.post.type === 'tests') {
          eventData.event_chapter2 = 'tests'
        }

        this.$trackEvent('click', e.target, eventData)
      }

      if (this.post.data.url) {
        if (this.post.type === 'meta-medias') {
          this.$trackEvent('click', e.target, {
            event_chapter1: 'article_metamedia',
            event_name: this.post.data.title,
          })
        } else {
          this.$trackEvent('click', e.target, {
            event_chapter1: 'article_externe',
            event_name: this.post.data.title,
          })
        }

        window.open(this.post.data.url, '_blank')
      } else if (this.post.type === 'posts') {
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
.card-hover {
  background: rgba(0, 35, 255, 0.5);
}
</style>
