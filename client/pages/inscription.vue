<template>
  <div class="pt-8 container px-6 tablet:px-0">
    <!-- Title -->
    <Title
      :title="$i18n.t('compte.inscription.titre')"
      class="mb-3 -ml-2 text-left tablet:text-center"
    />

    <!-- Description -->
    <p class="mb-8 tablet:mb-12 text-left tablet:text-center">
      {{ $t('compte.inscription.description') }}
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
          class="flex"
          name="email"
          :rules="{
            required: true,
            emailftv: true,
            max: 256,
          }"
        >
          <div class="flex flex-col flex-1">
            <label class="text-gray-dark text-common-legend pb-2">{{
              $t('contact.form.label.email')
            }}</label>
            <input
              id="email"
              v-model="email"
              class="form-input"
              :class="{ 'border-pink': errors[0] }"
              type="text"
              name="email"
              :aria-label="$t('accessibilite.aria_label.email')"
              :placeholder="$t('compte.form.email')"
            />
            <span
              v-if="errors[0]"
              aria-required="true"
              class="text-common-legend text-pink mb-4 block"
              >{{ errors[0] }}</span
            >
          </div>
          <span class="block ml-2 text-gray-dark">*</span>
        </ValidationProvider>

        <ValidationObserver>
          <!-- Password -->
          <ValidationProvider
            v-slot="{ errors }"
            class="flex"
            name="password"
            :rules="{
              required: true,
              regex: /[$@%_\W.]/,
              min: 8,
              password: '@password_confirmation',
              max: 256,
            }"
          >
            <div class="flex flex-col flex-1">
              <label class="text-gray-dark text-common-legend pb-2">{{
                $t('compte.form.mdp')
              }}</label>
              <input
                id="password"
                v-model="password"
                class="form-input"
                :class="{ 'border-pink': errors[0] }"
                type="password"
                name="password"
                aria-required="true"
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

          <!-- Password confirmation -->
          <ValidationProvider
            v-slot="{ errors }"
            class="flex"
            name="password_confirmation"
            rules="required"
          >
            <div class="flex flex-col flex-1">
              <label class="text-gray-dark text-common-legend pb-2">{{
                $t('compte.form.mdp_confirmation')
              }}</label>
              <input
                id="password_confirmation"
                v-model="passwordConfirmation"
                class="form-input"
                :class="{ 'border-pink': errors[0] }"
                type="password"
                name="password_confirmation"
                aria-required="true"
                :aria-label="
                  $t('accessibilite.aria_label.confirmation_mot_de_passe')
                "
                :placeholder="$t('compte.form.mdp_confirmation')"
              />
              <span
                v-if="errors[0]"
                class="text-common-legend text-pink mb-4 block"
                >{{ errors[0] }}</span
              >
            </div>
            <span class="block ml-2 text-gray-dark">*</span>
          </ValidationProvider>
        </ValidationObserver>

        <!-- Birth -->
        <ValidationProvider
          v-slot="{ errors }"
          class="flex"
          name="birth"
          :rules="{
            minimumAge: true,
            limitAge: true,
            required: true,
          }"
        >
          <div class="flex flex-col flex-1">
            <label class="text-gray-dark text-common-legend pb-2">{{
              $t('compte.form.date_de_naissance')
            }}</label>
            <datepicker
              v-model="birth.value"
              input-class="form-input"
              :placeholder="$t('compte.form.date_de_naissance')"
              :aria-label="$t('accessibilite.aria_label.date_naissance')"
              format="dd/MM/yyyy"
              aria-required="true"
              aria-autocomplete="bday"
              :language="birth[$i18n.locale]"
              :disabled-dates="birth.disabledDates"
              :typeable="true"
              first-day-of-week="mon"
              :inline="false"
            ></datepicker>
            <span
              v-if="errors[0]"
              class="text-common-legend text-pink mb-4 block"
              >{{ errors[0] }}</span
            >
          </div>
          <span class="block ml-2 text-gray-dark">*</span>
        </ValidationProvider>

        <!-- Zip Code -->
        <ValidationProvider
          v-slot="{ errors }"
          class="flex"
          name="zip_code"
          :rules="{
            required: true,
            digits: 5,
            between: ['01000', '98999'],
          }"
        >
          <div class="flex flex-col flex-1">
            <label class="text-gray-dark text-common-legend pb-2">{{
              $t('compte.form.code_postal')
            }}</label>
            <input
              id="zip_code"
              v-model="zipCode"
              class="form-input"
              :class="{ 'border-pink': errors[0] }"
              type="number"
              name="zip_code"
              step="1"
              :aria-label="$t('accessibilite.aria_label.code_postal')"
              :placeholder="$t('compte.form.code_postal')"
            />
            <span
              v-if="errors[0]"
              aria-required="true"
              class="text-common-legend text-pink mb-4 block"
              >{{ errors[0] }}</span
            >
          </div>
          <span class="block ml-2 text-gray-dark">*</span>
        </ValidationProvider>

        <!-- Gender -->
        <ValidationProvider
          v-slot="{ errors }"
          name="gender"
          class="flex"
          rules="required|max:15|alpha"
        >
          <div class="flex flex-col flex-1">
            <select
              v-model="gender"
              class="form-select"
              aria-required="true"
              aria-autocomplete="honorific-prefix"
              :aria-label="$t('accessibilite.aria_label.civilite')"
              :class="{
                'text-dark': gender !== '',
                'text-gray-dark': gender === '',
                'border-pink': errors[0],
              }"
            >
              <option value="" disabled selected>
                {{ $t('compte.form.civilite') }}
              </option>
              <option value="f">{{ $t('compte.form.madame') }}</option>
              <option value="m">{{ $t('compte.form.monsieur') }}</option>
            </select>
            <span
              v-if="errors[0]"
              class="text-common-legend text-pink mb-4 block"
              >{{ errors[0] }}</span
            >
          </div>
          <span class="block ml-2 text-gray-dark">*</span>
        </ValidationProvider>

        <!-- Newsletters -->
        <div class="inline-flex items-center mt-4">
          <input
            v-model="subscribe"
            type="checkbox"
            :value="!subscribe"
            class="form-checkbox text-blue"
          />
          <label class="ml-2">{{ $t('compte.form.newsletters') }}</label>
        </div>

        <div class="flex mt-8 tablet:mt-12 tablet:justify-center">
          <!-- Button Register -->
          <Button
            class="mx-2"
            :is-disabled="invalid"
            @click="proxyRegister()"
            >{{ $t('compte.boutons.inscription') }}</Button
          >

          <!-- Button Login -->
          <Button
            class="mx-2"
            type="secondary-black"
            @click="
              $router.push(
                localeRoute({
                  name: `connexion`,
                  query: {
                    redirect: $route.query.redirect || null,
                  },
                })
              )
            "
            >{{ $t('compte.boutons.connexion') }}</Button
          >
        </div>

        <!-- Proxy Errors -->
        <p
          v-if="proxyErrors[0]"
          role="alert"
          class="text-sm text-center text-pink my-2 block"
        >
          {{ proxyErrors[0] }}
        </p>

        <!-- Legal text -->
        <p class="text-common-legend text-justify text-gray-dark mt-12">
          {{ $t('contact.form.legal') }}
        </p>
      </form>
    </ValidationObserver>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { en, fr } from '@sum.cumo/vue-datepicker/dist/locale/index.esm'
