<template>
  <div>
    <div class="flex flex-wrap w-full">
      <OtherCard
        v-for="(post, index) in filteredPosts"
        :key="index"
        tabindex="0"
        :post="post"
      />
    </div>
  </div>
</template>

<script>
import OtherCard from './Card.vue'

export default {
  name: 'WrapperOthersPosts',
  components: {
    OtherCard,
  },
  props: {
    posts: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      limit: 3,
      limitMobile: 4,
    }
  },
  computed: {
    filteredPosts() {
      if (this.$mq === 'tablet') {
        return this.limitMobile
          ? this.posts.slice(0, this.limitMobile)
          : this.posts
      } else {
        return this.limit ? this.posts.slice(0, this.limit) : this.posts
      }
    },
  },
}
</script>
