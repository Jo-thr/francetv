<template>
  <div class="pt-8 container px-6 tablet:px-0">
    <!-- Title -->
    <Title
      :title="$i18n.t('compte.connexion.titre')"
      class="mb-3 tablet:text-center"
    />

    <!-- Description -->
    <p class="mb-8 tablet:mb-12 text-left tablet:text-center">
      {{ $t('compte.connexion.description') }}
    </p>

    <!-- Form -->
    <ValidationObserver v-slot="{ invalid }">
      <form class="tablet:max-w-sm mx-auto">
        <!-- Obligatoires -->
        <span class="text-common-legend text-gray-dark my-8 block">
          {{ $t('contact.form.obligatoires') }}</span
        >
        <!-- Email -->
        <ValidationProvider
          v-slot="{ errors }"
          name="email"
          class="flex"
          :rules="{
            required: true,
            emailftv: true,
            max: 256,
          }"
          ><div class="flex flex-col flex-1">
            <label class="text-gray-dark text-common-legend pb-2">{{
              $t('contact.form.label.email')
            }}</label>
            <input
              id="email"
              v-model="login.email"
              type="text"
              name="email"
              aria-required="true"
              class="form-input"
              :aria-label="$t('accessibilite.aria_label.email')"
              :placeholder="$t('compte.form.email')"
            />
            <span
              v-if="errors[0]"
              class="text-common-legend text-pink mb-4 block"
              >{{ errors[0] }}</span
            >
          </div>
          <span class="block ml-2 text-gray-dark">*</span>
        </ValidationProvider>

        <!-- Password -->
        <ValidationProvider
          v-slot="{ errors }"
          name="password"
          class="flex"
          rules="required|max:256"
          ><div class="flex flex-col flex-1">
            <input
              id="password"
              v-model="login.password"
              type="password"
              name="password"
              aria-required="true"
              class="form-input"
              :aria-label="$t('accessibilite.aria_label.mot_de_passe')"
              :placeholder="$t('compte.form.mdp')"
            />
            <span
              v-if="errors[0]"
              class="text-common-legend text-pink mb-4 block"
              >{{ errors[0] }}</span
            >
          </div>
          <span class="block ml-2 text-gray-dark">*</span>
        </ValidationProvider>

        <div class="flex mt-8 tablet:mt-12 tablet:justify-center">
          <!-- Button Login -->
          <Button class="mr-2" :is-disabled="invalid" @click="submitLogin()">{{
            $t('compte.boutons.connexion')
          }}</Button>

          <!-- Button Register -->
          <Button
            class="ml-2"
            type="secondary-black"
            @click="
              $router.push(
                localeRoute({
                  name: `inscription`,
                  query: {
                    redirect: $route.query.redirect || null,
                  },
                })
              )
            "
            >{{ $t('compte.boutons.inscription') }}</Button
          >
        </div>

        <!-- Errors -->
        <p
          v-if="proxyErrors[0]"
          role="alert"
          class="text-common-legend text-center text-pink mt-4 block"
        >
          {{ proxyErrors[0] }}
        </p>

        <!-- Forgotten password  -->
        <div class="tablet:text-center mt-4">
          <nuxt-link
            :to="localePath({ name: 'mot-de-passe-oublie' })"
            class="text-common-legend text-blue underline inline-block"
            >{{ $t('compte.connexion.mdp_oublie') }}</nuxt-link
          >
        </div>
      </form>
    </ValidationObserver>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { createSEOMeta } from '~/utils/seo'
import getErrorMessage from '~/utils/auth/errors'

export default {
  name: 'Connexion',
  auth: 'guest',
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      login: {
        email: '',
        password: '',
      },
      proxyErrors: [],
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const title = this.$i18n.t('compte.connexion.titre')
    const description = this.$i18n.t('compte.connexion.description')
    const image = this.$config.HOST_NAME + '/social_image.png'

    return {
      title: `${title} - France tv lab`,
      meta: createSEOMeta({ title, description, url, image }),
    }
  },
  deactivated() {
    this.$destroy()
  },
  mounted() {
    this.$wrapper.setTcVars({
      environnement: this.$config.LIVE_ENV,
      offre: 'lab',
      categorie: 'compte',
      nom_page: 'connexion',
      langue: `[${this.$i18n.locale.toUpperCase()}]`,
    })

    this.$trackEvent('datalayer', window, { id: 'datalayer' })
  },
  methods: {
    async submitLogin() {
      await this.$auth
        .loginWith('gin', {
          data: this.login,
        })
        .then((res) => {
          if (this.$route.query.redirect.length > 0) {
            this.$router.push(
              this.localeRoute({
                name: `tests-slug`,
                params: {
                  slug: this.$route.query.redirect,
                },
              })
            )
          }
        })
        .catch((err) => {
          this.proxyErrors.push(
            getErrorMessage(
              err.response?.data.errorCode,
              err.response?.data.details
            )
          )
        })
    },
  },
  nuxtI18n: {
    paths: {
      en: '/login',
      fr: '/connexion',
    },
  },
}
</script>
