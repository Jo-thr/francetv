<template>
  <div class="flex flex-col justify-center items-end pt-5">
    <div class="flex flex-col relative slideBottom w-full">
      <!-- Share DESKTOP & TABLET-->
      <LinkShare
        :post="post"
        orientation="vertical"
        class="tablet:flex mobile:hidden"
        @shared="$emit('shared')"
      />

      <div class="flex flex-col w-full">
        <!-- Tag & Age -->
        <div
          class="flex flex-row items-center mb-2 slideTop"
          style="animation-delay: 1s"
        >
          <ul v-if="tagsData.length > 0" class="flex flex-wrap widthMax pr-1">
            <li v-for="(tag, index) in tagsData" :key="index" class="maj">
              <nuxt-link
                :to="
                  localePath({
                    name: 'tags-slug',
                    params: { slug: tag.data.slug },
                  })
                "
                :aria-label="tag.data.name"
                >{{ tag.data.name }}</nuxt-link
              ><span class="font-bold pr-1">,</span>
            </li>
          </ul>
          <div
            class="ml-3 p-1 rounded border border-gray text-common-legend min-w-max font-bold"
            tabindex="0"
          >
            <p
              v-if="post.data.age && $i18n.locale === 'fr'"
              :aria-label="post.data.age.fr"
            >
              {{ post.data.age.fr }}
            </p>
            <p
              v-if="post.data.age && $i18n.locale === 'en'"
              :aria-label="post.data.age.en"
            >
              {{ post.data.age.en }}
            </p>
          </div>
        </div>
        <!-- Title -->
        <h2
          class="font-bold mb-6 mt-3 leading-10 slideTop"
          style="font-size: 40px; animation-delay: 1.1s"
          tabindex="0"
          :aria-label="post.data.title"
        >
          <span class="text-blue">{{ post.data.title }}</span>
        </h2>
        <!-- DESCRIPTION -->
        <p
          v-if="post.data.excerpt && post.data.excerpt.length > 0"
          class="pb-8 tablet:border-gray tablet:border-b tablet:border-gray slideTop size20"
          style="animation-delay: 1.2s"
          v-html="post.data.excerpt"
        >
          {{ post.data.excerpt }}
        </p>
      </div>

      <!-- Share MOBILE -->
      <LinkShare
        :post="post"
        orientation="vertical"
        class="desktop:hidden tablet:hidden pb-8 border-b border-gray"
        @shared="$emit('shared')"
      />
    </div>
  </div>
</template>

<script>
import LinkShare from './Share.vue'

export default {
  name: 'ContentHeader',
  components: {
    LinkShare,
  },
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      tagsData: this.post.tags.data,
    }
  },
}
</script>

<style lang="postcss" scoped>
li:last-child span {
  display: none;
}

.slideTop {
  opacity: 1;
  animation-name: slide-top;
  animation-duration: 0.4s;
  animation-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);
  animation-fill-mode: both;
}
@keyframes slide-top {
  0% {
    -webkit-transform: translateY(-50px);
    transform: translateY(-50px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}

.slideBottom {
  opacity: 1;
  animation-name: slide-bottom;
  animation-duration: 0.5s;
  animation-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);
  animation-fill-mode: both;
  animation-delay: 0.5s;
}
@keyframes slide-bottom {
  0% {
    -webkit-transform: translateY(20px);
    transform: translateY(20px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}

.widthMax {
  max-width: 85%;
}

.maj {
  font-size: 16px;
  font-style: normal;
  font-weight: 700;
  text-align: left;
}
.maj::first-letter {
  text-transform: uppercase;
}
.size20 {
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 31px;
  text-align: left;
}
</style>
