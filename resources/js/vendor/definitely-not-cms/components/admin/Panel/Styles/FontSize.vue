<template> 
    <div class="flex items-center px-6 pb-2">
       <svg class="fill-current text-gray-800 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
            <path d="M304 32H16A16 16 0 0 0 0 48v96a16 16 0 0 0 16 16h32a16 16 0 0 0 16-16v-32h56v304H80a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16h-40V112h56v32a16 16 0 0 0 16 16h32a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zm256 336h-48V144h48c14.31 0 21.33-17.31 11.31-27.31l-80-80a16 16 0 0 0-22.62 0l-80 80C379.36 126 384.36 144 400 144h48v224h-48c-14.31 0-21.32 17.31-11.31 27.31l80 80a16 16 0 0 0 22.62 0l80-80C580.64 386 575.64 368 560 368z"/>
        </svg>
        <div v-if="value != null" class="ml-4">
            <div v-if="!edit" @click="startEditing()">
                {{ value }} <span v-if="value !== null" class="italic">{{ unit }}</span>
            </div>
            <div v-else class="flex">
                <div class="">
                    <div class="flex items-center border-b border-b-2 border-teal-500">
                        <input v-model="newFontSize" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="numeric" aria-label="height"> 
                        <button @click="save()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Save</button>
                        <button @click="stopEditing()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="ml-4" v-else>
            <div v-if="!edit" @click="startEditing()" class="italic text-sm text-gray-800 opacity-75">Velikost textu</div>
            <div v-else class="flex">
                <div class="w-full max-w-sm">
                    <div class="flex items-center border-b border-b-2 border-teal-500">
                        <input v-model="newFontSize" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="numeric" aria-label="height"> 
                        <button @click="save()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Save</button>
                        <button @click="stopEditing()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    props: ['value', 'unit'],

    data() {
        return {
            newFontSize: null,
            edit: false
        }
    },

    computed: {
        ...mapGetters(['currentPageId', 'getContent', 'getContentType'])
    },
    
    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'reselect']),

        startEditing() {
            this.edit = true;
            this.newFontSize = this.value;
        },

        stopEditing() {
            this.edit = false;
            this.newFontSize = null; 
        },

        save() {
            let content = this.getContent;
            let contentType = this.getContentType;
            if (content !== null) {
                axios.post('/api/styles/font-size', {
                    value: this.newFontSize,
                    model_id: content.id,
                    model_type: contentType,
                }).then(response => {
                    this.getRenderedHtml(this.currentPageId);
                    this.refetchContent();
                    this.stopEditing();
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