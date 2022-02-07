<template>
  <div class="py-6">
    <div class="flex flex-row items-center pb-6">
      <span class="tablet:flex mobile:hidden mr-3">{{
        $t('topics.store')
      }}</span>
      <!-- APPLE STORE -->
      <button v-if="store.apple.url" class="mr-3 mobile">
        <a :href="store.apple.url" target="_blank">
          <img src="~/assets/img/icons/app-store.svg"
        /></a>
      </button>
      <!-- GOOGLE PLAY -->
      <button v-if="store.google_url.url" class="mr-3">
        <a :href="store.google_url.url" target="_blank">
          <img src="~/assets/img/icons/google-play.svg"
        /></a>
      </button>
      <!-- OCULUS -->
      <button v-if="store.oculus_url.url" class="mr-3">
        <a :href="store.oculus_url.url" target="_blank">
          <img src="~/assets/img/icons/oculus.svg"
        /></a>
      </button>
    </div>

    <div class="flex tablet:flex-row flex-wrap mobile:flex-col max-w-3xl">
      <Ratings
        v-if="store.apple.rating"
        class="mr-7 tablet:mb-0 mobile:mb-2"
        :grade="store.apple.rating"
        :where="$t('topics.apple')"
      />
      <Ratings
        v-if="store.google_url.rating"
        class="mr-7 tablet:mb-0 mobile:mb-2"
        :grade="store.google_url.rating"
        :where="$t('topics.google')"
      />
      <Ratings
        v-if="store.oculus_url.rating"
        class="mr-7 tablet:mb-0 mobile:mb-2"
        :grade="store.oculus_url.rating"
        :where="$t('topics.oculus')"
      />
    </div>
  </div>
</template>

<script>
import Ratings from './Ratings.vue'

export default {
  name: 'Store',
  components: {
    Ratings,
  },
  props: {
    store: {
      type: Object,
      required: true,
    },
  },
}
</script>
