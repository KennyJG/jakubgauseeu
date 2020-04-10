<template>
    <div>
        <div>
            <svg @click="createTextElement()" v-tooltip.top-center="'Přidat text'" class="fill-current inline-block h-6 w-6 text-gray-500 hover:text-gray-400 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M432 416h-23.41L277.88 53.69A32 32 0 0 0 247.58 32h-47.16a32 32 0 0 0-30.3 21.69L39.41 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16h-19.58l23.3-64h152.56l23.3 64H304a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM176.85 272L224 142.51 271.15 272z"/>
            </svg>
            <svg v-tooltip.top-center="'Přidat obrázek (Zatim nefunguje)'" class="fill-current inline-block h-6 w-6 text-gray-500 ml-2 hover:text-gray-400 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 336H54a6 6 0 0 1-6-6V118a6 6 0 0 1 6-6h404a6 6 0 0 1 6 6v276a6 6 0 0 1-6 6zM128 152c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zM96 352h320v-80l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L192 304l-39.515-39.515c-4.686-4.686-12.284-4.686-16.971 0L96 304v48z"/>
            </svg>
            <div v-tooltip.top-center="'Přidat tlačítko (Zatim nefunguje)'" class="h-6 w-6 text-gray-500">
            </div>
        </div>
        <div class="text-gray-500">+ Přidat element</div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    computed: {
        ...mapGetters(['layout', 'currentPageId']),

        columnHeightLeft () {
            let height = this.layout.height;

            this.layout.childs.forEach(child => {
                height = height - child.height;
            });
            return height;
        },
    },

    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'unsetAll', 'setLayout', 'deleteLayout']),

         showCreateRow() {
            this.newRow.height = this.columnHeightLeft;
            this.$modal.show('create-row');
        },

        createTextElement() {
            this.createElement('New text', 'TEXT');
        },

        createElement(value, elementType) {
            axios.post('/api/layouts', {
                name: null,
                type: 'ELEMENT',
                page_id: this.layout.page_id,
                parent_id: this.layout.id,
                value: value,
                element_type: elementType,
            }).then((response) => {
                this.getRenderedHtml(this.layout.page_id);
                this.refetchContent();
                this.$modal.hide('create-row');
                this.newRow = {name: null, height: null};
            });
        },

        deleteChildLayout(id) {
            if (confirm('Opravdu chcete vymazat tuto řádku?')) {
                this.deleteLayout(id);
                this.refetchContent();
                this.getRenderedHtml(this.currentPageId);
            }
        }
    }
}
</script>

<style>

</style>