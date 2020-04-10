<template>
    <div class="h-full py-6 mx-3">
        <div v-if="layout.type == 'COLUMN'">
            <div>
                <div class="mb-3 text-gray-800 text-center">Sloupce</div>
                <div class="w-full bg-gray-100 border-dashed border-gray-800 border flex">
                    <div @click="setLayout(sibling.id); highlightSelected('Layout-' + sibling.id)" v-for="(sibling, index) in layout.siblings" :style="'width:' + 100 / layout.siblings.length + '%'" :class="{'border-r': index !== layout.siblings.length - 1, 'bg-gray-500': sibling.id === layout.id}" class="h-32 border-gray-700 flex justify-center items-center bg-gray-300 hover:bg-gray-400 cursor-pointer">
                        <div>{{ Math.round(100 / layout.siblings.length) + '%' }}</div>
                    </div>
                </div>
                <div class="text-center text-gray-300">|</div>
                <div class="flex justify-center">
                    <div @click="createColumn()" class="h-6 w-6 rounded-full hover:bg-gray-100 shadow-sm flex justify-center items-center hover:text-cyan-500 text-gray-100 bg-gray-300 cursor-pointer">
                        <svg class="fill-current inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/>
                        </svg>
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

        createColumn() {
            axios.post('/api/layouts', {
                name: null,
                type: 'COLUMN',
                page_id: this.layout.page_id,
                parent_id: this.layout.parent.id,
            }).then((response) => {
                this.getRenderedHtml(this.layout.page_id);
                this.refetchContent();
            });
        },
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