<template>
  <div class="mt-8">
    <button
      class="bg-blue text-white py-2 px-6 Btn"
      :aria-label="cta"
      @click="$emit('click')"
    >
      {{ cta }}
    </button>
  </div>
</template>

<script>
export default {
  name: 'ButtonCardWrapper',
  props: {
    cta: {
      type: String,
      default: null,
    },
  },
}
</script>

<style scoped>
.Btn {
  transition: 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
}
.Btn:hover {
  transform: scale(1.05);
}
</style>
