<template>
  <section
    class="relative flex flex-col justify-center items-center text-center px-6 desktop:px-0 z-0"
    :class="{
      'text-white': !textBlack,
      'text-dark': textBlack,
    }"
    :style="{ 'background-color': background }"
  >
    <!-- Topic -->
    <Title 
          tag="h2" :title="title" :underline="underline" class="text-center" />

    <!-- Description -->
    <p
      v-if="description"
      class="font-bold text-desktop-regular tablet:max-w-xl mt-4"
    >
      {{ description }}
    </p>

    <p
      v-if="descriptionHTML"
      class="font-bold text-desktop-regular tablet:max-w-xl mt-4"
      v-html="descriptionHTML"
    ></p>

    <hr
      class="border-4 px-10 mt-8"
      :class="{ 'border-white': !textBlack, 'border-dark': textBlack }"
    />
  </section>
</template>

<script>
export default {
  name: 'TopicBanner',
  props: {
    title: {
      type: String,
      required: true,
    },
    description: {
      type: String,
      default: null,
    },
    descriptionHTML: {
      type: String,
      default: null,
    },
    textBlack: {
      type: Boolean,
      default: false,
    },
    background: {
      type: String,
      required: true,
    },
    underline: {
      type: String,
      required: true,
    },
  },
}
</script>

<style lang="postcss" scoped>
.underline {
  z-index: -1;
}

p >>> a {
  @apply underline;
}
</style>
