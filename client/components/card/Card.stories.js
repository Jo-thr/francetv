export default {
  title: 'Post/Card',
  argTypes: {
    link: {
      control: {
        type: 'text',
      },
    },
    linkTitle: {
      control: {
        type: 'text',
      },
    },
    externalLink: {
      control: {
        type: 'boolean',
      },
    },
    imgSrc: {
      control: {
        type: 'text',
      },
    },
    imgAlt: {
      control: {
        type: 'text',
      },
    },
    heading: {
      control: {
        type: 'text',
      },
    },
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
    type: {
      control: {
        type: 'text',
      },
    },
    time: {
      control: {
        type: 'number',
      },
    },
    highlight: {
      control: {
        type: 'boolean',
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
  },
}

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  template: `<div class="flex flex-wrap mobile:-my-2 tablet:-m-2 overflow-hidden">
                <Card
                    :link="link"
                    :link-title="linkTitle"
                    :external-link="externalLink"
                    :img-src="imgSrc"
                    :img-alt="imgAlt"
                    :heading="heading"
                    :title="title"
                    :description="description"
                    :type="type"
                    :time="time"
                    :highlight="highlight"
                    :size="size"
                /><Card
                    :link="link"
                    :link-title="linkTitle"
                    :external-link="externalLink"
                    :img-src="imgSrc"
                    :img-alt="imgAlt"
                    :heading="heading"
                    :title="title"
                    :description="description"
                    :type="type"
                    :time="time"
                    :highlight="highlight"
                    :size="size"
                /><Card
                    :link="link"
                    :link-title="linkTitle"
                    :external-link="externalLink"
                    :img-src="imgSrc"
                    :img-alt="imgAlt"
                    :heading="heading"
                    :title="title"
                    :description="description"
                    :type="type"
                    :time="time"
                    :highlight="highlight"
                    :size="size"
                />
                <Card
                    :link="link"
                    :link-title="linkTitle"
                    :external-link="externalLink"
                    :img-src="imgSrc"
                    :img-alt="imgAlt"
                    :heading="heading"
                    :title="title"
                    :description="description"
                    :type="type"
                    :time="time"
                    :highlight="highlight"
                    :size="size"
                />
            </div>`,
})

export const Default = Template.bind({})
Default.args = {
  link:
    'https://www.francetelevisions.fr/lab/projets/la-nouvelle-dimension-de-la-realite-augmentee',
  linkTitle:
    "Aller sur l'article 'La nouvelle dimension de la réalité augmentée'",
  externalLink: false,
  imgSrc: 'https://dummyimage.com/600x400',
  imgAlt: "Alt de l'image",
  heading: 'Rubrique',
  title:
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
  description:
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
  type: 'À voir',
  time: 9,
  highlight: false,
  size: 'medium',
}
