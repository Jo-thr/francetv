<template>
  <div class="min-h-screen flex flex-col">
    <a href="#main-container" accesskey="4" title="Accéder au contenu principal"
      ><span class="sr-only">Accéder au contenu principal</span></a
    >
    <Navbar />
    <main id="main-container" class="flex-1 pb-24" role="main">
      <Nuxt keep-alive />
    </main>
    <Footer />
  </div>
</template>

<script>
export default {
  head() {
    return this.$nuxtI18nSeo()
  },
}
</script>

<style lang="postcss">
/* Routing transition */
.page-enter-active,
.page-leave-active {
  transition: opacity 0.2s;
}
.page-enter,
.page-leave-to {
  opacity: 0;
}

html {
  @apply font-ftv text-dark bg-white text-mobile-regular tablet:text-desktop-regular;
}
</style>
