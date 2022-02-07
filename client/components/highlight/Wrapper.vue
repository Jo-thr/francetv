<template>
  <div>
    <Highlight
      v-if="layout.primary && layout.primary.block1"
      class="mb-10 tablet:mb-5"
      :post="layout.primary"
    />

    <div v-if="secondaryBlock" class="container px-4 tablet:px-0">
      <HighlightSecondary
        v-if="secondaryBlock === 'default'"
        class="flex flex-wrap mb-16 tablet:-mx-2"
        :posts="layout.secondary"
      />

      <HighlightContribution
        v-if="secondaryBlock === 'contribution'"
        class="mb-16"
        :contribution="layout.secondary"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: 'HighlightWrapper',
  props: {
    layout: {
      type: Object,
      required: true,
    },
  },
  computed: {
    secondaryBlock() {
      if (this.layout.secondary.block2 || this.layout.secondary.block3) {
        if (this.layout.secondary.block2.category === 'contribution') {
          return 'contribution'
        } else if (
          this.layout.secondary.block2 &&
          this.layout.secondary.block3
        ) {
          return 'default'
        } else {
          return null
        }
      } else {
        return null
      }
    },
  },
}
</script>
