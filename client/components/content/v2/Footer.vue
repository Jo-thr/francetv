<template>
  <div class="flex flex-col">
    <!-- IDEAS, SHARE, DOWNLOAD -->
    <div
      class="flex tablet:flex-row justify-start tablet:items-center py-6 border-t border-gray mobile:flex-col mobile:items-start"
    >
      <!-- DOSSIER DE PRESSE : MOBILE -->
      <div
        v-if="post.data.press"
        class="flex flex-row items-center ml-6 hover:cursor-pointer mobile:ml-2 mobile:pb-6 tablet:hidden desktop:hidden"
      >
        <a
          :href="$config.IMAGES_DIRECTORY + post.data.press"
          :download="post.data.press"
          target="_blank"
          class="flex flex-row items-center"
        >
          <img class="mb-0.5" src="~/assets/img/icons/folder.svg" />
          <div class="pl-3">{{ $t('posts.footer.folder') }}</div>
        </a>
      </div>
      <!-- Bright ideas -->
      <div
        class="flex flex-row mr-6 items-center tablet:ml-0 mobile:mr-0 mobile:ml-2"
      >
        <div v-if="post.type !== 'tests'" class="flex flex-col items-center">
          <button
            :alt="$t('accessibilite.img-alt.icon-idee')"
            @click="claps($event)"
          >
            <img class="mb-0.5" src="~/assets/img/icons/ampoule.svg" />
          </button>
          <span
            class="text-blue font-black text-common-legend"
            aria-live="polite"
            >{{ numberOfClaps }}</span
          >
        </div>
        <div
          class="ml-3 text-blue hover:cursor-pointer"
          :aria-label="$t('posts.footer.like')"
          tabindex="0"
          @click="claps($event)"
        >
          {{ $t('posts.footer.like') }}
        </div>
      </div>
      <!-- Share -->
      <LinkShare
        :post="post"
        orientation="vertical"
        class="tablet:px-6 mobile:px-0 tablet:pt-0 mobile:pt-6"
        @shared="$emit('shared')"
      />

      <!-- DOSSIER DE PRESSE DESKTOP & TABLETTE -->
      <div
        v-if="post.data.press"
        class="flex ml-6 hover:cursor-pointer mobile:ml-2 mobile:pt-6 tablet:pt-0 tablet:flex mobile:hidden"
      >
        <a
          :href="$config.IMAGES_DIRECTORY + post.data.press"
          :download="post.data.press"
          target="_blank"
          class="flex flex-row items-center"
        >
          <img class="mb-0.5" src="~/assets/img/icons/folder.svg" />
          <div class="pl-3">{{ $t('posts.footer.folder') }}</div>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import LinkShare from './Share.vue'
import { debounce } from '~/utils/debounce'

export default {
  name: 'FooterEditorJs',
  components: {
    LinkShare,
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

    download() {
      const url = this.$config.IMAGES_DIRECTORY + this.post.data.press
      window.open(url, '_blank')
    },
  },
}
</script>
