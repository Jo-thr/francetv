<template>
  <nav
    class="bg-blue fixed z-50 top-0 left-0 h-full w-full overflow-y-scroll overflow-hidden"
  >
    <!-- Metanav -->
    <NavbarMetanav @close-menu="$emit('close-menu')" />

    <div class="px-4 py-6 inline-flex flex-col">
      <nuxt-link
        class="font-bold text-mobile-h3 text-white mb-3"
        :to="localePath({ name: 'index' })"
        >France tv lab</nuxt-link
      >

      <!-- Topics -->
      <ul>
        <li v-for="(topic, index) in topics" :key="index" class="list-none">
          <nuxt-link
            class="font-bold text-mobile-h4 text-white my-6 block"
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
      <hr class="border-4 border-white w-8 my-6" />

      <!-- Tests -->
      <nuxt-link
        :to="
          localePath({
            name: 'topics-slug',
            params: { slug: 'tests' },
          })
        "
        titlle="Aller sur la page des tests."
        class="font-bold text-mobile-h4 text-white my-3 flex items-center"
        @click.native="
          $trackEvent('click', $event.target, {
            event_chapter1: 'header',
            event_name: 'testez',
          })
        "
      >
        <TestsLogo class="text-white fill-current h-4 mr-1" />
        <span>{{ $t('navbar.tests') }}</span>
      </nuxt-link>

      <!-- Meta-media -->
      <nuxt-link
        :to="
          localePath({
            name: 'topics-slug',
            params: { slug: 'meta-media' },
          })
        "
        title="Aller sur la page meta-media."
        class="font-bold text-mobile-h4 text-white my-3"
        @click.native="
          $trackEvent('click', $event.target, {
            event_chapter1: 'header',
            event_name: 'metamedia',
          })
        "
        >{{ $t('navbar.meta-media') }}</nuxt-link
      >

      <!-- Contact -->
      <nuxt-link
        :to="localePath('/contact')"
        title="Aller sur la page de contact."
        class="font-bold text-mobile-h4 text-white my-3"
        @click.native="
          $trackEvent('click', $event.target, {
            event_chapter1: 'header',
            event_name: 'contact',
          })
        "
        >{{ $t('navbar.contact') }}</nuxt-link
      >
    </div>
  </nav>
</template>

<script>
import TestsLogo from '~/assets/img/icons/tests.svg?inline'

export default {
  name: 'NavbaMobileMenu',
  components: {
    TestsLogo,
  },
  props: {
    topics: {
      type: Array,
      required: true,
    },
  },
}
</script>
