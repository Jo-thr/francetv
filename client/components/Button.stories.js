export default {
  title: 'Button',
  argTypes: {
    label: {
      control: {
        type: 'text',
      },
    },
    type: {
      control: {
        type: 'inline-radio',
        options: {
          Primary: 'primary',
          'Secondary White': 'secondary-white',
          'Secondary Black': 'secondary-black',
        },
      },
    },
    size: {
      control: {
        type: 'inline-radio',
        options: {
          Small: 'small',
          Medium: 'medium',
          Large: 'large',
        },
      },
    },
    isDisabled: {
      control: {
        type: 'boolean',
      },
    },
  },
}

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  template:
    '<Button :size="size" :isDisabled="isDisabled" :type="type">{{label}}</Button>',
})

export const Default = Template.bind({})
Default.args = {
  type: 'primary',
  label: 'label',
  size: 'medium',
  isDisabled: false,
}
