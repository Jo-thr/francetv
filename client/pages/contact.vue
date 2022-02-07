<template>
  <div class="pt-8 container px-6 tablet:px-0">
    <transition
      name="fade"
      enter-active-class="animate__animated animate__fadeIn"
    >
      <div v-if="!isSent" key="1">
        <!-- Title -->
        <Title :title="$t('contact.title')" class="mb-3 tablet:text-center" />

        <!-- Description -->
        <p
          class="mb-8 tablet:mb-12 tablet:max-w-lg mx-auto text-left tablet:text-center"
        >
          {{ $t('contact.description') }}
        </p>

        <ValidationObserver v-slot="{ invalid }">
          <form class="tablet:max-w-sm mx-auto">
            <!-- Obligatoires -->
            <span class="text-common-legend text-gray-dark my-8 block">
              {{ $t('contact.form.obligatoires') }}</span
            >

            <!-- Lastname -->
            <ValidationProvider
              v-slot="{ errors }"
              class="flex"
              name="lastname"
              rules="alpha|max:200"
            >
              <div class="flex flex-col flex-1">
                <label class="text-gray-dark text-common-legend pb-2">{{
                  $t('contact.form.label.nom')
                }}</label>

                <input
                  id="lastname"
                  v-model="lastname"
                  class="form-input"
                  type="text"
                  aria-autocomplete="family-name"
                  aria-required="true"
                  name="lastname"
                  :aria-label="$t('accessibilite.aria_label.nom')"
                  :placeholder="$t('contact.form.nom')"
                />
                <span
                  v-if="errors[0]"
                  class="text-common-legend text-pink mb-4 block"
                  >{{ errors[0] }}</span
                >
              </div>
              <span class="block ml-2 text-gray-dark">*</span>
            </ValidationProvider>

            <!-- Firstname -->
            <ValidationProvider
              v-slot="{ errors }"
              class="flex"
              name="firstname"
              rules="alpha|max:200"
            >
              <div class="flex flex-col flex-1">
                <label class="text-gray-dark text-common-legend pb-2">{{
                  $t('contact.form.label.prenom')
                }}</label>

                <input
                  id="firstname"
                  v-model="firstname"
                  class="form-input"
                  type="text"
                  name="firstname"
                  aria-required="true"
                  aria-autocomplete="given-name"
                  :aria-label="$t('accessibilite.aria_label.prenom')"
                  :placeholder="$t('contact.form.prenom')"
                />
                <span
                  v-if="errors[0]"
                  class="text-common-legend text-pink mb-4 block"
                  >{{ errors[0] }}</span
                >
              </div>
              <span class="block ml-2 text-gray-dark">*</span>
            </ValidationProvider>

            <!-- E-mail -->
            <ValidationProvider
              v-slot="{ errors }"
              class="flex"
              name="email"
              rules="required|email"
            >
              <div class="flex flex-col flex-1">
                <label class="text-gray-dark text-common-legend pb-2">{{
                  $t('contact.form.label.email')
                }}</label>
                <input
                  id="email"
                  v-model="email"
                  class="form-input"
                  aria-autocomplete="email"
                  :class="{ 'border-pink': errors[0] }"
                  type="email"
                  name="firstname"
                  aria-required="true"
                  :aria-label="$t('accessibilite.aria_label.email')"
                  :placeholder="$t('contact.form.email')"
                />
                <span
                  v-if="errors[0]"
                  class="text-common-legend text-pink mb-4 block"
                  >{{ errors[0] }}</span
                >
              </div>
              <span class="block ml-2 text-gray-dark">*</span>
            </ValidationProvider>

            <!-- Description -->
            <ValidationProvider
              v-slot="{ errors }"
              class="flex"
              name="description"
              rules="required|max:5000"
            >
              <div class="flex flex-col flex-1">
                <textarea
                  id="description"
                  v-model="description"
                  class="form-textarea"
                  :class="{ 'border-pink': errors[0] }"
                  name="description"
                  aria-required="true"
                  :aria-label="$t('accessibilite.aria_label.motif_demande')"
                  :placeholder="$t('contact.form.description')"
                  rows="10"
                ></textarea>
                <span
                  v-if="errors[0]"
                  class="text-common-legend text-pink mb-4 block"
                  >{{ errors[0] }}</span
                >
              </div>
              <span class="block ml-2 text-gray-dark">*</span>
            </ValidationProvider>

            <!-- reCAPTCHA -->
            <div class="tablet:text-center">
              <recaptcha
                class="mx-auto inline-block"
                @error="onError"
                @success="onSuccess"
                @expired="onExpired"
              />
            </div>

            <!-- Submit button -->
            <Button
              class="mt-8 tablet:mx-auto block"
              :is-disabled="invalid || recaptchaToken === null"
              @click="send()"
              >{{ $t('contact.form.envoyer') }}</Button
            >

            <!-- Legal text -->
            <p class="text-common-legend text-justify text-gray-dark mt-6">
              {{ $t('contact.form.legal') }}
            </p>
            <p class="text-common-legend text-justify text-gray-dark mt-2">
              {{ $t('contact.form.legal2') }}
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
          {{ $t('contact.confirmation.title') }}
        </h1>
        <p class="mb-12 font-bold tablet:max-w-md mx-auto" role="status">
          {{ $t('contact.confirmation.description') }}
        </p>
        <NuxtLink
          :to="localePath('/')"
          class="inline-block rounded-button hover:bg-blue hover:border-blue transition-all duration-500 text-black border-black hover:text-white text-common-body-ftv px-5 py-2 border-2"
          >{{ $t('erreurs.retour-accueil') }}</NuxtLink
        >
      </div>
    </transition>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { createSEOMeta } from '~/utils/seo'

export default {
  name: 'Contact',
  auth: false,
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      lastname: null,
      firstname: null,
      email: null,
      description: null,
      isSent: false,
      recaptchaToken: null,
    }
  },
  head() {
    const url = this.$config.HOST_NAME + this.$route.fullPath
    const title = this.$i18n.t('seo.meta.contact.titre')
    const description = this.$i18n.t('contact.description')
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
    try {
      this.$wrapper.setTcVars({
        environnement: this.$config.LIVE_ENV,
        offre: 'lab',
        categorie: 'contact',
        nom_page: 'contact',
        langue: `[${this.$i18n.locale.toUpperCase()}]`,
      })
    } catch (error) {}

    this.$trackEvent('datalayer', window, { id: 'datalayer' })
  },
  methods: {
    send() {
      try {
        this.$axios
          .post(`/contact`, {
            firstname: this.firstname,
            lastname: this.lastname,
            email: this.email,
            message: this.description,
          })
          .then(() => {
            this.isSent = true
          })
      } catch (err) {
        throw new Error(err.message)
      }
    },
    onError(error) {
      // eslint-disable-next-line no-console
      console.error(error)
      this.recaptchaToken = null
    },
    onSuccess(token) {
      this.recaptchaToken = token
    },
    onExpired() {
      this.recaptchaToken = null
    },
  },
}
</script>
<style lang="postcss" scoped>
.not_required {
  width: 96%;
}
</style>
