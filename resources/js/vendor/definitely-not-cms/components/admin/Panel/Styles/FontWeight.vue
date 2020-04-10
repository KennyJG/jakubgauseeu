<template>
    <div class="flex items-center px-6 pb-2">
        <svg class="fill-current text-gray-800 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M432 32H16A16 16 0 0 0 0 48v80a16 16 0 0 0 16 16h32a16 16 0 0 0 16-16v-16h120v112h-24a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16h-24V112h120v16a16 16 0 0 0 16 16h32a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zm-68.69 260.69C354 283.36 336 288.36 336 304v48H112v-48c0-14.31-17.31-21.32-27.31-11.31l-80 80a16 16 0 0 0 0 22.62l80 80C94 484.64 112 479.64 112 464v-48h224v48c0 14.31 17.31 21.33 27.31 11.31l80-80a16 16 0 0 0 0-22.62z"/>
        </svg>
        <div v-if="value != null" class="ml-4">
            <div v-if="!edit" @click="startEditing()">
                {{ value }} <span v-if="value !== null" class="italic"></span>
            </div>
            <div v-else class="flex">
                <div class="w-full max-w-sm">
                    <div class="flex items-center border-b border-b-2 border-teal-500">
                        <input v-model="newFontWeight" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="numeric" aria-label="newFontWeight"> 
                        <button @click="save()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Save</button>
                        <button @click="stopEditing()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-teal-800 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="ml-4" v-else>
            <div v-if="!edit" @click="startEditing()" class="italic text-sm text-gray-800 opacity-75">Tloušťka textu</div>
            <div v-else class="flex">
                <div class="w-full max-w-sm">
                    <div class="flex items-center border-b border-b-2 border-teal-500">
                        <input v-model="newFontWeight" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="numeric" aria-label="newFontWeight"> 
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
    props: ['value'],

    data() {
        return {
            newFontWeight: null,
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
            this.newFontWeight = this.value;
        },

        stopEditing() {
            this.edit = false;
            this.newFontWeight = null; 
        },

        save() {
            let content = this.getContent;
            let contentType = this.getContentType;

            if (content !== null) {
                axios.post('/api/styles/font-weight', {
                    value: this.newFontWeight,
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