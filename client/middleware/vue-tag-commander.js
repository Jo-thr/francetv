import tcWrapper from 'vue-tag-commander'

export default function ({ route }) {
  // on client side only
  if (process.client) {
    // instanciate the wrapper
    const wrapper = tcWrapper.getInstance()

    // If meta is set add Variables to TC
    if (route.meta[0].tcVars) {
      wrapper.setTcVars(route.meta[0].tcVars)
    }

    // Reload all containers
    wrapper.reloadAllContainers()
  }
}
