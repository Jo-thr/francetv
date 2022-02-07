import { shallowMount } from '@vue/test-utils'
import title from '@/components/Title.vue'

describe('Tag', () => {
  test('is a Vue instance', () => {
    const wrapper = shallowMount(title, {
      propsData: {
        title: 'Title',
        underline: '#ffffff',
      },
    })
    expect(wrapper.vm).toBeTruthy()
  })
})
