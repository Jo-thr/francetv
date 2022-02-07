<template>
  <div>
    <div class="relative h-full mb-4 overflow-hidden w-max max-w-full">
      <h1
        v-if="title && $i18n.locale === 'fr'"
        v-infocus="'slideTop'"
        class="relative subtitleSize inline-block z-20 pl-4 tablet:pr-14 mb-2 pt-4 font-bold hiddenSlide mobile:pr-6"
        tabindex="0"
        :aria-label="title.fr"
      >
        {{ title.fr }}
      </h1>
      <h1
        v-else
        v-infocus="'slideTop'"
        class="relative subtitleSize inline-block z-20 pl-4 pr-14 mb-2 pt-4 font-bold hiddenSlide"
        tabindex="0"
        :aria-label="title.en"
      >
        {{ title.en }}
      </h1>
      <div class="absolute h-full top-9 z-0 text-yellow yellowBg">.</div>
    </div>
    <p
      v-if="description && $i18n.locale === 'fr'"
      v-infocus="'slideTop'"
      class="descriptionText text-justify desktop:w-1/2 tablet:w-2/3 mobile:w-full mt-4 px-4 hiddenSlide"
      style="animation-delay: 0.3s"
      tabindex="0"
      :aria-label="description.fr"
      v-html="description.fr"
    >
      {{ description.fr }}
    </p>
    <p
      v-else
      v-infocus="'slideTop'"
      class="descriptionText text-justify desktop:w-1/2 tablet:w-2/3 mobile:w-full mt-4 px-4 hiddenSlide"
      style="animation-delay: 0.3s"
      tabindex="0"
      :aria-label="description.en"
      v-html="description.en"
    >
      {{ description.en }}
    </p>
  </div>
</template>

<script>
export default {
  name: 'SubtitleTopic',
  directives: {
    infocus: {
      isLiteral: true,
      inserted: (el, binding, vnode) => {
        const f = () => {
          const rect = el.getBoundingClientRect()
          const inView =
            rect.width > 0 &&
            rect.height > 0 &&
            rect.top >= 0 &&
            rect.bottom <=
              (window.innerHeight || document.documentElement.clientHeight)
          if (inView) {
            el.classList.add(binding.value)
            window.removeEventListener('scroll', f)
          } else {
            el.classList.remove(binding.value)
          }
        }
        window.addEventListener('scroll', f)
        f()
      },
    },
  },
  props: {
    title: {
      type: Object,
      required: true,
    },
    description: {
      type: Object,
      required: true,
    },
  },
  mounted() {
    this.onScroll()
  },
  methods: {
    onScroll(e) {
      const startAnimation = (entries, observer) => {
        entries.forEach((entry) => {
          entry.target.classList.toggle('slideIn', entry.isIntersecting)
        })
      }

      const observer = new IntersectionObserver(startAnimation)
      const options = {
        root: document.body,
        rootMargin: '0px',
        threshold: 0.000001,
      }

      const elements = document.querySelectorAll('.yellowBg')
      elements.forEach((el) => {
        observer.observe(el, options)
      })
    },
  },
}
</script>

<style lang="scss" scoped>
.hiddenSlide {
  @apply opacity-0;
}
.slideTop {
  @apply opacity-100;
  animation-name: slide-top;
  animation-duration: 0.4s;
  animation-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);
  animation-fill-mode: both;
}
@keyframes slide-top {
  0% {
    -webkit-transform: translateY(-100px);
    transform: translateY(-100px);
    opacity: 0;
  }
  50% {
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}
.yellowBg {
  @apply opacity-0 w-full ml-2 bg-yellow;
}
.slideIn {
  animation-duration: 0.3s;
  animation-name: slideIn;
  animation-delay: 0.8s;
  animation-timing-function: ease;
  animation-fill-mode: forwards;
}
@keyframes slideIn {
  0% {
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0%);
    transform: translateX(0%);
    opacity: 1;
  }
}
.subtitleSize {
  font-size: 28px;
  line-height: 34px;
  @screen tablet {
    font-size: 40px;
    line-height: 48px;
  }
}
.descriptionText {
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 28px;
  text-align: left;
}
</style>
