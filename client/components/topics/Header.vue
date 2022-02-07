<template>
  <section class="relative flex flex-col text-left desktop:px-0 z-0 mb-16">
    <!-- Topic -->
    <div class="relative h-full mb-4 overflow-hidden desktop:w-3/5 w-full">
      <div
        v-infocus="'slideTop'"
        class="relative z-20 inline-block pl-4 pr-14 pt-4 hiddenSlide mobile:pl-2"
        style="animation-delay: 1s"
        aria-label="Storylab"
        tabindex="0"
      >
        <img
          src="@/assets/img/icons/storylablogo.svg"
          width="324"
          height="73"
        />
        <!-- TYPO STORYLAB <span class="font-black">Story</span>Lab -->
      </div>
      <ul
        class="flex flex-row flex-nowrap pl-5 mb-4 pr-14 mobile:pl-2 overflow-x-scroll"
      >
        <li
          v-for="(short, index) in shortcut"
          :key="index"
          v-infocus="'slideTop'"
          class="flex relative z-20 font-bold hiddenSlide mr-5 desktop:mr-2.5 whitespace-nowrap"
          style="animation-delay: 1.2s"
        >
          <nuxt-link :to="localePath(short.url)" class="hover:underline">
            {{ short.name }}</nuxt-link
          >
          <span class="ml-2.5 text-gray last">/</span>
        </li>
      </ul>
      <div
        id="inOutViewport"
        class="absolute desktop:h-full tablet:h-2/6 mobile:h-1/4 top-11 z-10 slideInOut desktop:w-full tablet:w-3/6 w-full"
      ></div>
      <div
        id="inViewport"
        class="absolute desktop:h-full tablet:h-2/6 mobile:h-1/4 top-11 z-0 slideIn desktop:w-full tablet:w-3/6 w-full"
      ></div>
    </div>

    <!-- Description -->
    <p
      v-if="description"
      v-infocus="'slideTop'"
      class="desktop:text-justify text-left desktop:w-3/5 tablet:w-5/6 mobile:w-full mt-4 px-5 slideTop mobile:px-2 hiddenSlide"
      style="animation-delay: 1.3s; font-size: 18px; line-height: 28px"
      tabindex="0"
      aria-label=""
      v-html="description"
    >
      {{ description }}
    </p>
  </section>
</template>

<script>
export default {
  name: 'TopicHeader',
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
          }
        }
        window.addEventListener('scroll', f)
        f()
      },
    },
  },
  props: {
    description: {
      type: String,
      default: null,
    },
    descriptionHTML: {
      type: String,
      default: null,
    },
    shortcut: {
      type: Array,
      required: true,
    },
  },
  mounted() {
    window.addEventListener('scroll', this.onScroll)
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.onScroll)
  },
  methods: {
    onScroll(e) {
      const animYellow = document.querySelector('#inViewport')
      const animBlue = document.querySelector('#inOutViewport')
      this.windowTop = e.target.documentElement.scrollTop
      if (this.windowTop > 350) {
        animYellow.classList.remove('slideIn')
      } else {
        animBlue.classList.add('slideInOut')
        animYellow.classList.add('slideIn')
      }
    },
  },
}
</script>

<style lang="scss" scoped>
.hiddenSlide {
  opacity: 0;
}
.slideTop {
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

.slideInOut {
  @apply bg-blue;
  animation-duration: 0.6s;
  animation-name: slideInOut;
  animation-delay: 0.8s;
  animation-timing-function: ease;
  animation-fill-mode: both;
}

@keyframes slideInOut {
  0% {
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
    opacity: 1;
  }
  30% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }
  60% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }

  99% {
    -webkit-transform: translateX(101%);
    transform: translateX(101%);
    opacity: 1;
  }
  100% {
    -webkit-transform: translateX(101%);
    transform: translateX(101%);
    opacity: 0;
  }
}

.slideIn {
  @apply bg-yellow;
  animation-duration: 0.3s;
  animation-name: slideIn;
  animation-delay: 1s;
  animation-timing-function: ease;
  animation-fill-mode: both;
}
@keyframes slideIn {
  0% {
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
    opacity: 1;
  }
  100% {
    -webkit-transform: translateX(0%);
    transform: translateX(0%);
    opacity: 1;
  }
}
li:last-child span {
  display: none;
}
li > span {
  display: none;
  @screen desktop {
    display: flex;
  }
}
</style>
