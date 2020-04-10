<template> 
    <div class="flex px-6 pb-2">
        <svg class="fill-current text-gray-800 inline-block h-4 w-4 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M432 416h-23.41L277.88 53.69A32 32 0 0 0 247.58 32h-47.16a32 32 0 0 0-30.3 21.69L39.41 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16h-19.58l23.3-64h152.56l23.3 64H304a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM176.85 272L224 142.51 271.15 272z"/>
        </svg>
        <div class="ml-4">
            <v-popover offset="16" :placement="'right-end'" :disabled="!isEnabled">
                <div v-if="value != null" class="tooltip-target b3 cursor-pointer text-sm">{{ value }}</div>
                <div v-else class="tooltip-target b3 italic text-sm text-gray-800 opacity-75">Default</div> 
                <template slot="popover">
                    <div class="flex justify-center items-center text-sm">
                        <div class="flex flex-wrap" style="width:25rem;">
                            <div @click="newFontStyle='Georgia, serif'; save();" :class="{'bg-gray-300': value === 'Georgia, serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style="font-family: Georgia, serif">
                                <div>Georgia</div>
                            </div>
                            <div @click="newFontStyle='Palatino Linotype, Book Antiqua, Palatino, serif'; save();" :class="{'bg-gray-300': value === 'Palatino Linotype, Book Antiqua, Palatino, serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Palatino Linotype, Book Antiqua, Palatino, serif'>
                                <div>Palatino Linotype</div>
                            </div>
                            <div @click="newFontStyle='Times New Roman, Times, serif'; save();" :class="{'bg-gray-300': value === 'Times New Roman, Times, serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Times New Roman, Times, serif'>
                                <div>Times New Roman</div>
                            </div>
                            <div @click="newFontStyle='Arial, Helvetica, sans-serif'; save();" :class="{'bg-gray-300': value === 'Arial, Helvetica, sans-serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style="font-family: Arial, Helvetica, sans-serif">
                                <div>Arial</div>
                            </div>
                            <div @click="newFontStyle='Arial Black, Gadget, sans-serif'; save();" :class="{'bg-gray-300': value === 'Arial Black, Gadget, sans-serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Arial Black, Gadget, sans-serif'>
                                <div>Arial Black</div>
                            </div>
                            <div @click="newFontStyle='Comic Sans MS, cursive, sans-serif'; save();" :class="{'bg-gray-300': value === 'Comic Sans MS, cursive, sans-serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Comic Sans MS, cursive, sans-serif'>
                                <div>Comic Sans MS</div>
                            </div>
                            <div @click="newFontStyle='Impact, Charcoal, sans-serif'; save();" :class="{'bg-gray-300': value === 'Impact, Charcoal, sans-serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style="font-family: Impact, Charcoal, sans-serif">
                                <div>Impact</div>
                            </div>
                            <div @click="newFontStyle='Lucida Sans Unicode, Lucida Grande, sans-serif'; save();" :class="{'bg-gray-300': value === 'Lucida Sans Unicode, Lucida Grande, sans-serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Lucida Sans Unicode, Lucida Grande, sans-serif'>
                                <div>Lucida Sans Unicode</div>
                            </div>
                            <div @click="newFontStyle='Tahoma, Geneva, sans-serif'; save();" :class="{'bg-gray-300': value === 'Tahoma, Geneva, sans-serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Tahoma, Geneva, sans-serif'>
                                <div>Tahoma</div>
                            </div>
                            <div @click="newFontStyle='Trebuchet MS, Helvetica, sans-serif'; save();" :class="{'bg-gray-300': value === 'Trebuchet MS, Helvetica, sans-serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Trebuchet MS, Helvetica, sans-serif'>
                                <div>Trebuchet MS</div>
                            </div>
                            <div @click="newFontStyle='Verdana, Geneva, sans-serif'; save();" :class="{'bg-gray-300': value === 'Verdana, Geneva, sans-serif'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Verdana, Geneva, sans-serif'>
                                <div>Verdana</div>
                            </div>
                            <div @click="newFontStyle='Courier New, Courier, monospace'; save();" :class="{'bg-gray-300': value === 'Courier New, Courier, monospace'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Courier New, Courier, monospace'>
                                <div>Courier New</div>
                            </div>
                            <div @click="newFontStyle='Lucida Console, Monaco, monospace'; save();" :class="{'bg-gray-300': value === 'Lucida Console, Monaco, monospace'}" v-close-popover class="w-1/4 p-3 text-center border-r border-b flex items-center justify-center hover:bg-gray-300 cursor-pointer" style='font-family: Lucida Console, Monaco, monospace'>
                                <div>Lucida Console</div>
                            </div>
                        </div>
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
            newFontStyle: null,

            isEnabled: true,
        }
    },

    computed: {
        ...mapGetters(['currentPageId', 'getContent', 'getContentType'])
    },
    
    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'reselect']),

        save() {
            let content = this.getContent;
            let contentType = this.getContentType;
            if (content !== null) {
                axios.post('/api/styles/font-family', {
                    value: this.newFontStyle,
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