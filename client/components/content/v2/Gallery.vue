<template>
  <div v-viewer>
    <!-- Slider main container -->
    <div class="swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        <div
          v-for="item in gallery.filter(({ content }) => content)"
          :key="item.index"
          class="swiper-slide"
        >
          <figure>
            <img
              class="flex cursor-pointer h-120 mobile:h-64"
              :alt="item.content"
              :src="$config.IMAGES_DIRECTORY + item.content"
            />
            <figcaption
              class="text-gray-dark text-common-legend font-light mt-1"
            >
              {{ item.legend }}
            </figcaption>
          </figure>
        </div>
      </div>
      <button class="swiper-button swiper-button-prev">
        <img
          src="@/assets/img/icons/arrow-gallery.svg"
          width="80"
          height="auto"
          class="no-viewer"
        />
      </button>
      <button class="swiper-button swiper-button-next">
        <img
          src="@/assets/img/icons/arrow-gallery.svg"
          width="80"
          height="auto"
          class="no-viewer"
        />
      </button>
    </div>
  </div>
</template>

<script>
// eslint-disable-next-line import/no-named-as-default
import Swiper, { Navigation } from 'swiper'
Swiper.use([Navigation])

export default {
  name: 'Gallery',
  props: {
    gallery: {
      type: Array,
      required: true,
    },
  },
  mounted() {
    // eslint-disable-next-line no-new
    new Swiper('.swiper', {
      slidesPerView: 'auto',
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      spaceBetween: 30,
    })
  },
}
</script>

<style lang="scss" scoped>
.swiper-slide {
  @apply w-auto;
}

.swiper-button {
  @apply w-16;

  @screen tablet {
    @apply w-24;
  }

  > img {
    @apply absolute;
  }

  &::after {
    content: none;
  }
}

.swiper-button-next {
  @apply right-0;
  > img {
    @apply right-0;
  }
}

.swiper-button-prev {
  @apply left-0;
  > img {
    @apply left-0 transform scale-x-mirror;
  }
}

figcaption {
  @apply hidden mt-1 px-2 py-2 text-common-tag text-gray-dark bg-white tablet:inline-block;
}
</style>
