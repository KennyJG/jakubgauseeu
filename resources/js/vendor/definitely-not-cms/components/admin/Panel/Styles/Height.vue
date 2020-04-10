<template>
    <div class="flex items-center px-6 pb-2">
        <svg class="fill-current text-gray-800 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
            <path d="M214.059 377.941H168V134.059h46.059c21.382 0 32.09-25.851 16.971-40.971L144.971 7.029c-9.373-9.373-24.568-9.373-33.941 0L24.971 93.088c-15.119 15.119-4.411 40.971 16.971 40.971H88v243.882H41.941c-21.382 0-32.09 25.851-16.971 40.971l86.059 86.059c9.373 9.373 24.568 9.373 33.941 0l86.059-86.059c15.12-15.119 4.412-40.971-16.97-40.971z"/>
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
        ...mapGetters(['page', 'layout', 'menu', 'menuItem', 'currentPageId'])
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
            let content = null;
            let contentType = null;
            if (this.layout) {
                content = this.layout;
                contentType = 'App\\OPWilim\\Layouts\\Layout';
            } else if (this.menuItem) {
                content = this.menuItem;
                contentType = 'App\\OPWilim\\Menus\\MenuItem';
            } else if (this.menu) {
                content = this.menu;
                contentType = 'App\\OPWilim\\Menus\\Menu';
            } else if (this.page) {
                content = this.page;
                contentType = 'App\\OPWilim\\Pages\\Page';
            }
            
            if (content !== null) {
                axios.post('/api/styles/height', {
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