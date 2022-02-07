<template>
  <article>
    <div class="flex flex-col overflow-y-hidden">
      <!-- BANNER -->
      <ContentBanner :post="post" class="flex" />

      <!-- CONTAINER ARTICLE -->
      <div
        v-if="post.author || post.data.time"
        class="flex flex-col z-20 px-0 mx-0 desktop:px-12 desktop:container desktop:-mt-56"
      >
        <div class="h-3 bg-blue slideInBlue"></div>
        <div
          class="flex flex-col px-6 tablet:px-10 bg-white border-gray border-l-0 tablet:border-l"
        >
          <!-- HEADER -->
          <ContentHeader :post="post" />

          <!-- STORE -->
          <Store
            v-if="
              post.data.social.apple.url ||
              post.data.social.google_url.url ||
              post.data.social.oculus_url.url
            "
            :store="post.data.social"
            class="bg-white border-b border-gray"
          />
          <div
            class="flex tablet:flex-row mobile:flex-col justify-between w-full py-6 border-b border-gray bg-white"
          >
            <!-- AUTEUR & DATE PUBLICATION -->
            <div class="flex tablet:flex-row mobile:flex-col size14">
              <div
                v-if="post.author.length > 0"
                class="flex flex-row mr-2 tablet:mb-0 mobile:mb-2 text-dark"
              >
                <span class="mr-1">{{ $t('posts.footer.auteur') }}</span>
                <div
                  tabindex="0"
                  :aria-label="$t('posts.footer.auteur') + post.author[0]"
                >
                  {{ post.author[0] }}
                </div>
              </div>
              <div
                tabindex="0"
                :aria-label="
                  $t('posts.footer.date') +
                  ' ' +
                  $dayjs(post.data.published_at)
                    .locale($i18n.locale)
                    .format('L') +
                  ' ' +
                  $t('posts.footer.time') +
                  ' ' +
                  $dayjs(post.data.published_at)
                    .locale($i18n.locale)
                    .format('LT')
                "
              >
                <span class="text-gray-dark">
                  {{ $t('posts.footer.date') }}
                  {{
                    $dayjs(post.data.published_at)
                      .locale($i18n.locale)
                      .format('L')
                  }}
                  {{ $t('posts.footer.time') }}
                  {{
                    $dayjs(post.data.published_at)
                      .locale($i18n.locale)
                      .format('LT')
                  }}
                </span>
              </div>
            </div>
            <!-- TEMPS DE LECTURE -->
            <div
              v-if="post.data.time"
              class="flex flex-row items-center tablet:pt-0 mobile:pt-4"
              tabindex="0"
              :aria-label="
                $t('posts.cards.temps') +
                ' ' +
                post.data.time +
                ' ' +
                $t('posts.cards.min')
              "
            >
              <img class="mr-2" src="~/assets/img/icons/timer.svg" alt="" />
              <div class="text-gray-dark size14">
                {{ $t('posts.cards.temps') }}
                <span class="text-gray-dark font-bold"
                  >{{ post.data.time }}{{ $t('posts.cards.min') }}.</span
                >
              </div>
            </div>
          </div>

          <!-- Editor.js TOP -->
          <div
            v-if="post.data.content.top"
            v-viewer
            class="editor-js-content-v2 pt-10"
            v-html="post.data.content.top"
          ></div>

          <!-- GALERIE -->
          <Gallery
            v-if="post.data.carousel"
            :gallery="post.data.carousel"
            class="gallery"
          />

          <!-- Editor.js BOTTOM -->
          <div
            v-if="post.data.content.bottom"
            v-viewer
            class="editor-js-content-v2 pb-12"
            v-html="post.data.content.bottom"
          ></div>

          <!-- CREDIT -->
          <div
            v-if="post.data.credits && post.data.credits[$i18n.locale]"
            class="my-6"
          >
            <div
              class="editor-js-content-v2 credits pl-6 text-desktop-regular font-light"
              :aria-label="post.data.credits[$i18n.locale]"
              v-html="post.data.credits[$i18n.locale]"
            />
          </div>

          <!-- FOOTER ARTICLE-->
          <FooterEditorJs id="content_footer" :post="post" class="-mb-px" />

          <!-- STORE -->
          <Store
            v-if="
              post.data.social.apple.url ||
              post.data.social.google_url.url ||
              post.data.social.oculus_url.url
            "
            class="border-t border-gray desktop:pb-28 pb-14"
            :store="post.data.social"
          />
        </div>
      </div>

      <!-- OTHER PROJECTS -->

      <div
        class="flex w-full border-t border-gray px-6 pt-8 tablet:px-16 tablet:pt-20"
      >
        <div class="relative h-full mb-4 overflow-hidden w-max max-w-full">
          <h1
            v-infocus="'slideTop'"
            class="relative inline-block z-20 pl-4 pr-14 mb-2 pt-4 font-bold hiddenSlide"
            :aria-label="$t('posts.footer.others')"
            tabindex="0"
          >
            {{ $t('posts.footer.others') }}
          </h1>
          <div
            v-infocus="'slideInOut'"
            class="absolute hiddenSlide h-full top-9 z-10"
          >
            .
          </div>
          <div
            v-infocus="'slideIn'"
            class="absolute hiddenSlide h-full top-9 z-0 text-yellow"
          >
            .
          </div>
        </div>
      </div>
      <WrapperOthersPosts
        :posts="post.data.other_projects"
        class="px-6 tablet:px-12"
      />
    </div>
  </article>
