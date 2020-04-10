<template>
    <div>
        <div id="drag-drop-area" style="width: 300px;"></div>
    </div>
</template>

<script>
// const XHRUpload = require('@uppy/xhr-upload')
const cz = require('./../czechLocalUppy.js')
const Uppy = require('@uppy/core')
const Dashboard = require('@uppy/dashboard')

export default {
  data () {
    return {
      uppy: Object
    }
  },
  mounted () {
    this.uppy = Uppy({
      autoProceed: false,
      locale: cz,
      restrictions: {
        maxFileSize: 2000000,
        maxNumberOfFiles: 1,
        minNumberOfFiles: 1,
      }
    })
    this.uppy.use(Dashboard, {
      target: '#drag-drop-area',
      inline: true,
      height: '140px',
      hideUploadButton: true
    })
  },
  methods: {
    async onUpload () {
      try {
        await this.uppy.upload()
        const images = await this.collectImages(this.uppy.state.files)
        this.$emit('files-uploaded', images)
        await this.uppy.reset()
        Promise.resolve()
      } catch (err) {
        console.error(`Something went wrong! + ${err}`)
      }
    },

    async onReset () {
      await this.uppy.reset()
    },

    convertBlobToBase64 (blop) {
      return new Promise((resolve, reject) => {
        let reader = new FileReader()
        reader.readAsDataURL(blop)
        reader.onloadend = () => {
          resolve(reader.result)
        }
      })
    },

    async collectImages (files) {
      let base64Images = []
      await Promise.all(Object.keys(files).map(async (key) => {
        const image = await this.convertBlobToBase64(files[key].data)
        base64Images.push({ base64: image })
      }))
      return base64Images
    }
  }
}
</script>

<style src="uppy/dist/uppy.css"></style>
<style>
  .uppy-u-reset {
    visibility: inherit!important;
  }
</style>
