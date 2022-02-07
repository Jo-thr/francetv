<template>
  <div>
    <div class="flex flex-wrap w-full">
      <TopicCard
        v-for="(post, index) in filteredPosts"
        :key="index"
        tabindex="0"
        :post="post"
        :image="post.data.featured"
        :title="post.data.title"
        :tags="post.tags.data"
        :age="post.data.age"
      />
    </div>
    <div v-if="$mq === 'mobile'">
      <ButtonCardWrapper
        v-if="posts && limitMobile < posts.length"
        class="desktop:ml-8 tablet:ml-4 mobile:ml-4 mb-16"
        :cta="cta"
        @click="displayMore()"
      />
    </div>
    <div v-else>
      <ButtonCardWrapper
        v-if="posts && limit < posts.length"
        class="desktop:ml-8 tablet:ml-4 mobile:ml-4 mb-16"
        :cta="cta"
        @click="displayMore()"
      />
    </div>
  </div>
</template>

<script>
import TopicCard from './Card.vue'
import ButtonCardWrapper from './Button.vue'

export default {
  name: 'WrapperTopicCard',
  components: {
    TopicCard,
    ButtonCardWrapper,
  },
  props: {
    posts: {
      type: Array,
      required: true,
    },
    cta: {
      type: String,
      default: null,
    },
    postsPage: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      limit: 6,
      limitMobile: 3,
    }
  },

  computed: {
    filteredPosts() {
      if (this.$mq === 'mobile') {
        return this.limitMobile
          ? this.posts.slice(0, this.limitMobile)
          : this.posts
      } else {
        return this.limit ? this.posts.slice(0, this.limit) : this.posts
      }
    },
  },
  methods: {
    displayMore() {
      if (this.$mq === 'mobile') {
        this.$emit('display-more')
        this.limitMobile += 3
      } else {
        this.$emit('display-more')
        this.limit += 6
      }
    },
  },
}
</script>
