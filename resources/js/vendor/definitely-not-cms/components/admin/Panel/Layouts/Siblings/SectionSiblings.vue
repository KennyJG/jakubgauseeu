<template>
    <div class="h-full py-6 mx-3">
        <div v-if="layout.type == 'SECTION'">
            <div>
                <div>
                    <div class="mt-3 mb-3 text-gray-800 text-center">Sekce</div>
                    <div class="mb-6">
                        <div class="flex flex-col w-full relative">
                            <div class="border-r border-l border-b w-3/4 mx-auto border-gray-800 ">
                                <div @click="setLayout(sibling.id); highlightSelected('Layout-' + sibling.id)" v-for="sibling in layout.siblings" :class="{'bg-gray-500': sibling.id === layout.id}" class="border-t border-gray-800 bg-gray-300 hover:bg-gray-400 cursor-pointer relative h-12">
                                    <div class="absolute top-0 right-0 -mr-2 -mt-2 h-6 w-6 rounded-full hover:bg-gray-100 shadow-md flex justify-center items-center hover:text-red-500 text-gray-100 bg-red-500 cursor-pointer">
                                        <svg @click.stop="deleteSection(sibling.id)" class="fill-current inline-block h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center text-gray-300">
                            |
                        </div>
                        <div class="flex justify-center">
                            <div @click="createSection()" class="h-6 w-6 rounded-full hover:bg-gray-100 shadow-sm flex justify-center items-center hover:text-cyan-500 text-gray-100 bg-gray-300 cursor-pointer">
                                <svg class="fill-current inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    data() {
        return {
        };
    },
    
    computed: {
        ...mapGetters(['layout', 'currentPageId']),
    },

    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'unsetAll', 'setLayout', 'deleteLayout', 'highlightSelected']),

        createSection() {
            axios.post('/api/layouts', {
                name: null,
                type: 'SECTION',
                page_id: this.layout.page_id,
                parent_id: null,
            }).then((response) => {
                this.getRenderedHtml(this.page.id);
                this.refetchContent();
            });
        },

        deleteSection(id) {
            if (window.confirm('Opravdu chcete odstranit tuto sekci?')) {
                this.deleteLayout(id);
                this.getRenderedHtml(this.layout.page_id);
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