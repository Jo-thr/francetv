<template>
  <header
    class="bg-white flex justify-center items-center desktop:px-10 py-6 relative z-20 shadow-md"
    role="banner"
  >
    <!-- Logo -->
    <nuxt-link
      :to="localePath({ name: 'index' })"
      class="absolute desktop:left-40 left-3"
      @click.native="
        $trackEvent('click', $event.target, {
          event_chapter1: 'header',
          event_name: 'logo_ftv_lab',
        })
      "
    >
      <img
        src="~/assets/img/logo-ftv-lab.svg"
        width="165px"
        :alt="$t('accessibilite.img-alt.logo-ftv-lab')"
      />
    </nuxt-link>

    <!-- Navbar -->

    <nav class="flex" role="navigation">
      <ul class="flex items-center">
        <!-- Topics -->
        <li>
          <button
            ref="button"
            type="button"
            title="Afficher les topics"
            :aria-expanded="dropdownTopicsIsOpen ? 'true' : 'false'"
            aria-controls="topics-control"
            class="text-desktop-h5 mx-4 text-gray-darker font-normal hover:font-bold hover:bg-yellow transition-all duration-200 flex items-center px-2"
            @click="dropdownTopicsIsOpen = !dropdownTopicsIsOpen"
          >
            <span class="mr-2">{{ $t('navbar.topics') }}</span>
            <svg
              v-if="!dropdownTopicsIsOpen"
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-chevron-down stroke-current"
              width="18"
              height="18"
              viewBox="0 0 24 24"
              stroke-width="3"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" />
              <polyline points="6 9 12 15 18 9" />
            </svg>
            <svg
              v-else
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-chevron-up stroke-current"
              width="18"
              height="18"
              viewBox="0 0 24 24"
              stroke-width="3"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" />
              <polyline points="6 15 12 9 18 15" />
            </svg>
          </button>
        </li>

        <!-- Topics section -->
        <nav
          v-if="dropdownTopicsIsOpen"
          ref="dropdown"
          class="text-center text-common-legend py-4 absolute w-full topics-nav bg-white shadow-md flex flex-row left-0 justify-center"
        >
          <ul class="flex">
            <li v-for="(topic, index) in topics" :key="index" class="list-none">
              <nuxt-link
                class="mx-3 common-body-ftv text-dark hover:text-blue transition-all duration-200"
                :to="
                  localePath({
                    name: 'topics-slug',
                    params: { slug: topic.meta.slug[$i18n.locale] },
                  })
                "
                @click.native="
                  $trackEvent('click', $event.target, {
                    event_chapter1: 'header',
                    event_chapter2: 'topic',
                    event_name: topic.id,
                  })
                "
                >{{ topic.data.label }}</nuxt-link
              >
            </li>
          </ul>
        </nav>

        <!-- Tests -->
        <li>
          <nuxt-link
            :to="
              localePath({
                name: 'topics-slug',
                params: { slug: 'tests' },
              })
            "
            titlle="Aller sur la page des tests."
            class="text-desktop-h5 mx-4 text-gray-darker font-normal hover:font-bold hover:bg-yellow transition-all duration-200 flex items-center px-2"
            @click.native="
              $trackEvent('click', $event.target, {
                event_chapter1: 'header',
                event_name: 'testez',
              })
            "
          >
            <TestsLogo class="text-blue fill-current h-4 mr-1" />
            <span>{{ $t('navbar.tests') }}</span>
          </nuxt-link>
        </li>
        <!-- Meta-media -->
        <li>
          <nuxt-link
            :to="
              localePath({
                name: 'topics-slug',
                params: { slug: 'meta-media' },
              })
            "
            title="Aller sur la page meta-media."
            class="text-desktop-h5 mx-4 text-gray-darker font-normal hover:font-bold hover:bg-yellow transition-all duration-200 px-2"
            @click.native="
              $trackEvent('click', $event.target, {
                event_chapter1: 'header',
                event_name: 'metamedia',
              })
            "
            >{{ $t('navbar.meta-media') }}</nuxt-link
          >
        </li>
        <!-- Contact -->
        <li>
          <nuxt-link
            :to="localePath('/contact')"
            title="Aller sur la page de contact."
            class="text-desktop-h5 mx-4 text-gray-darker font-normal hover:font-bold hover:bg-yellow transition-all duration-200 px-2"
            @click.native="
              $trackEvent('click', $event.target, {
                event_chapter1: 'header',
                event_name: 'contact',
              })
            "
            >{{ $t('navbar.contact') }}</nuxt-link
          >
        </li>
      </ul>
    </nav>

    <div class="absolute right-40 flex items-center">
      <!-- Search bar -->
      <input
        v-show="showSearchBar === true"
        ref="search_input"
        v-model="query"
        class="text-gray-dark border-b border-gray bg-transparent focus:outline-none py-1 px-4 block appearance-none flex-1"
        type="search"
        role="search"
        placeholder="Rechercher"
        :aria-label="$t('accessibilite.aria_label.recherche')"
        @keyup.enter="search()"
      />

      <!-- Search button -->
      <button
        type="button"
        class="mx-6"
        role="search"
        :aria-label="$t('accessibilite.aria_label.icon_recherche')"
        @click="searchButton($event)"
      >
        <img
          src="~/assets/img/icons/search.svg"
          aria-hidden="true"
          :alt="$t('accessibilite.img-alt.icon-recherche')"
        />
      </button>

      <!-- Lang switcher -->
      <nuxt-link
        v-for="locale in availableLocales"
        :key="locale.code"
        :to="switchLocalePath(locale.code)"
        @click.native="
          $trackEvent('click', $event.target, {
            event_chapter1: 'header',
            event_name: 'langue',
          })
        "
        ><span
          class="flag-icon"
          :lang="$t('accessibilite.img-alt.lang')"
          :aria-label="$t('accessibilite.img-alt.icon-flag')"
          :class="{
            'flag-icon-gb': locale.code === 'en',
            'flag-icon-fr': locale.code === 'fr',
          }"
        ></span
      ></nuxt-link>
    </div>
  </header>
