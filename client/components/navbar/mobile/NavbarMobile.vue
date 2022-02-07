<template>
  <div>
    <header class="h-12 bg-white shadow-lg relative z-10" role="banner">
      <transition
        name="animate__animated"
        enter-active-class="animate__animated animate__fadeIn"
      >
        <div
          v-if="!showSearchBar"
          key="1"
          class="flex justify-between items-center px-4 h-full"
        >
          <!-- Burger Menu -->
          <button
            type="button"
            :aria-expanded="isOpen ? 'true' : 'false'"
            aria-controls="burger-control"
            @click="isOpen = true"
          >
            <img
              src="~/assets/img/icons/burger-menu.svg"
              :alt="$t('accessibilite.img-alt.icon-menu')"
            />
          </button>

          <!-- Logo -->
          <nuxt-link
            :to="localePath({ name: 'index' })"
            @click.native="
              $trackEvent('click', $event.target, {
                event_chapter1: 'header',
                event_name: 'logo_ftv_lab',
              })
            "
          >
            <img
              src="~/assets/img/logo-ftv-lab.svg"
              width="115px"
              :alt="$t('accessibilite.img-alt.logo-ftv-lab')"
            />
          </nuxt-link>

          <div class="flex items-center">
            <!-- Search button -->
            <button
              class="mr-4"
              :aria-label="$t('accessibilite.aria_label.icon_recherche')"
              role="search"
              @click="searchButton($event)"
            >
              <img
                src="~/assets/img/icons/search.svg"
                aria-hidden="true"
                :alt="$t('accessibilite.img-alt.logo-ftv-lab')"
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
                :class="{
                  'flag-icon-gb': locale.code === 'en',
                  'flag-icon-fr': locale.code === 'fr',
                }"
              ></span
            ></nuxt-link>
          </div>
        </div>

        <!-- Search bar -->
        <div v-else key="2" class="h-full flex items-center px-4">
          <input
            v-show="showSearchBar === true"
            ref="search_input"
            v-model="query"
            class="text-gray-dark bg-transparent focus:outline-none px-4 block appearance-none flex-1"
            type="search"
            placeholder="Rechercher"
            :aria-label="$t('accessibilite.aria_label.recherche')"
            @keyup.enter="search()"
          />
          <button @click="resetQuery()">
            <img
              src="~/assets/img/icons/cross.svg"
              :alt="$t('accessibilite.img-alt.icon-croix')"
              class="h-3"
            />
          </button>
        </div>
      </transition>
    </header>

    <!-- Menu -->
    <transition
      name="animate__animated"
      enter-active-class="animate__animated animate__slideInLeft animate__faster"
      leave-active-class="animate__animated animate__slideOutLeft animate__faster"
    >
      <NavbarMobileMenu
        v-if="isOpen"
        id="burger-control"
        :topics="topics"
        @close-menu="isOpen = false"
      />
    </transition>
  </div>
</template>

<script>
export default {
  name: 'NavbarMobile',
  props: {
    topics: {
      type: [Array, Object],
      required: true,
    },
  },
  data() {
    return {
      isOpen: false,
      showSearchBar: false,
      query: '',
    }
  },
  computed: {
    availableLocales() {
      return this.$i18n.locales.filter((i) => i.code !== this.$i18n.locale)
    },
  },
  watch: {
    $route() {
      this.isOpen = false
    },
    isOpen(newValue, oldValue) {
      if (newValue === true) {
        document.getElementsByTagName('BODY')[0].style.overflow = 'hidden'
      } else {
        document.getElementsByTagName('BODY')[0].style.overflow = null
      }
    },
  },
  methods: {
    resetQuery() {
      this.query = ''
      this.showSearchBar = false
    },
    searchButton(e) {
      this.$trackEvent('click', e.target, {
        event_chapter1: 'header',
        event_name: 'recherche',
      })

      this.showSearchBar = true

      this.$nextTick(() => {
        this.$refs.search_input.focus()
      })
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
