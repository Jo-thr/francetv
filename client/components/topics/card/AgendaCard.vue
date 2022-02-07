<template>
  <article
    class="hover:cursor-pointer desktop:w-1/3 desktop:p-8 tablet:w-full tablet:p-4 mobile:w-full mobile:p-4"
    tabindex="0"
    @click="goToPost($event)"
  >
    <div class="flex flex-col overflow-hidden h-full justify-start">
      <!-- BORDER -->
      <div class="animBlue mb-6"></div>

      <!-- DATE -->
      <div
        class="flex flex-row font-bold mb-2"
        tabindex="0"
        :aria-label="isToday ? `${$t('topics.today')} ${startDate}` : `${$t('topics.debut')} ${startDate} ${$t('topics.fin')} ${endDate}`"
      >
        <template v-if="isToday">
          {{ $t('topics.today') }}
          <div v-if="startDate" class="px-1">
            {{ startDate }}
          </div>
        </template>
        <template v-else>
          {{ $t('topics.debut') }}
          <div v-if="startDate" class="px-1">
            {{ startDate }}
          </div>
          {{ $t('topics.fin') }}
          <div v-if="endDate" class="px-1">
            {{ endDate }}
          </div>
        </template>

      </div>
      <!-- TITLE -->
      <h2
        v-if="post.article.title[$i18n.locale]"
        class="relative float-left pb-5 w-full"
        tabindex="0"
        :aria-label="post.article.title[$i18n.locale]"
      >
        {{ post.article.title[$i18n.locale] }}
      </h2>

      <!-- DESCRIPTION -->
      <p
        v-if="post.description[$i18n.locale]"
        :aria-label="post.description[$i18n.locale]"
        class="relative w-full float-left text-gray-dark"
      >
        {{ post.description[$i18n.locale] }}
      </p>
    </div>
  </article>
</template>

<script>
export default {
  name: 'AgendaCard',
  props: {
    post: {
      type: Object,
      default: null,
    },
  },
  computed: {
    startDate({ $dayjs }) {
      $dayjs.locale(this.$i18n.locale);
      return this.post.startDate ? $dayjs(this.post.startDate).format('D MMMM') : null;
    },
    endDate({ $dayjs }) {
      $dayjs.locale(this.$i18n.locale);
      return this.post.endDate ? $dayjs(this.post.endDate).format('D MMMM') : null;
    },
    isToday() {
      return this.post.startDate === this.post.endDate;
    }
  },
  methods: {
    goToPost(e) {
      if (this.post.article.type === 'posts') {
        this.$router.push(
          this.localeRoute({
            name: `articles-slug`,
            params: {
              slug: this.article.meta.slug[this.$i18n.locale],
            },
          })
        )
      } else if (this.post.article.type === 'tests') {
        this.$router.push(
          this.localeRoute({
            name: `tests-slug`,
            params: {
              slug: this.article.meta.slug[this.$i18n.locale],
            },
          })
        )
      }
    },
  },
}
</script>

<style scoped>
.animBlue {
  width: 48px;
  height: 8px;
  background-color: #0023ff;
  transition: 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
}
div:hover > .animBlue {
  width: 64px;
  height: 8px;
  background-color: #fcfc00;
}
</style>