</template>

<script>
import TestsLogo from '~/assets/img/icons/tests.svg?inline'

export default {
  name: 'NavbarDesktop',
  components: {
    TestsLogo,
  },
  props: {
    topics: {
      type: [Array, Object],
      required: true,
    },
  },
  data() {
    return {
      dropdownTopicsIsOpen: false,
      showSearchBar: false,
      query: '',
    }
  },
  computed: {
    availableLocales() {
      return this.$i18n.locales.filter((i) => i.code !== this.$i18n.locale)
    },
  },
  mounted() {
    document.addEventListener('click', this.clickedOutside)
  },
  methods: {
    // Close dropdown if clicked outside.
    clickedOutside(event) {
      if (!this.dropdownTopicsIsOpen) return
      if (!this.isInWhiteList(event.target)) this.dropdownTopicsIsOpen = false
    },

    // White-listed items to not close when clicked.
    isInWhiteList(el) {
      if (el === this.$refs.dropdown || el === this.$refs.button) {
        return true
      }

      // All chidren from button
      if (this.$refs.button !== undefined) {
        const children = this.$refs.button.querySelectorAll('*')
        for (const child of children) {
          if (el === child) {
            return true
          }
        }
      }
      return false
    },
    searchButton(e) {
      this.$trackEvent('click', e.target, {
        event_chapter1: 'header',
        event_name: 'recherche',
      })

      if (this.showSearchBar === false) {
        this.showSearchBar = true
        this.$nextTick(() => {
          this.$refs.search_input.focus()
        })
      } else {
        this.search()
      }
    },
    search() {
      if (this.query.length > 0) {
        this.$router.push(
          this.localeRoute({
            name: `recherche`,
            query: {
              query: this.query,
            },
          })
        )

        this.showSearchBar = false
        this.query = ''
      }
    },
  },
}
</script>
<style lang="postcss" scoped>
.topics-nav {
  bottom: -42px;
}
.nuxt-link-active {
  font-weight: 700;
}
</style>
