<template>
  <div class="desktop:relative desktop:h-8">
    <div
      class="h-12 desktop:h-8 bg-black flex pl-4 justify-between desktop:px-10"
    >
      <button
        class="flex items-center"
        :aria-expanded="dropdownTopicsIsOpen ? 'true' : 'false'"
        @click="eventDisplayItemsDropdown($event)"
      >
        <!-- Logo FTV -->
        <img
          src="~/assets/img/logo-ftv.svg"
          :alt="$t('accessibilite.img-alt.ftv-logo')"
          class="mr-3"
          aria-controls="metanav-control"
        />
        <div v-if="$device.isMobileOrTablet">
          <svg
            v-if="!displayItemsDropdown"
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-chevron-down"
            width="17"
            height="17"
            viewBox="0 0 24 24"
            stroke-width="3"
            stroke="#fff"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <polyline points="6 9 12 15 18 9" />
          </svg>

          <svg
            v-else
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-chevron-up"
            width="17"
            height="17"
            viewBox="0 0 24 24"
            stroke-width="3"
            stroke="#fff"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <polyline points="6 15 12 9 18 15" />
          </svg>
        </div>
      </button>

      <!-- Dropdown Items-->
      <div
        v-if="displayItemsDropdown"
        class="bg-black px-4 py-6 text-white desktop:absolute desktop:top-32 left-0 desktop:py-4 desktop:px-6 desktop:z-50"
        @mouseleave="eventDisplayItemsDropdown($event)"
      >
        <a
          v-if="$mq !== 'desktop'"
          href="https://www.france.tv/"
          class="text-mobile-h3 mb-3 block"
          target="_blank"
          >France TV</a
        >
        <NavbarMetanavItems class="" />
      </div>

      <div class="inline-flex items-center">
        <!-- Confidentialité -->
        <a
          href="https://www.francetelevisions.fr/groupe/confidentialite"
          target="_blank"
          @click="
            $trackEvent('click', $event.target, {
              event_chapter1: 'metanav',
              event_name: 'confidentialité',
            })
          "
        >
          <svg
            class="mx-2"
            width="14"
            height="15"
            viewBox="0 0 16 17"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M4.25 5.58338C4.25 3.51231 5.92893 1.83337 8 1.83337C10.0711 1.83337 11.75 3.51231 11.75 5.58338V6.41671H4.25V5.58338ZM8 0.583374C10.7614 0.583374 13 2.82195 13 5.58338V6.41671H13.5C14.6046 6.41671 15.5 7.31214 15.5 8.41671V14.4167C15.5 15.5213 14.6045 16.4167 13.4999 16.4167H2.50009C1.39552 16.4167 0.5 15.5213 0.5 14.4167V8.41671C0.5 7.31214 1.39543 6.41671 2.5 6.41671H3V5.58338C3 2.82195 5.23858 0.583374 8 0.583374ZM9.25 11.4167C9.25 12.1071 8.69036 12.6667 8 12.6667C7.30964 12.6667 6.75 12.1071 6.75 11.4167C6.75 10.7264 7.30964 10.1667 8 10.1667C8.69036 10.1667 9.25 10.7264 9.25 11.4167Z"
              fill="#F2F2F2"
            /></svg
        ></a>

        <!-- Newsletter -->
        <a
          href="https://www.francetelevisions.fr/abonnements"
          target="_blank"
          @click="
            $trackEvent('click', $event.target, {
              event_chapter1: 'metanav',
              event_name: 'newsletter',
            })
          "
          ><svg
            class="mx-2"
            width="16"
            height="13"
            viewBox="0 0 16 13"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M0.688355 1.81832L1.35957 2.40479L7.47942 7.30067C7.78377 7.54415 8.21623 7.54415 8.52058 7.30067L14.6404 2.40479L15.3116 1.81831C15.4325 2.07588 15.5 2.36343 15.5 2.66675V10.3334C15.5 11.438 14.6045 12.3334 13.4999 12.3334H2.50009C1.39552 12.3334 0.5 11.438 0.5 10.3334V2.66675C0.5 2.36343 0.567522 2.07588 0.688355 1.81832ZM14.4689 0.916704C14.1819 0.75744 13.8515 0.666748 13.5 0.666748H2.5C2.14847 0.666748 1.81812 0.757441 1.53108 0.916705L2.14044 1.4287L8 6.11635L13.8596 1.4287L14.4689 0.916704Z"
              fill="#F2F2F2"
            /></svg
        ></a>

        <!-- Connexion -->
        <nuxt-link
          v-if="!$auth.$state.user"
          class="text-white border border-white text-common-legend px-2 rounded-lg mx-2 desktop:mr-0"
          :to="localePath({ name: 'connexion' })"
          @click.native="
            $trackEvent('click', $event.target, {
              event_chapter1: 'metanav',
              event_name: 'connexion',
            })
          "
        >
          {{ $t('navbar.metanav.connexion') }}
        </nuxt-link>

        <!-- Settings button if user is connected -->
        <button
          v-else
          class="mx-2 desktop:mr-0"
          :aria-label="$t('navbar.metanav.espace_personnel')"
          :aria-expanded="dropdownTopicsIsOpen ? 'true' : 'false'"
          aria-controls="metanav-control"
          @click="eventDisplaySettingsDropdown($event)"
          @mouseover="eventDisplaySettingsDropdown($event)"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-settings"
            width="19"
            height="19"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="#F2F2F2"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
              d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"
            />
            <circle cx="12" cy="12" r="3" />
          </svg>
        </button>

        <!-- Close -->
        <button
          v-if="$device.isMobileOrTablet"
          class="bg-yellow px-4 h-12 ml-2"
          @click="$emit('close-menu')"
        >
          <svg
            width="12"
            height="12"
            viewBox="0 0 12 12"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M0.982666 11L10.9635 1"
              stroke="#232323"
              stroke-width="1.9"
              stroke-linecap="round"
            />
            <path
              d="M10.9635 11L0.982666 1"
              stroke="#232323"
              stroke-width="1.9"
              stroke-linecap="round"
            />
          </svg>
        </button>
      </div>
    </div>

    <!-- Dropdown Settings -->
    <div
      v-if="displaySettingsDropdown"
      class="desktop:absolute desktop:top-32 right-0 bg-black text-white desktop:z-50 p-4 desktop:pr-10 desktop:text-right text-common-tag"
      @mouseleave="eventDisplaySettingsDropdown($event)"
    >
      <a
        href="https://www.francetelevisions.fr/groupe/confidentialite/mes-donnees-personnelles"
        target="_blank"
        class="block my-3"
        :aria-label="$t('navbar.metanav.donnees_personnelles')"
        >{{ $t('navbar.metanav.donnees_personnelles') }}</a
      >
      <button @click="triggerLogout">
        {{ $t('navbar.metanav.deconnexion') }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Metanav',
  data() {
    return {
      dropdownTopicsIsOpen: false,
      displayItemsDropdown: false,
      displaySettingsDropdown: false,
    }
  },
  methods: {
    // Close dropdown if clicked outside.
    clickedOutside(event) {
      if (!this.dropdownTopicsIsOpen) return
      if (!this.isInWhiteList(event.target)) this.dropdownTopicsIsOpen = false
    },

    eventDisplayItemsDropdown(e) {
      if (e.type === 'mouseover' && this.$mq === 'desktop') {
        this.displayItemsDropdown = true
      } else if (e.type === 'mouseleave' && this.$mq === 'desktop') {
        this.displayItemsDropdown = false
      } else if (e.type === 'click' && this.$mq !== 'desktop') {
        this.displayItemsDropdown = !this.displayItemsDropdown
        if (this.displayItemsDropdown === true) {
          this.displaySettingsDropdown = false
        }
      } else if (e.type === 'click' && this.$mq === 'desktop') {
        this.$trackEvent('click', e.target, {
          event_chapter1: 'metanav',
          event_name: 'open metanav',
        })
        this.displayItemsDropdown = true
      }
    },
    eventDisplaySettingsDropdown(e) {
      if (e.type === 'mouseover' && this.$mq === 'desktop') {
        this.displaySettingsDropdown = true
      } else if (e.type === 'mouseleave' && this.$mq === 'desktop') {
        this.displaySettingsDropdown = false
      } else if (e.type === 'click' && this.$mq !== 'desktop') {
        this.displaySettingsDropdown = !this.displaySettingsDropdown
        if (this.displaySettingsDropdown === true) {
          this.displayItemsDropdown = false
        }
      }
    },
    async triggerLogout() {
      await this.$auth.logout()
    },
  },
}
</script>