</template>

<script>
import ContentHeader from '~/components/content/v2/Header.vue'
import ContentBanner from '~/components/content/v2/Banner.vue'
import FooterEditorJs from '~/components/content/v2/Footer.vue'
import WrapperOthersPosts from '~/components/content/v2/WrapperOthers.vue'
import Store from '~/components/content/v2/Store.vue'
import Gallery from '~/components/content/v2/Gallery.vue'

export default {
  name: 'Post',
  auth: false,
  directives: {
    infocus: {
      isLiteral: true,
      inserted: (el, binding, vnode) => {
        const f = () => {
          const rect = el.getBoundingClientRect()
          const inView =
            rect.width > 0 &&
            rect.height > 0 &&
            rect.top >= 0 &&
            rect.bottom <=
              (window.innerHeight || document.documentElement.clientHeight)
          if (inView) {
            el.classList.add(binding.value)
            window.removeEventListener('scroll', f)
          }
        }
        window.addEventListener('scroll', f)
        f()
      },
    },
  },
  components: {
    ContentHeader,
    ContentBanner,
    FooterEditorJs,
    WrapperOthersPosts,
    Store,
    Gallery,
  },
  props: {
    post: {
      type: Object,
      required: true,
    },
    fixedPodcast: {
      type: Boolean,
      default: true,
    },
  },
}
</script>

<style lang="scss" scoped>
.hiddenSlide {
  opacity: 0;
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
    -webkit-transform: translateY(-100px);
    transform: translateY(-100px);
    opacity: 0;
  }
  50% {
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}

.slideInOut {
  opacity: 1;
  width: 100%;
  background-color: #0023ff;
  animation-duration: 0.6s;
  animation-name: slideInOut;
  animation-delay: 0.8s;
  animation-timing-function: ease;
  animation-fill-mode: both;
}

@keyframes slideInOut {
  0% {
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
    opacity: 1;
  }
  30% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }
  60% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }
  100% {
    -webkit-transform: translateX(1001%);
    transform: translateX(101%);
    opacity: 1;
  }
}

.slideInBlue {
  opacity: 1;
  width: 100%;
  background-color: #0023ff;
  animation-duration: 0.3s;
  animation-name: slideInBlue;
  animation-delay: 0.9s;
  animation-timing-function: ease;
  animation-fill-mode: both;
}

@keyframes slideInBlue {
  0% {
    -webkit-transform: translateX(-1px);
    transform: translateX(-1px);
    opacity: 0;
    width: 0;
  }
  100% {
    -webkit-transform: translateX(-1px);
    transform: translateX(-1px);
    opacity: 1;
    width: calc(100% + 1px);
  }
}

.slideIn {
  opacity: 1;
  width: 100%;
  background-color: #fcfc00;
  animation-duration: 0.3s;
  animation-name: slideIn;
  animation-delay: 1s;
  animation-timing-function: ease;
  animation-fill-mode: both;
}

@keyframes slideIn {
  0% {
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
    opacity: 1;
  }
  100% {
    -webkit-transform: translateX(0%);
    transform: translateX(0%);
    opacity: 1;
  }
}

.size14 {
  font-size: 14px !important;
}

.gallery {
  @apply pt-10 pb-10 self-center;
  width: calc(100% + 4rem);
  max-width: 100vw;

  @screen tablet {
    @apply px-4 relative pt-16 pb-14;
    width: 120%;
  }

  @screen desktop {
    @apply px-4 relative pt-27 pb-20;
    width: 120%;
  }
}
</style>
