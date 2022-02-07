import Vue from 'vue'
import tcWrapper from 'vue-tag-commander'

const wrapper = tcWrapper.getInstance()

function slugify(string) {
  const a =
    'àáäâãåăæąçćčđďèéěėëêęğǵḧìíïîįłḿǹńňñòóöôœøṕŕřßşśšșťțùúüûǘůűūųẃẍÿýźžż·/-,:;&'
  const b =
    'aaaaaaaaacccddeeeeeeegghiiiiilmnnnnooooooprrsssssttuuuuuuuuuwxyyzzz_______'
  const p = new RegExp(a.split('').join('|'), 'g')
  return (
    string
      .toString()
      .toLowerCase()
      .replace(/\s+/g, '_') // Replace spaces with _
      .replace(p, (c) => b.charAt(a.indexOf(c))) // Replace special characters
      // eslint-disable-next-line no-useless-escape
      .replace(/[^\w\-]+/g, '') // Remove all non-word characters
      // eslint-disable-next-line no-useless-escape
      .replace(/\_\_+/g, '_') // Replace multiple - with single -
      .replace(/^_+/, '') // Trim _ from start of text
      .replace(/_+$/, '') // Trim _ from end of text
  )
}
export default ({ app }, inject, consent) => {
  // Set debug for development purpose if needed
  if (app.$config.LIVE_ENV !== 'production') {
    wrapper.setDebug(true)
  }

  // Make the wrapper available in app context
  inject('wrapper', wrapper)

  // Added a trackEvent function in the nuxt context to replace all special characters and spaces with _.
  inject('trackEvent', (eventLabel, htmlElement, eventData) => {
    Object.keys(eventData).forEach((key) => {
      if (typeof eventData[key] === 'string') {
        eventData[key] = slugify(eventData[key])
      }
    })

    wrapper.triggerEvent(eventLabel, htmlElement, eventData)
  })
}
// Make the wrapper available in Vue
Vue.prototype.$wrapper = wrapper
