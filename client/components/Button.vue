<template>
  <button
    type="button"
    class="rounded-button hover:bg-blue hover:border-blue transition-all duration-500"
    :class="btnClass"
    :disabled="isDisabled"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>
<script>
export default {
  name: 'Button',
  props: {
    type: {
      type: String,
      default: 'primary',
    },
    size: {
      type: String,
      default: 'medium',
    },
    isDisabled: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    btnClass() {
      const classes = []

      if (this.size === 'small') {
        classes.push('text-common-legend px-4 py-2 border')
      } else if (this.size === 'medium') {
        classes.push('text-common-body-ftv px-5 py-2 border-2')
      } else if (this.size === 'large') {
        classes.push('font-bold text-desktop-h4 px-6 py-2 border-3')
      }

      if (this.type === 'primary') {
        classes.push('bg-dark border-black text-white')
      } else if (this.type === 'secondary-black') {
        classes.push('text-black border-black hover:text-white')
      } else if (this.type === 'secondary-white') {
        classes.push('text-white border-white hover:text-white')
      }

      if (this.isDisabled) {
        classes.push(
          'cursor-not-allowed bg-gray-dark border-gray-dark text-white hover:bg-gray-dark hover:border-gray-dark'
        )
      }

      return classes.join(' ')
    },
  },
}
</script>