import { register } from '~/utils/auth/auth'
import { createSEOMeta } from '~/utils/seo'
import getErrorMessage from '~/utils/auth/errors'

export default {
  name: 'Inscription',
  auth: 'guest',
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      email: null,
      password: null,
      passwordConfirmation: null,
      birth: {
        value: null,
        fr,
        en,
        disabledDates: {
          from: this.$dayjs().subtract(16, 'year').toDate(),
          to: this.$dayjs().subtract(105, 'year').toDate(),
        },
      },
      zipCode: null,
      gender: '',
      subscribe: false,
      proxyErrors: [],
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const title = this.$i18n.t('compte.inscription.titre')
    const description = this.$i18n.t('compte.inscription.description')
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
      nom_page: 'inscription',
      langue: `[${this.$i18n.locale.toUpperCase()}]`,
    })

    this.$trackEvent('datalayer', window, { id: 'datalayer' })
  },
  methods: {
    async proxyRegister() {
      this.proxyErrors.length = 0
      const data = {
        email: this.email,
        password: this.password,
        birthYear: this.$dayjs(this.birth.value).format('YYYY'),
        birthMonth: this.$dayjs(this.birth.value).format('MM'),
        birthDay: this.$dayjs(this.birth.value).format('DD'),
        zipCode: this.zipCode,
        gender: this.gender,
        device: 'app_mobile_android',
        subscribe: this.subscribe,
      }
      try {
        const res = await register(data, this.$config.gin)
        localStorage.setItem('auth._token.gin', res.data.access_token)
        localStorage.setItem('auth._refresh_token.gin', res.data.refresh_token)
        await this.$auth.fetchUserOnce()

        if (this.$route.query.redirect) {
          this.$router.push(
            this.localeRoute({
              name: `tests-slug`,
              params: {
                slug: this.$route.query.redirect,
              },
            })
          )
        } else {
          this.$router.push(
            this.localeRoute({
              name: 'index',
            })
          )
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
      en: '/register',
      fr: '/inscription',
    },
  },
}
</script>
