<template>
  <div
    class="flex"
    :class="{
      'flex-row justify-end': orientation === 'vertical',
      'flex-col': orientation === 'horizontal',
    }"
  >
    <!-- Facebook -->
    <ShareNetwork
      class="hover:cursor-pointer"
      :class="{
        'mx-2': orientation === 'vertical',
        'my-2': orientation === 'horizontal',
      }"
      network="facebook"
      :url="$config.HOST_NAME + $route.fullPath"
      :title="post.data.title"
      :description="post.data.excerpt"
      :hashtags="getTags()"
      @open="shared($event, 'facebook')"
    >
      <img
        :class="{ 'h-6': size === 'small' }"
        src="~/assets/img/icons/facebook_black.svg"
        :alt="
          $t('accessibilite.share.partage') + post.data.title + ' via Facebook'
        "
      />
    </ShareNetwork>

    <!-- Twitter -->
    <ShareNetwork
      class="hover:cursor-pointer"
      :class="{
        'mx-2': orientation === 'vertical',
        'my-2': orientation === 'horizontal',
      }"
      network="twitter"
      :url="$config.HOST_NAME + $route.fullPath"
      :title="post.data.title"
      :description="post.data.excerpt"
      :hashtags="getTags()"
      @open="shared($event, 'twitter')"
    >
      <img
        :class="{ 'h-6': size === 'small' }"
        src="~/assets/img/icons/twitter_black.svg"
        :alt="
          $t('accessibilite.share.partage') + post.data.title + ' via Twitter'
        "
      />
    </ShareNetwork>

    <!-- E-mail -->
    <ShareNetwork
      class="hover:cursor-pointer"
      :class="{
        'mx-2': orientation === 'vertical',
        'my-2': orientation === 'horizontal',
      }"
      network="email"
      :url="$config.HOST_NAME + $route.fullPath"
      :title="post.data.title"
      :description="post.data.excerpt"
      @open="shared($event, 'e-mail')"
    >
      <img
        :class="{ 'h-6': size === 'small' }"
        src="~/assets/img/icons/email_black.svg"
        :alt="$t('accessibilite.share.partage') + post.data.title + ' via Mail'"
      />
    </ShareNetwork>
  </div>
</template>

<script>
export default {
  name: 'ContentShare',
  props: {
    post: {
      type: Object,
      required: true,
    },
    orientation: {
      type: String,
      required: true,
    },
    size: {
      type: String,
      default: 'default',
    },
  },
  methods: {
    getTags() {
      if (this.post.tags.data.length > 0) {
        const tags = []
        this.post.tags.data.forEach((tag) => {
          tags.push(tag.data.name)
        })

        return tags.join()
      }
    },
    shared(e, type) {
      this.$trackEvent('click', e.target, {
        event_chapter1: 'partage',
        event_chapter2: type,
        event_name: this.post.slug,
      })

      this.$emit('shared')
    },
  },
}
</script>
