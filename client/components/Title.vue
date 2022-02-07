<template>
  <div>
    <component
      :is="tag"
      class="relative mobile:text-mobile-h3 uppercase px-2 z-0 inline-block"
      :style="{ '--underline': underline }"
    >
      {{ title }}
    </component>
  </div>
</template>

<script>
export default {
  name: 'Title',
  props: {
    title: {
      type: String,
      required: true,
    },
    underline: {
      type: String,
      default: '#FCFC00',
    },
    textBack: {
      type: Boolean,
      default: false,
    },
    tag: {
      type: String,
      default: 'h1',
    },
  },
}
</script>

<style lang="postcss" scoped>
:is(h1, h2, h3, h4, h5, h6)::after {
  @apply absolute w-full bottom-4 left-0 h-3;

  background: var(--underline);
  content: '';
  z-index: -1;
}
</style>
