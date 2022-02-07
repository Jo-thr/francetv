<template>
  <div>
    <Card
      :post="posts.block2"
      :highlight-title="posts.block2title"
      :highlight="true"
      size="large"
    />
    <Card
      :post="posts.block3"
      :highlight-title="posts.block3title"
      :highlight="true"
      size="large"
    />
  </div>
</template>

<script>
export default {
  name: 'HighlightSecondary',
  props: {
    posts: {
      type: Object,
      required: true,
    },
  },
}
</script>
