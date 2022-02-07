import Vue from 'vue'
import 'viewerjs/dist/viewer.css'
import Viewer from 'v-viewer'

Vue.use(Viewer, {
  defaultOptions: {
    title: false,
    movable: false,
    transition: false,
    toolbar: {
      zoomIn: 4,
      zoomOut: 4,
      oneToOne: 0,
      reset: 0,
      prev: 0,
      play: {
        show: 0,
        size: 'large',
      },
      next: 0,
      rotateLeft: 0,
      rotateRight: 0,
      flipHorizontal: 0,
      flipVertical: 0,
    },
    filter(image) {
      if (image.className.includes("no-viewer")) {
        return false;
      }
      return image.complete;
    },
  },
})
