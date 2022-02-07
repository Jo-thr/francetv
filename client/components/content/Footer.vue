<template>
  <div class="flex flex-col items-center">
    <hr aria-hidden="true" class="border-4 border-dark px-10 mb-8" />
    <!-- Name -->
    <p
      v-if="post.type !== 'tests' && post.author.name"
      class="mb-1 text-common-regular"
    >
      {{ $t('posts.footer.auteur') }} {{ post.author.name }}
    </p>

    <div
      v-if="post.type !== 'tests' && !post.author.name"
      class="mb-2 flex flex-col items-center"
    >
      <p
        v-for="(author, index) in post.author"
        :key="index"
        class="mb-1 text-common-regular"
      >
        <span v-if="index === 0">{{ $t('posts.footer.auteur') }}</span>
        {{ author }}
      </p>
    </div>

    <!-- Sponsor -->
    <div
      v-if="post.type === 'tests' && post.sponsor"
      class="flex mb-2 items-center"
    >
      <span class="mr-2 text-common-regular">{{
        $t('posts.footer.teste_avec')
      }}</span>
      <img
        class="h-4"
        :src="$config.IMAGES_DIRECTORY + post.sponsor.image"
        :alt="post.sponsor.name"
      />
    </div>

    <!-- Date -->
    <p class="mb-8 text-gray-dark text-footer text-common-legend">
      {{ $t('posts.footer.date') }}
      {{ $dayjs(post.data.published_at).locale($i18n.locale).format('LL') }}
    </p>

    <!-- Share -->
    <ContentShare
      :post="post"
      orientation="vertical"
      class="mb-8"
      @shared="$emit('shared')"
    />

    <!-- Bright ideas -->
    <div v-if="post.type !== 'tests'" class="mb-8 flex flex-col items-center">
      <button
        :alt="$t('accessibilite.img-alt.icon-idee')"
        @click="claps($event)"
      >
        <img class="mb-3" src="~/assets/img/icons/ampoule.svg" />
      </button>
      <span class="text-gray-dark text-common-legend" aria-live="polite">{{
        $tc('posts.footer.clap', numberOfClaps)
      }}</span>
    </div>

    <!-- Tag -->
    <div class="flex flex-col items-center">
      <Tag
        v-for="tag in post.tags.data"
        :key="tag.id"
        :tag="tag"
        class="mb-2"
      />
    </div>
  </div>
</template>

<script>
import { debounce } from '~/utils/debounce'
import ContentShare from '~/components/content/Share.vue'

export default {
  name: 'ContentFooter',
  components: {
    ContentShare,
  },
  props: {
    post: { type: Object, required: true },
  },
  data() {
    return {
      numberOfClaps: 0,
    }
  },
  mounted() {
    this.numberOfClaps = this.post.data.claps
  },
  methods: {
    claps: debounce(function (e) {
      this.numberOfClaps = this.numberOfClaps + 1
      this.$axios.patch(`/posts/${this.post.id}`)
      this.$trackEvent('click', e.target, {
        event_chapter1: 'article',
        event_chapter2: 'clap',
        event_name: this.post.slug,
      })
    }, 250),
  },
}
</script>
