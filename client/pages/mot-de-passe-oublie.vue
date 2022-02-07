<template>
  <div class="pt-8 container px-6 tablet:px-0">
    <transition
      name="fade"
      enter-active-class="animate__animated animate__fadeIn"
    >
      <div v-if="!sended" key="1">
        <!-- Title -->
        <Title
          :title="$i18n.t('compte.mdp_oublie.titre')"
          class="mb-3 tablet:text-center"
        />

        <!-- Description -->
        <p class="mb-8 tablet:mb-12 text-left tablet:text-center">
          {{ $t('compte.mdp_oublie.description') }}
        </p>

        <!-- Form -->
        <ValidationObserver v-if="!sended" v-slot="{ invalid }">
          <form class="tablet:max-w-sm mx-auto">
            <!-- Email -->
            <ValidationProvider
              v-slot="{ errors }"
              name="email"
              :rules="{
                required: true,
                emailftv: true,
                max: 256,
              }"
            >
              <input
                id="email"
                v-model="email"
                type="text"
                name="email"
                class="form-input"
                :aria-label="$t('accessibilite.aria_label.email')"
                :placeholder="$t('compte.form.email')"
              />
              <span
                v-if="errors[0]"
                class="text-common-legend text-pink mb-4 block"
                >{{ errors[0] }}</span
              >
            </ValidationProvider>

            <div class="flex mt-8 tablet:mt-12 tablet:justify-center">
              <!-- Button Reset -->
              <Button
                class="mx-2"
                :is-disabled="invalid"
                @click="submitReset()"
                >{{ $t('compte.mdp_oublie.renitialiser') }}</Button
              >

              <!-- Button Login -->
              <Button
                class="mx-2"
                type="secondary-black"
                @click="
                  $router.push(
                    localeRoute({
                      name: `connexion`,
                    })
                  )
                "
                >{{ $t('compte.boutons.connexion') }}</Button
              >
            </div>

            <!-- Error -->
            <p
              v-if="proxyErrors[0]"
              role="alert"
              class="text-sm text-center text-pink mt-4 block"
            >
              {{ proxyErrors[0] }}
            </p>
          </form>
        </ValidationObserver>
      </div>

      <!-- Confirmation -->
      <div v-else key="2" class="text-center">
        <h1
          class="text-mobile-h3 tablet:text-desktop-h3 text-gray-darker mb-8"
          role="status"
        >
          {{ $t('compte.mdp_oublie.confirmation.titre') }}
          <strong>{{ email }}</strong>
        </h1>
        <p class="mb-12 font-bold tablet:max-w-md mx-auto" role="status">
          {{ $t('compte.mdp_oublie.confirmation.description') }}
        </p>
        <NuxtLink
          :to="
            localePath({
              name: `connexion`,
            })
          "
          class="inline-block rounded-button hover:bg-blue hover:border-blue transition-all duration-500 text-black border-black hover:text-white text-common-body-ftv px-5 py-2 border-2"
          >{{ $t('compte.boutons.connexion') }}</NuxtLink
        >
      </div>
    </transition>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { createSEOMeta } from '~/utils/seo'
import getErrorMessage from '~/utils/auth/errors'
import { passwordReset } from '~/utils/auth/auth'

export default {
  name: 'MotDePasseOubli',
  auth: 'guest',
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      email: '',
      sended: false,
      proxyErrors: [],
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const title = this.$i18n.t('compte.mdp_oublie.titre')
    const description = this.$i18n.t('compte.mdp_oublie.description')
    const image = this.$config.HOST_NAME + '/social_image.png'

    return {
      title: `${title} - France tv lab`,
      meta: createSEOMeta({ title, description, url, image }),
    }
  },
  mounted() {
    this.$wrapper.setTcVars({
      environnement: this.$config.LIVE_ENV,
      offre: 'lab',
      categorie: 'compte',
      nom_page: 'mot_de_passe_oublie',
      langue: `[${this.$i18n.locale.toUpperCase()}]`,
    })

    this.$trackEvent('datalayer', window, { id: 'datalayer' })
  },
  deactivated() {
    this.$destroy()
  },
  methods: {
    async submitReset() {
      const data = {
        email: this.email,
      }
      try {
        const res = await passwordReset(data, this.$config.gin)
        if (res.status === 200) {
          this.sended = true
        }
      } catch (err) {
        this.proxyErrors.push(
          getErrorMessage(
            err.response?.data.errorCode,
            err.response?.data.details
          )
        )
      }
    },
  },
  nuxtI18n: {
    paths: {
      en: '/forgotten-password',
      fr: '/mot-de-passe-oublie',
    },
  },
}
</script>
