export default {
  title: 'Post/Topic Banner',
  argTypes: {
    title: {
      control: {
        type: 'text',
      },
    },
    description: {
      control: {
        type: 'text',
      },
    },
    textBlack: {
      control: {
        type: 'boolean',
      },
    },
    background: {
      control: {
        type: 'color',
      },
    },
    underline: {
      control: {
        type: 'color',
      },
    },
  },
}

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  template: `<TopicBanner :title="title" :description="description" :text-black="textBlack" :background="background" :underline="underline"/>`,
})

export const Default = Template.bind({})
Default.args = {
  title: 'Titre',
  description:
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
  textBlack: false,
  background: '#0023FF',
  underline: '#FF778B',
}
