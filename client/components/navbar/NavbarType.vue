<template>
  <header class="py-5 text-gray-darker relative shadow-sm" role="banner">
    <!-- Logo -->

    <nav class="flex justify-center items-center flex-wrap" role="navigation">
      <nuxt-link
        to=""
        class="uppercase common-body-ftv mx-5"
        :class="{ 'bg-blue text-white px-2 py-1 ': currentType }"
        >{{ $t('posts.types.voir') }}</nuxt-link
      >
      <nuxt-link to="" class="uppercase common-body-ftv mx-5">{{
        $t('posts.types.tester')
      }}</nuxt-link>
      <nuxt-link to="" class="uppercase common-body-ftv mx-5">{{
        $t('posts.types.lire')
      }}</nuxt-link>
      <nuxt-link to="" class="uppercase common-body-ftv mx-5">{{
        $t('posts.types.ecouter')
      }}</nuxt-link>
    </nav>
  </header>
</template>

<script>
export default {
  name: 'NavbarType',
  computed: {
    currentType() {
      return true
    },
  },
}
</script>
