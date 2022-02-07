<template>
  <footer class="text-white font-light" role="contentinfo">
    <div
      class="bg-blue flex flex-col desktop:flex-row desktop:justify-between desktop:items-center desktop:px-40 text-center py-6 px-8 text-mobile-h5"
    >
      <p class="mb-4 desktop:mb-0">
        {{ $t('footer.une-question') }}
        <nuxt-link
          :to="localePath('/contact')"
          title="Aller sur la page de contact."
          class="underline hover:font-normal"
          >{{ $t('footer.aide-contact') }}</nuxt-link
        >
      </p>

      <!-- Socials media -->
      <div class="flex flex-col desktop:flex-row items-center">
        <p class="mb-3 desktop:mb-0 text-normal">
          {{ $t('footer.retrouvez-ftvlab') }}
        </p>
        <ul class="flex justify-center">
          <li v-for="(social, index) in socials" :key="index" class="mx-1">
            <a :href="social.link" target="_blank" rel="noopener noreferrer"
              ><img :src="social.imgSrc" :alt="social.imgAlt"
            /></a>
          </li>
        </ul>
      </div>
    </div>

    <div
      class="bg-black p-5 desktop:p-10 text-common-legend flex justify-center align-center flex-wrap"
    >
      <div
        v-for="(link, index) in links"
        :key="index"
        class="flex justify-center items-center"
      >
        <a
          v-if="link.label !== 'footer.gestion-cookies'"
          :href="link.link"
          :title="link.title"
          target="_blank"
          rel="noopener noreferrer"
          class="my-2 desktop:my-0 hover:underline"
          >{{ $t(link.label) }}</a
        >
        <a
          v-else
          href="javascript:Didomi.preferences.show()"
          class="my-2 desktop:my-0 hover:underline"
        >
          {{ $t(link.label) }}
        </a>
        <span
          v-if="index + 1 < links.length"
          class="inline-block h-4 bg-white w-px mx-3 my-2 desktop:my-0"
        ></span>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  name: 'FooterMobile',
  data() {
    return {
      socials: [
        // {
        //   link: '',
        //   imgSrc: require('~/assets/img/icons/facebook.svg'),
        //   imgAlt: 'Facebook France tv lab',
        // },
        {
          link: 'https://twitter.com/francetvlab',
          imgSrc: require('~/assets/img/icons/twitter.svg'),
          imgAlt: 'Twitter France tv lab',
        },
        {
          link: 'https://www.youtube.com/channel/UCOxGtXJVqzsPpBHCe2hzWzQ',
          imgSrc: require('~/assets/img/icons/youtube.svg'),
          imgAlt: 'Youtube France tv lab',
        },
        // {
        //   link: '',
        //   imgSrc: require('~/assets/img/icons/instagram.svg'),
        //   imgAlt: 'Instagram France tv lab',
        // },
        // {
        //   link: '',
        //   imgSrc: require('~/assets/img/icons/linkedin.svg'),
        //   imgAlt: 'LinkedIn France tv lab',
        // },
      ],
      links: [
        {
          link: 'https://www.francetelevisions.fr/cgu',
          title: '',
          label: 'footer.cgu',
        },
        {
          link: 'https://www.francetelevisions.fr/mentions-legales',
          title: '',
          label: 'footer.mentions-legales',
        },
        {
          link: 'https://www.francetelevisions.fr/groupe/confidentialite',
          title: '',
          label: 'footer.confidentialite',
        },
        {
          link: 'https://www.francetelevisions.fr/et-vous/aide-et-contact',
          title: '',
          label: 'footer.contactez-nous',
        },
        {
          link: 'https://www.francetelevisions.fr/avantages-compte-utilisateur',
          title: '',
          label: 'footer.pourquoi-inscrire',
        },
        {
          link: '',
          title: '',
          label: 'footer.gestion-cookies',
        },
      ],
    }
  },
}
</script>
