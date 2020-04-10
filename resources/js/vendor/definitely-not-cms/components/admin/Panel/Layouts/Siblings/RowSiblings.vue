<template>
    <div class="h-full py-6 mx-3">
        <div v-if="layout.type == 'ROW'">
            <div>
                <div>
                    <div class="mb-3 text-gray-800 text-center">Řádky</div>
                    <div class="">
                        <div class="flex flex-col w-full relative">
                            <div :style="{ height: ((layout.parent.height * 2) / 10) + 'px' }">
                                <div @click="setLayout(sibling.id); highlightSelected('Layout-' + sibling.id)" v-for="(sibling, index) in layout.siblings" :class="{'border-b': index == layout.siblings.length - 1, 'bg-gray-500': sibling.id === layout.id}" class="w-3/4 mx-auto border-t border-r border-l border-gray-800 bg-gray-300 hover:bg-gray-400 cursor-pointer relative" :style="{ height: ((sibling.height * 2) / 10) + 'px' }">
                                    <div class="absolute top-0 right-0 -mr-2 -mt-2 h-6 w-6 rounded-full hover:bg-gray-100 border border-white shadow flex justify-center items-center bg-red-700 hover:bg-red-600 hover:text-gray-200 text-gray-100 cursor-pointer">
                                        <svg @click.stop="deleteChildLayout(sibling.id)" class="fill-current inline-block h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div v-if="columnHeightLeft !== 0" class="w-3/4 mx-auto border-gray-500 border-dashed border-r border-l border-b bg-white relative" :style="{height: ((columnHeightLeft * 2) / 10) + 'px' }">
                                    <div class="absolute right-0 inset-y-0 flex items-center justify-center border-l border-gray-400" style="margin-right: -2.8rem">
                                        <div class="w-full text-center" style="transform: rotate(90deg); -webkit-transform: rotate(90deg); -moz-transform: rotate(90deg); -ms-transform: rotate(90deg); -o-transform: rotate(90deg);  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);">
                                            {{ columnHeightLeft }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="absolute top-0 inset-y-0 flex items-center justify-center border-r border-gray-400 -ml-2">
                                <div class="w-full text-center" style="transform: rotate(-90deg); -webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg); -ms-transform: rotate(-90deg); -o-transform: rotate(-90deg);  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);">
                                    {{ layout.parent.height }}
                                </div>
                            </div>
                        </div>

                        <div class="text-center text-gray-300">
                            |
                        </div>
                        <div class="flex justify-center">
                            <div @click="showCreateRow()" class="h-6 w-6 rounded-full hover:bg-gray-100 shadow-sm flex justify-center items-center hover:text-cyan-500 text-gray-100 bg-gray-300 cursor-pointer">
                                <svg class="fill-current inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal name="create-row" height="auto" :scrollable="true" :width="300">
            <div class="px-6 py-3">
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full px-2 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs mb-2" for="page-name">
                            Jméno <span class="italic text-gray-500 lowercase font-medium">(dobrovolné)</span>
                        </label>
                        <input v-model="newRow.name" class="appearance-none block w-full bg-white text-gray-700 border rounded py-2 px-2 mb-1 leading-tight focus:outline-none focus:bg-white" type="text">
                    </div>
                    <div class="w-full px-2 mb-6 md:mb-0 mt-2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs mb-2" for="page-url-path">
                            Výška
                        </label>
                        <input v-model="newRow.height" :max="columnHeightLeft" class="appearance-none block w-full bg-white text-gray-700 border rounded py-2 px-2 mb-1 leading-tight focus:outline-none focus:bg-white" type="number">
                    </div>
                </div>
                <div class="flex -mx-3 mt-3">
                    <div class="w-1/2 px-1 mb-6 md:mb-0 text-xs">
                        <button @click="createRow()" class="w-full py-2 bg-teal-600 hover:bg-teal-600 rounded shadow uppercase text-white hover:bg-teal-700" style="outline: none">Vytvořit</button>
                    </div>
                     <div class="w-1/2 px-1 mb-6 md:mb-0 text-xs">
                        <button @click="$modal.hide('create-row')" class="w-full py-2 bg-teal-600 hover:bg-teal-600 rounded shadow uppercase text-white hover:bg-teal-700" style="outline: none">Zrušit</button>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    data() {
        return {
            newRow: {
                name: null,
                height: null
            }
        };
    },
    
    computed: {
        ...mapGetters(['layout', 'currentPageId']),

        columnHeightLeft () {
            let height = this.layout.parent.height;

            this.layout.parent.childs.forEach(child => {
                height = height - child.height;
            });
            return height;
        },
    },

    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'unsetAll', 'setLayout', 'deleteLayout', 'highlightSelected']),

       ...mapActions(['getRenderedHtml', 'refetchContent', 'unsetAll', 'setLayout', 'deleteLayout', 'highlightSelected']),

        showCreateRow() {
            this.newRow.height = this.columnHeightLeft;
            this.$modal.show('create-row');
        },

        createRow() {
            axios.post('/api/layouts', {
                name: this.newRow.name,
                type: 'ROW',
                page_id: this.layout.page_id,
                parent_id: this.layout.parent.id,
                height: this.newRow.height,
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
    .tooltip {
        display: block !important;
        z-index: 10000;
    }
    .tooltip .tooltip-inner {
        background: black;
        color: white;
        border-radius: 16px;
        padding: 5px 10px 4px;
    }
    .tooltip .tooltip-arrow {
        width: 0;
        height: 0;
        border-style: solid;
        position: absolute;
        margin: 5px;
        border-color: black;
        z-index: 1;
    }
    .tooltip[x-placement^="top"] {
        margin-bottom: 5px;
    }
    .tooltip[x-placement^="top"] .tooltip-arrow {
        border-width: 5px 5px 0 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        bottom: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }
    .tooltip[x-placement^="bottom"] {
        margin-top: 5px;
    }
    .tooltip[x-placement^="bottom"] .tooltip-arrow {
        border-width: 0 5px 5px 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-top-color: transparent !important;
        top: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }
    .tooltip[x-placement^="right"] {
        margin-left: 5px;
    }
    .tooltip[x-placement^="right"] .tooltip-arrow {
        border-width: 5px 5px 5px 0;
        border-left-color: transparent !important;
        border-top-color: transparent !important;
        border-bottom-color: transparent !important;
        left: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }
    .tooltip[x-placement^="left"] {
        margin-right: 5px;
    }
    .tooltip[x-placement^="left"] .tooltip-arrow {
        border-width: 5px 0 5px 5px;
        border-top-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        right: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }
    .tooltip[aria-hidden='true'] {
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.15s, visibility 0.15s;
    }
    .tooltip[aria-hidden='false'] {
        visibility: visible;
        opacity: 1;
        transition: opacity 0.15s;
    }
</style>