<template>
    <div>
        <div v-if="layout">
            <nav class="text-xs text-gray-600 font-bold py-3 px-3 bg-gray-300" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex flex-wrap">
                    <li v-for="content in layout.structure_route"
                        @click="selectContent({contentId: content.id, contentType: content.hasOwnProperty('type') ? 'LAYOUT' : 'PAGE'}); highlightSelected('Layout-' + content.id)"
                        class="flex items-center hover:text-gray-800 cursor-pointer">
                        <div>{{ content.hasOwnProperty('type') ? getTranslatedContentType(content.type) : 'Stránka' }}</div>
                        <svg class="fill-current w-3 h-3 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center text-gray-800 text-sm">
                        <div>{{ getTranslatedContentType(layout.type) }}</div>
                    </li>
                    <li class="flex items-center text-gray-800 mx-1 text-sm">
                        <div>-</div>
                    </li>
                    <li class="flex text-gray-800 italic text-sm font-normal" :class="{'w-full': edit}">
                        <div v-if="edit == false" @click="edit = true; newName = layout.name">{{ layout.name ? layout.name : 'Bez názvu' }}</div>
                        <div v-else class="flex w-full">
                            <div class="w-full max-w-sm">
                                <div class="flex items-center border-b border-b-2 border-gray-500">
                                    <input v-model="newName" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="text" aria-label="height">
                                    <button @click="updateLayoutName()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Save</button>
                                    <button @click="edit = false; newName = null;" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div v-if="page && layout == null && menu == null && menuItem == null">
            <nav class="text-xs text-gray-500 font-bold py-3 px-3 bg-gray-300" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex flex-wrap">
                    <li class="flex">
                        <div class="flex items-center text-gray-800 text-sm" aria-current="page">Stránka</div>
                    </li>
                    <li>
                        <div class="flex items-center text-gray-800 mx-1 text-sm">-</div>
                    </li>
                    <li class="flex text-gray-800 italic text-sm font-normal" :class="{'w-full': edit}">
                        <div v-if="edit == false" @click="edit = true; newName = page.name">{{ page.name ? page.name : 'Bez názvu' }}</div>
                        <div v-else class="flex w-full">
                            <div class="w-full max-w-sm">
                                <div class="flex items-center border-b border-b-2 border-gray-500">
                                    <input v-model="newName" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="text" aria-label="height">
                                    <button @click="updatePageName()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Save</button>
                                    <button @click="edit = false; newName = null;" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div v-if="menu != null">
            <nav class="text-xs text-gray-500 font-bold py-3 px-3 bg-gray-300" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex flex-wrap">
                    <li
                    @click="selectContent({contentId: currentPageId, contentType: 'PAGE'}), highlightSelected(null)"
                    class="flex items-center hover:text-gray-800 cursor-pointer">
                        <div>Stránka</div>
                        <svg class="fill-current w-3 h-3 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center text-gray-800 text-sm">
                        <div>Menu</div>
                    </li>
                    <li class="flex items-center text-gray-800 mx-1 text-sm">
                        <div>-</div>
                    </li>
                    <li class="flex text-gray-800 italic text-sm font-normal" :class="{'w-full': edit}">
                        <div v-if="edit == false" @click="edit = true; newName = menu.name">{{ menu.name ? menu.name : 'Bez názvu' }}</div>
                        <div v-else class="flex w-full">
                            <div class="w-full max-w-sm">
                                <div class="flex items-center border-b border-b-2 border-gray-500">
                                    <input v-model="newName" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="text" aria-label="height">
                                    <button @click="updateMenuName()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Save</button>
                                    <button @click="edit = false; newName = null;" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div v-if="menuItem != null">
            <nav class="text-xs text-gray-500 font-bold py-3 px-3 bg-gray-300" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex flex-wrap">
                    <li
                        @click="selectContent({contentId: currentPageId, contentType: 'PAGE'}), highlightSelected(null)"
                        class="flex items-center hover:text-gray-800 cursor-pointer">
                        <div>Stránka</div>
                        <svg class="fill-current w-3 h-3 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li
                        @click="selectContent({contentId: menuItem.menu_id, contentType: 'MENU'}), highlightSelected('Menu-' + menuItem.menu_id)"
                        class="flex items-center hover:text-gray-800 cursor-pointer">
                        <div>Menu</div>
                        <svg class="fill-current w-3 h-3 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center text-gray-800 text-sm">
                        <div>Položka</div>
                    </li>
                    <li class="flex items-center text-gray-800 mx-1 text-sm">
                        <div>-</div>
                    </li>
                    <li class="flex text-gray-800 italic text-sm font-normal" :class="{'w-full': edit}">
                        <div v-if="edit == false" @click="edit = true; newName = menuItem.name">{{ menuItem.name ? menuItem.name : 'Bez názvu' }}</div>
                        <div v-else class="flex w-full">
                            <div class="w-full max-w-sm">
                                <div class="flex items-center border-b border-b-2 border-gray-500">
                                    <input v-model="newName" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="text" aria-label="height">
                                    <button @click="updateMenuItemName()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Save</button>
                                    <button @click="edit = false; newName = null;" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    data() {
        return {
            edit: false,

            newName: null,
        }
    },

    computed: {
        ...mapGetters(['currentPageId', 'page', 'layout', 'menu', 'menuItem'])
    },

    methods: {
        ...mapActions(['selectContent', 'highlightSelected', 'refetchContent', 'getRenderedHtml']),

        getTranslatedContentType(type) {
            switch (type) {
                case 'COLUMN':
                    return 'Sloupec';
                case 'ROW':
                    return 'Řádek';
                case 'SECTION':
                    return 'Sekce';
                case 'ELEMENT':
                    return 'Element';
                case 'PAGEE':
                    return 'Stránka';
            }
        },

        updateMenuItemName()
        {
            axios.put('/api/menu-items/' + this.menuItem.id, {
                name: this.newName,
            }).then(response => {
                this.edit = false;
                this.refetchContent();
                this.getRenderedHtml(this.currentPageId);
            });
        },

        updateMenuName()
        {
            axios.put('/api/menus/' + this.menu.id, {
                name: this.newName,
            }).then(response => {
                this.edit = false;
                this.refetchContent();
                this.getRenderedHtml(this.currentPageId);
            });
        },

        updatePageName()
        {
            axios.put('/api/pages/' + this.page.id, {
                name: this.newName,
            }).then(response => {
                this.edit = false;
                this.refetchContent();
                this.getRenderedHtml(this.currentPageId);
            });
        },

        updateLayoutName()
        {
            axios.put('/api/layouts/' + this.layout.id, {
                name: this.newName,
            }).then(response => {
                this.edit = false;
                this.refetchContent();
                this.getRenderedHtml(this.currentPageId);
            });
        }
    }
}
</script>

<style>

</style>
