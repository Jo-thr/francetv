<template>
  <div class="flex flex-row items-center">
    <ul class="flex flex-row items-center list w-max">
      <li
        v-for="star in maxStars"
        :key="star"
        :class="{ active: star <= stars }"
        class="star h-4 w-4 mr-1"
      ></li>
    </ul>
    <span v-if="hasCounter" class="flex ml-2"
      >{{ stars }} / {{ maxStars }} {{ where }}</span
    >
  </div>
</template>

<script>
export default {
  name: 'Ratings',
  props: {
    grade: {
      type: Number,
      required: true,
    },
    maxStars: {
      type: Number,
      default: 5,
    },
    hasCounter: {
      type: Boolean,
      default: true,
    },
    where: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      stars: this.grade,
      On: '../../../assets/img/icons/star.svg',
      Off: '~/assets/img/icons/star-o.svg',
    }
  },
}
</script>

<style lang="postcss" scoped>
.list {
  list-style-type: none;
}
.star {
  display: inline-block;
  color: #f3d23e;
  background-image: url(~/assets/img/icons/star-o.svg);
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
}
.list:hover .star {
  color: #f3d23e;
}
.star:hover ~ .star:not(.active) {
  color: inherit;
}
.active {
  color: #f3d23e;
  background-image: url(~/assets/img/icons/star.svg);
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
}
</style>
