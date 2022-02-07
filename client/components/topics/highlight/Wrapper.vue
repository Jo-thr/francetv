<template>
  <div>
    <!-- FIRST MEA -->
    <TopicsHighlight
      v-if="layout.primary && layout.primary.block1"
      class="desktop:mb-24 tablet:mb-24"
      :post="layout.primary"
      tabindex="0"
    />

    <!-- SECOND & THIRD MEA -->
    <TopicsSecondary
      v-if="layout.primary && layout.primary.block2 && layout.primary.block3"
      class="desktop:mx-24 mobile:mx-0 tablet:mx-0 tablet:mb-24 tablet:mt-0 mobile:mt-20"
      :post="layout.primary"
    />
    <!-- FOURTH OPTIONAL MEA -->
    <TopicsOptional
      v-if="layout.primary.block4"
      class="desktop:mx-24 mobile:mx-0 tablet:mx-0"
      :post="layout.primary"
      tabindex="0"
    />
  </div>
</template>

<script>
import TopicsHighlight from './Highlight.vue'
import TopicsSecondary from './Secondary.vue'
import TopicsOptional from './Optional.vue'

export default {
  name: 'TopicsWrapper',
  components: {
    TopicsHighlight,
    TopicsSecondary,
    TopicsOptional,
  },
  props: {
    layout: {
      type: Object,
      required: true,
    },
  },
}
</script>
