<template>
  <div
    v-if="contribution.block2.data.excerpt"
    class="bg-blue-light text-center py-12 px-4"
  >
    <h3 v-if="contribution.block2title" class="mb-2">
      {{ contribution.block2title }}
    </h3>
    <p v-if="contribution.block2.data.excerpt" class="mb-6 max-w-xl mx-auto">
      {{ contribution.block2.data.excerpt }}
    </p>
    <Button @click.native="goToContrib($event)">{{
      $t('contribution.participer')
    }}</Button>
  </div>
</template>

<script>
export default {
  name: 'HighlightContribution',
  props: {
    contribution: {
      type: Object,
      required: true,
    },
  },
  methods: {
    goToContrib(e) {
      this.$trackEvent('click', e.target, {
        event_chapter1: 'contribution',
        event_name: this.contribution.block2title,
      })

      this.$router.push(
        this.localeRoute({
          name: `articles-slug`,
          params: {
            slug: this.contribution.block2.meta.slug[this.$i18n.locale],
          },
        })
      )
    },
  },
}
</script>
