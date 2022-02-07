<template>
  <div id="test" class="relative mt-8 shadow" :style="fullScreenStyle">
    <div
      v-if="!$store.state.auth.loggedIn"
      class="overlay flex items-center justify-center"
    >
      <div
        class="bg-white text-dark text-center p-6 tablet:py-12 tablet:px-24 inline-block modal"
      >
        <h4 class="mb-3">{{ $t('tests.participation_test') }}</h4>
        <p>{{ $t('tests.veuillez_vous_connecter') }}</p>
        <div class="flex mt-4 tablet:mt-8 tablet:justify-center">
          <!-- Button Login -->
          <Button class="mx-2" @click.native="login($event)">{{
            $t('compte.boutons.connexion')
          }}</Button>

          <!-- Button Register -->
          <Button
            class="mx-2"
            type="secondary-black"
            @click.native="register($event)"
            >{{ $t('compte.boutons.inscription') }}</Button
          >
        </div>
      </div>
    </div>
    <div v-else>
      <!-- Maximize button -->
      <button
        v-if="!fullScreen"
        class="absolute right-10 bottom-10 z-10 h-6 w-6 tablet:w-8 tablet:h-8"
        @click="fullScreen = true"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-maximize"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="#232323"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
          <path d="M4 16v2a2 2 0 0 0 2 2h2" />
          <path d="M16 4h2a2 2 0 0 1 2 2v2" />
          <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
        </svg>
      </button>

      <!-- Minimize button -->
      <button
        v-else
        class="absolute right-10 bottom-10 tablet:right-50 tablet:bottom-50 z-30 h-8 w-8 tablet:h-12 tablet:w-12"
        @click="fullScreen = false"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-minimize"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="#232323"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M15 19v-2a2 2 0 0 1 2 -2h2" />
          <path d="M15 5v2a2 2 0 0 0 2 2h2" />
          <path d="M5 15h2a2 2 0 0 1 2 2v2" />
          <path d="M5 9h2a2 2 0 0 0 2 -2v-2" />
        </svg>
      </button>
    </div>
    <div
      v-if="$store.state.auth.loggedIn"
      class="iframe-container overflow-hidden"
      :style="fullScreenStyle"
      v-html="test.data.iframe"
    ></div>
    <div
      v-else
      class="iframe-container bg-center bg-cover"
      :style="{
        'background-image':
          'url(' + $config.IMAGES_DIRECTORY + test.data.featured + ')',
      }"
    ></div>
  </div>
</template>

<script>
export default {
  name: 'TestIframe',
  props: {
    test: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      fullScreen: false,
    }
  },
  computed: {
    fullScreenStyle() {
      if (this.fullScreen) {
        return 'position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:20;'
      } else {
        return null
      }
    },
  },
  methods: {
    register(e) {
      this.$trackEvent('click', e.target, {
        event_chapter1: 'tester',
        event_chapter2: 'inscription',
        event_name: this.test.data.slug,
      })

      this.$router.push(
        this.localeRoute({
          name: `inscription`,
          query: {
            redirect: this.test.meta.slug[this.$i18n.locale],
          },
        })
      )
    },
    login(e) {
      this.$trackEvent('click', e.target, {
        event_chapter1: 'tester',
        event_chapter2: 'connexion',
        event_name: this.test.data.slug,
      })

      this.$router.push(
        this.localeRoute({
          name: `connexion`,
          query: {
            redirect: this.test.meta.slug[this.$i18n.locale],
          },
        })
      )
    },
  },
}
</script>

<style lang="postcss" scoped>
.overlay {
  @apply absolute top-0 left-0 w-full h-full z-10;

  background: linear-gradient(
    0deg,
    rgba(0, 35, 255, 0.5),
    rgba(0, 35, 255, 0.5)
  );
}

.iframe-container {
  @apply relative w-full h-0;

  padding-bottom: 56.25%;
  >>> iframe {
    @apply bg-white absolute top-0 left-0 w-full h-full;
  }
}

.minimize {
  right: 50px;
  bottom: 50px;
}

.maximize {
  right: 10px;
  bottom: 10px;
}
</style>
