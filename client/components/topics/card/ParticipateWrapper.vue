<template>
  <div
    class="flex flex-nowrap desktop:px-16 mt-12 tablet:px-5 mobile:px-5 overflow-x-scroll w-full mobile:w-screen"
  >
    <CardParticipate
      v-for="(post, index) in participateposts"
      :key="index"
      :article="post.article"
      :description="post.description"
      :button="post.button"
      :size="cardSize(index)"
      tabindex="0"
    />
  </div>
</template>

<script>
import CardParticipate from './CardParticipate.vue'
export default {
  name: 'ParticipateWrapper',
  components: {
    CardParticipate,
  },
  props: {
    participateposts: {
      type: Array,
      required: true,
    },
  },
  methods: {
    cardSize(index) {
      if (this.$mq === 'desktop') {
        if (index.lenght >= 2) {
          return 'small'
        } else if (index.lenght === 1) {
          return 'medium'
        } else {
          return 'large'
        }
      } else if (this.$mq === 'tablet' || this.$mq === 'mobile') {
        if (index.lenght === 2) {
          return 'medium'
        } else {
          return 'large'
        }
      } else {
        return 'large'
      }
    },
  },
}
</script>
