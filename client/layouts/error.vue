<template>
  <div class="container pt-16 tablet:pt-24 text-center px-4 tablet:px-0">
    <h1 class="text-mobile-h3 tablet:text-desktop-h3">
      {{ $t('erreurs.404') }}
    </h1>
    <!-- <h1 v-else class="text-mobile-h3 tablet:text-desktop-h3">
      {{ $t('erreurs.default') }}
    </h1> -->
    <NuxtLink
      :to="localePath('/')"
      class="mt-12 inline-block rounded-button hover:bg-blue hover:border-blue transition-all duration-500 text-black border-black hover:text-white text-common-body-ftv px-5 py-2 border-2"
      >{{ $t('erreurs.retour-accueil') }}</NuxtLink
    >
  </div>
</template>

<script>
export default {
  props: { error: { type: Object, default: null } },
  head() {
    return this.$nuxtI18nSeo()
  },
  mounted() {
    this.$wrapper.setTcVars({
      offre: 'lab',
      categorie: 'erreur',
      sous_category: this.error.statusCode,
      langue: `[${this.$i18n.locale.toUpperCase()}]`,
    })
  },
}
</script>
