<template>
  <nuxt-link
    :to="
      localePath({
        name: 'tags-slug',
        params: { slug: tag.data.slug },
      })
    "
    :aria-label="'Aller au tag ' + tag.data.name"
    ><span
      class="text-common-tag desktop:text-common-body-ftv bg-yellow px-2 py-1 hover:bg-blue hover:text-white hover:font-bold"
      >{{ tag.data.name }}</span
    >
  </nuxt-link>
</template>

<script>
export default {
  name: 'Tag',
  props: {
    tag: {
      type: Object,
      required: true,
    },
  },
}
</script>
