<template>
    <div class="flex px-6 pb-2">
        <div class="flex">
           <v-popover offset="16" :placement="'right-end'" :disabled="!isEnabled">
                <div v-if="value != null" class="border border-black relative">
                    <div class="tooltip-target b3">
                        <img class="object-contain cursor-pointer" :src="'/storage/images/' + value">
                    </div>
                    <svg @click.stop="deleteBackgroundImage()" class="absolute top-0 right-0 fill-current inline-block h-5 w-5 -mt-2 -mr-2 bg-white hover:text-red-600 cursor-pointer text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"/>
                    </svg>
                </div>

                <div v-else class="w-full bg-gray-100 border-black border flex justify-center items-center flex-col shadow-md cursor-pointer">
                    <svg class="fill-current text-gray-500 inline-block w-6/12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z"/>
                    </svg>
                    <div class="text-gray-500 pb-2">No Image</div>
                </div>
                <template slot="popover">
                    <div class="flex justify-center items-center">
                        <Uppy ref="uppy" v-on:files-uploaded="uploadImages"></Uppy>
                    </div>
                    <div class="flex">
                        <button class="w-1/2 px-2 py-1 border-t text-teal-600 bg-white border-gray-400 hover:bg-teal-600 hover:text-gray-100 shadow-lg" @click="onSubmit()" v-close-popover style="outline:none">Save</button>
                        <button class="w-1/2 px-2 py-1 border-t text-gray-700 bg-white border-l border-gray-400 hover:bg-teal-600 hover:text-gray-100 shadow-lg" v-close-popover style="outline:none">Cancel</button>
                    </div>
                </template>
            </v-popover>
           
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    props: ['value'],

    data() {
        return {
            imagesToUpload: {},

            isEnabled: true,
        }
    },

    computed: {
        ...mapGetters(['page', 'layout', 'menu', 'menuItem', 'currentPageId'])
    },
    
    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'reselect']),

        getContentType() {
            if (this.layout) {
                return 'App\\OPWilim\\Layouts\\Layout';
            } else if (this.menuItem) {
                return 'App\\OPWilim\\Menus\\MenuItem';
            } else if (this.menu) {
                return 'App\\OPWilim\\Menus\\Menu';
            } else if (this.page) {
                return 'App\\OPWilim\\Pages\\Page';
            }
            return null;
        },

        getContent() {
            if (this.layout) {
                return this.layout;
            } else if (this.menuItem) {
                return this.menuItem;
            } else if (this.menu) {
                return this.menu;
            } else if (this.page) {
                return this.page;
            }
            return null;
        },

        save() {
            let content = this.getContent(); 
            let contentType = this.getContentType();
            if (content !== null) {
                axios.post('/api/styles/background-image', {
                    value: this.imagesToUpload,
                    model_id: content.id,
                    model_type: contentType,
                }).then(response => {
                    this.getRenderedHtml(this.currentPageId);
                    this.refetchContent();
                });
            }
        },

        uploadImages: function(images) {
            this.imagesToUpload = images;
            this.save();
        },

        onSubmit() {
            this.$refs.uppy.onUpload();
        },

        deleteBackgroundImage() {
            let content = this.getContent(); 
            let contentType = this.getContentType();
            if (content !== null) {
                axios.delete('/api/styles/background-image?model_id=' + content.id + '&model_type=' + contentType)
                    .then(response => {
                        this.getRenderedHtml(this.currentPageId);
                        this.refetchContent();
                    });
            }
        }
    },
}
</script>

<style>
.tooltip {
    z-index: 9999999999;
}
.tooltip.popover .popover-inner {
	 background: #f9f9f9;
	 color: black;
	 border-radius: 5px;
	 box-shadow: 0 5px 30px rgba(0, 0, 0, .1);
}
 .tooltip.popover .popover-arrow {
	 border-color: #f9f9f9;
}
 
</style>