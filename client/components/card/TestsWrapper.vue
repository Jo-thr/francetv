<template>
  <div>
    <Title :title="$t('tests.testez_notez_partagez')" class="text-center" />
    <!-- Open tests -->

    <!-- Search bar -->
    <!-- <div class="text-gray-dark border-b border-gray max-w-lg mx-auto mb-6 flex">
      <input
        v-model="searchQuery"
        class="bg-transparent focus:outline-none py-2 px-4 block appearance-none flex-1"
        type="search"
        placeholder="Thématique"
      />
      <img
        src="~/assets/img/icons/search.svg"
        :alt="$t('accessibilite.img-alt.icon-recherche')"
      />
    </div> -->

    <!-- Filters -->
    <!-- <div class="flex justify-center mb-24">
      <button class="text-gray-darker border border-gray-light px-6 py-4">
        {{ $t('tests.plus_votes') }}
      </button>
      <button class="text-gray-darker border border-gray-light px-6 py-4">
        {{ $t('tests.plus_testes') }}
      </button>
      <button class="text-gray-darker border border-gray-light px-6 py-4">
        {{ $t('tests.plus_partages') }}
      </button>
    </div> -->

    <CardWrapper
      :posts-page="openTestsPage"
      :posts="filteredTests"
      class="my-24"
      @display-more="$emit('display-more')"
    />

    <!-- Last chance to test -->
    <Title
      v-if="layout.secondary && layout.secondary.block3"
      :title="$t('tests.derniere_chance')"
      class="mb-12 text-center"
    />

    <Highlight
      v-if="layout.secondary && layout.secondary.block3"
      class="mb-10 tablet:mb-5"
      :post="layout.secondary"
    />

    <!-- Finished tests -->
    <Button
      v-if="testsFinished.length === 0"
      class="mx-auto block mt-16"
      aria-label="Voir les tests précédents, bouton"
      @click="displayPreviousTests(1)"
      >{{ $t('tests.tests_precedents') }}</Button
    >

    <CardWrapper
      v-else
      :posts="testsFinished"
      :posts-page="testsFinishedPage"
      class="my-24"
      @display-more="loadMoreTestsFinished()"
    />
  </div>
</template>

<script>
export default {
  name: 'TestWrapper',
  props: {
    openTests: {
      type: Array,
      required: true,
    },
    openTestsPage: {
      type: Object,
      required: true,
    },
    layout: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      searchQuery: null,
      testsFinished: [],
      testsFinishedPage: null,
    }
  },
  computed: {
    filteredTests() {
      if (this.searchQuery) {
        return this.openTests.filter((test) => {
          return this.searchQuery
            .toLowerCase()
            .split(' ')
            .every((v) => test.data.title.toLowerCase().includes(v))
        })
      } else {
        return this.openTests
      }
    },
  },
  methods: {
    loadMoreTestsFinished() {
      if (
        this.testsFinishedPage.current_page <= this.testsFinishedPage.last_page
      ) {
        this.displayPreviousTests(this.testsFinishedPage.current_page + 1)
      }
    },
    async displayPreviousTests(page) {
      try {
        const data = await this.$axios.$get('/tests', {
          params: {
            lang: this.$i18n.locale,
            type: 'finished',
            page,
          },
        })
        this.testsFinished = [...this.testsFinished, ...data.data]
        this.testsFinishedPage = data.meta
      } catch (err) {
        throw new Error(err.message)
      }
    },
  },
}
</script>
