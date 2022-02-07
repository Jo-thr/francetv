export default {
  title: ' Post/Tag',
  argTypes: {
    label: {
      control: {
        type: 'text',
      },
    },
  },
}

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  template: `<Tag :label="label" />`,
})

export const Default = Template.bind({})
Default.args = {
  label: 'Webdocumentaire',
}
