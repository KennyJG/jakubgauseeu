<template>
    <div class="flex px-6 pb-2">
        <svg class="fill-current text-gray-800 inline-block h-4 w-4 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M204.3 5C104.9 24.4 24.8 104.3 5.2 203.4c-37 187 131.7 326.4 258.8 306.7 41.2-6.4 61.4-54.6 42.5-91.7-23.1-45.4 9.9-98.4 60.9-98.4h79.7c35.8 0 64.8-29.6 64.9-65.3C511.5 97.1 368.1-26.9 204.3 5zM96 320c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm32-128c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128-64c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 64c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/>
        </svg>
        <div class="ml-4">
           <v-popover offset="16" :placement="'right-end'" :disabled="!isEnabled">
                <div v-if="value != null" class="tooltip-target b3 h-6 w-6 cursor-pointer border" :style="{'background-color': value }"></div>
                <svg v-else class="tooltip-target b3 fill-current text-gray-800 inline-block h-6 w-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path d="M512 320s-64 92.65-64 128c0 35.35 28.66 64 64 64s64-28.65 64-64-64-128-64-128zm-9.37-102.94L294.94 9.37C288.69 3.12 280.5 0 272.31 0s-16.38 3.12-22.62 9.37l-81.58 81.58L81.93 4.76c-6.25-6.25-16.38-6.25-22.62 0L36.69 27.38c-6.24 6.25-6.24 16.38 0 22.62l86.19 86.18-94.76 94.76c-37.49 37.48-37.49 98.26 0 135.75l117.19 117.19c18.74 18.74 43.31 28.12 67.87 28.12 24.57 0 49.13-9.37 67.87-28.12l221.57-221.57c12.5-12.5 12.5-32.75.01-45.25zm-116.22 70.97H65.93c1.36-3.84 3.57-7.98 7.43-11.83l13.15-13.15 81.61-81.61 58.6 58.6c12.49 12.49 32.75 12.49 45.24 0s12.49-32.75 0-45.24l-58.6-58.6 58.95-58.95 162.44 162.44-48.34 48.34z"/>
                </svg>
                <template slot="popover">
                    <div class="flex justify-center items-center">
                        <chrome-picker v-model="colors"></chrome-picker>
                    </div>
                    <div class="flex">
                        <button class="w-1/2 px-2 py-1 border-t text-teal-600 bg-white border-gray-400 hover:bg-teal-600 hover:text-gray-100 shadow-lg" @click="setBackgroundColor()" v-close-popover style="outline:none">Save</button>
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
            colors: {
                hex: '#194d33',
                hsl: { h: 150, s: 0.5, l: 0.2, a: 1 },
                hsv: { h: 150, s: 0.66, v: 0.30, a: 1 },
                rgba: { r: 25, g: 77, b: 51, a: 1 },
                a: 1
            },

            isEnabled: true,
        }
    },

    computed: {
        ...mapGetters(['currentPageId', 'getContent', 'getContentType'])
    },
    
    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'reselect']),

        showModal(name) {
            this.$modal.show(name);
        },

        hideModal(name) {
            this.$modal.hide(name);
        },

        setBackgroundColor() {
            let content = this.getContent;
            let contentType = this.getContentType;
            if (content !== null) {
                axios.post('/api/styles/background-color', {
                    value: 'rgba(' + this.colors.rgba.r + ',' + this.colors.rgba.g + ',' + this.colors.rgba.b + ',' + this.colors.a + ')',
                    model_id: content.id,
                    model_type: contentType,
                }).then(response => {
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