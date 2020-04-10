<template>
    <div class="flex items-center px-6 pb-2">
        <svg class="fill-current text-gray-800 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M377.941 169.941V216H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.568 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296h243.882v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.568 0-33.941l-86.059-86.059c-15.119-15.12-40.971-4.412-40.971 16.97z"/>
        </svg>
        <div v-if="value != null" class="ml-4">
            <div v-if="!edit" @click="startEditing()">
                {{ value }} <span v-if="value !== null" class="italic">{{ unit }}</span>
            </div>
            <div v-else class="flex">
                <div class="w-full max-w-sm">
                    <div class="flex items-center border-b border-b-2 border-teal-500">
                        <input v-model="newHeight" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="numeric" aria-label="height"> 
                        <button @click="save()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Save</button>
                        <button @click="stopEditing()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="ml-4" v-else>
            <div v-if="!edit" @click="startEditing()" class="italic text-sm text-gray-800 opacity-75">Výška</div>
            <div v-else class="flex">
                <div class="w-full max-w-sm">
                    <div class="flex items-center border-b border-b-2 border-teal-500">
                        <input v-model="newHeight" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="numeric" aria-label="height"> 
                        <button @click="save()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Save</button>
                        <button @click="stopEditing()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'

export default {
    props: ['value', 'unit', 'availableUnits'],

    data() {
        return {
            newHeight: null,
            edit: false
        };
    },

    computed: {
        ...mapGetters(['currentPageId', 'getContent', 'getContentType'])
    },
    
    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'reselect']),

        startEditing() {
            this.edit = true;
            this.newHeight = this.value;
        },

        stopEditing() {
            this.edit = false;
            this.newHeight = null; 
        },

        save() {
            let content = this.getContent;
            let contentType = this.getContentType;
            if (content !== null) {
                axios.post('/api/styles/width', {
                    value: this.newHeight,
                    model_id: content.id,
                    model_type: contentType,
                }).then(response => {
                    this.getRenderedHtml(this.currentPageId);
                    this.stopEditing();
                    this.refetchContent();
                });
            }
        }
    }
}
</script>

<style>

</style>