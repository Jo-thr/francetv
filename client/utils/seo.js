export const createSEOMeta = (meta) => [
  { hid: 'og:title', property: 'og:title', content: meta.title },
  { hid: 'description', name: 'description', content: meta.description },
  {
    hid: 'og:description',
    property: 'og:description',
    content: meta.description,
  },
  {
    hid: 'og:image',
    property: 'og:image',
    content: meta.image,
  },
  {
    hid: 'og:url',
    property: 'og:url',
    content: meta.url,
  },
  {
    hid: 'og:site_name',
    property: 'og:site_name',
    content: 'France tv lab',
  },
  {
    hid: 'og:type',
    property: 'og:type',
    content: meta.type || 'website',
  },
  {
    hid: 'twitter:card',
    name: 'twitter:card',
    content: meta.cardType || 'summary_large_image',
  },
  {
    hid: 'twitter:site',
    name: 'twitter:site',
    content: '@francetvlab',
  },
  {
    hid: 'twitter:title',
    name: 'twitter:title',
    content: meta.title,
  },
  {
    hid: 'twitter:description',
    name: 'twitter:description',
    content: meta.description,
  },
  {
    hid: 'twitter:image',
    name: 'twitter:image',
    content: meta.image,
  },
]
