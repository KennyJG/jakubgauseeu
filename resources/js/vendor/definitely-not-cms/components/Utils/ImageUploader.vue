<template>
  <div>
    <div class="py-4 px-8">
      <Uppy ref="uppy" v-on:files-uploaded="uploadImages"></Uppy>
      <div class="flex flex-row">
        <button
          @click="onSubmit"
          class="bg-teal-200 p-3 rounded-lg text-teal-900 hover:bg-teal-300"
        >Potvrdit</button>
        <button
          @click="onCancel"
          class="bg-gray-300 p-3 rounded-lg text-teal-900 hover:bg-gray-300"
        >Zrušit</button>
      </div>
    </div>
  </div>
</template>

<script>
import Uppy from "./Uppy";

export default {
  components: {
    Uppy
  },

  data() {
    return {
      showModal: false
    };
  },

  methods: {
    onCancel() {
      this.showModal = false;
      this.$refs.uppy.onReset();
    },
    onSubmit() {
      this.showModal = false;
      this.$refs.uppy.onUpload();
    },
    uploadImages(images) {
      console.log(images);
    }
  }
};
</script>

<style>
</style>