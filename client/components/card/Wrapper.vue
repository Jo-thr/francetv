<template>
  <div>
    <div id="btnClicked" class="flex flex-wrap">
      <Card
        v-for="(post, index) in filteredPosts"
        :key="index"
        tabindex="0"
        :post="post"
        :index="index + 1"
        :size="cardSize(index)"
        :from-search-query="fromSearchQuery"
      />
    </div>

    <!-- Button display more -->
    <Button
      v-if="postsPage && limit < postsPage.total"
      class="mx-auto block mt-12"
      aria-label="Afficher plus d’articles, bouton"
      @click="displayMore() + focusNewCard()"
      >{{ $t('posts.afficher-plus') }}</Button
    >
  </div>
</template>

<script>
export default {
  name: 'CardsWrapper',
  props: {
    posts: {
      type: Array,
      required: true,
    },
    postsPage: {
      type: Object,
      default: null,
    },
    fromSearchQuery: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      limit: 15,
    }
  },
  computed: {
    filteredPosts() {
      if (this.postsPage) {
        return this.posts.filter((el, index) => index < this.limit)
      } else {
        return this.posts
      }
    },
  },
  methods: {
    cardSize(currentIndex) {
      if (this.$mq === 'desktop' && currentIndex > 0) {
        if ((currentIndex + 1) % 5 === 0 || (currentIndex + 2) % 5 === 0) {
          return 'large'
        } else {
          return 'medium'
        }
      } else if (this.$mq === 'mobile' && currentIndex > 0) {
        if ((currentIndex + 1) % 5 === 0) {
          return 'large'
        } else {
          return 'small'
        }
      } else {
        return 'medium'
      }
    },
    displayMore() {
      this.$emit('display-more')
      this.limit += 15
    },
    focusNewCard() {
      document.getElementById('btnClicked').lastElementChild.focus()
    },
  },
}
</script>
