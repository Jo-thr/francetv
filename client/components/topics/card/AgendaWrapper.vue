<template>
  <div class="flex flex-wrap">
    <AgendaCard
      v-for="(post, index) in filteredPosts"
      :key="index"
      :post="post"
      tabindex="0"
    />
    <ButtonCardWrapper
      v-if="limit < postsArticle.length"
      class="desktop:ml-8 tablet:ml-4 mobile:ml-4 mb-16"
      :cta="$t('topics.calltoaction')"
      :aria-label="$t('topics.calltoaction')"
      @click="displayMore()"
    />
  </div>
</template>

<script>
import AgendaCard from './AgendaCard.vue'
import ButtonCardWrapper from './Button.vue'
export default {
  name: 'AgendaWrapper',
  components: {
    AgendaCard,
    ButtonCardWrapper,
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
    }
  },
  computed: {
    postsArticle() {
      return this.posts.filter((postWithArticle) => {
        return postWithArticle.article != null
      })
    },

    filteredPosts() {
      return this.limit
        ? this.postsArticle.slice(0, this.limit)
        : this.postsArticle
    },
  },
  methods: {
    displayMore() {
      this.$emit('display-more')
      this.limit += 3
    },
  },
}
</script>
