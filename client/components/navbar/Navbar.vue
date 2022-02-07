<template>
  <div>
    <div v-if="$device.isDesktop">
      <NavbarMetanav />
      <NavbarDesktop :topics="topics" />
    </div>
    <NavbarMobile v-else :topics="topics" />
  </div>
</template>

<script>
export default {
  name: 'Navbar',
  data() {
    return {
      topics: {},
    }
  },
  async fetch() {
    try {
      const topics = await this.$axios.$get(`/headings`, {
        params: { lang: this.$i18n.locale },
      })
      this.topics = topics.data
    } catch (err) {
      throw new Error(err.message)
    }
  },
  computed: {
    getCurrentLocal() {
      return this.$i18n.locale
    },
  },
  watch: {
    getCurrentLocal() {
      this.$fetch()
    },
  },
}
</script>
