<template>
    <div class="text-sm bg-gray-300">
        <div class="relative">
            <div class="pl-4">
                <div class="flex">
                    <div class="w-full px-1 flex items-center hidden">
                        <div class="w-1/4 text-gray-800 mr-2">Název</div>
                        <div v-if="!edit" @click="startEditing()">
                            <span class="italic text-gray-800" v-if="page.name">{{ page.name }}</span>
                            <span v-else class="italic text-gray-600">Bez názvu</span>
                        </div>
                        <div v-else class="flex">
                            <div class="w-full max-w-sm">
                                <div class="flex items-center border-b border-b-2 border-gray-800">
                                    <input v-model="newName" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 px-2 leading-tight focus:outline-none" type="numeric" aria-label="height">
                                    <button @click="save()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Save</button>
                                    <button @click="stopEditing()" class="flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-600 text-sm rounded" type="button" style="outline: none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border-t border-black relative mt-6">
            <div class="absolute top-0 -mt-4 px-4 flex justify-between w-full" style="z-index: 998;">
                <div @click="activeTab = 'SIBLINGS';getPages();"
                    :class="{
                        'circleThing flex justify-center items-center text-gray-800 cursor-pointer bg-white hover:text-gray-600': activeTab == 'SIBLINGS',
                        'h-8 w-8 rounded-full border border-black shadow flex justify-center items-center bg-gray-300 hover:bg-gray-300 cursor-pointer hover:text-gray-600 text-gray-800': activeTab != 'SIBLINGS'
                    }">
                    <svg :class="{'rotate-back': activeTab == 'SIBLINGS'}" class="tooltip-target b3 fill-current inline-block" style="width: 1.1rem; height: 1.4rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>ui-webpage-slider</title>
                        <g>
                            <path d="M3.75,24c-1.241,0-2.25-1.009-2.25-2.25v-1.5C1.5,19.009,2.509,18,3.75,18h10.5c1.241,0,2.25,1.009,2.25,2.25V21h3.75
                                c0.414,0,0.75-0.336,0.75-0.75V15h-4.629c-0.314,0.885-1.162,1.5-2.121,1.5H3.75c-1.241,0-2.25-1.009-2.25-2.25v-1.5
                                c0-1.241,1.009-2.25,2.25-2.25h10.5c1.241,0,2.25,1.009,2.25,2.25v0.75H21v-6h-4.629C16.058,8.385,15.21,9,14.25,9H3.75
                                C2.509,9,1.5,7.991,1.5,6.75v-1.5C1.5,4.009,2.509,3,3.75,3h10.5c1.241,0,2.25,1.009,2.25,2.25V6H21V0.75
                                C21,0.336,21.336,0,21.75,0s0.75,0.336,0.75,0.75v19.5c0,1.241-1.009,2.25-2.25,2.25h-3.879C16.058,23.385,15.21,24,14.25,24H3.75z
                                M3.75,19.5C3.336,19.5,3,19.836,3,20.25v1.5c0,0.414,0.336,0.75,0.75,0.75h10.5c0.414,0,0.75-0.336,0.75-0.75v-1.5
                                c0-0.414-0.336-0.75-0.75-0.75H3.75z M3.75,12C3.336,12,3,12.336,3,12.75v1.5C3,14.664,3.336,15,3.75,15h10.5
                                c0.414,0,0.75-0.336,0.75-0.75v-1.5c0-0.414-0.336-0.75-0.75-0.75H3.75z M3.75,4.5C3.336,4.5,3,4.836,3,5.25v1.5
                                C3,7.164,3.336,7.5,3.75,7.5h10.5C14.664,7.5,15,7.164,15,6.75v-1.5c0-0.414-0.336-0.75-0.75-0.75H3.75z"/>
                        </g>
                    </svg>
                </div>
                <div @click="activeTab = 'MAIN'"
                    :class="{
                        'circleThing flex justify-center items-center text-gray-800 cursor-pointer bg-white hover:text-gray-600': activeTab == 'MAIN',
                        'h-8 w-8 rounded-full border border-black shadow flex justify-center items-center bg-gray-300 hover:bg-gray-300 cursor-pointer hover:text-gray-600 text-gray-800': activeTab != 'MAIN'
                        }">
                    <svg :class="{'rotate-back': activeTab == 'MAIN'}" class="fill-current inline-block h-4 w-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"/>
                    </svg>
                </div>
                <div @click="activeTab = 'CHILDRENS'"
                    :class="{
                        'circleThing flex justify-center items-center text-gray-800 cursor-pointer bg-white hover:text-gray-600': activeTab == 'CHILDRENS',
                        'h-8 w-8 rounded-full border border-black shadow flex justify-center items-center bg-gray-300 hover:bg-gray-300 cursor-pointer hover:text-gray-600 text-gray-800': activeTab != 'CHILDRENS'
                    }">
                    <svg :class="{'rotate-back': activeTab == 'CHILDRENS'}" class="fill-current inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M12.41 148.02l232.94 105.67c6.8 3.09 14.49 3.09 21.29 0l232.94-105.67c16.55-7.51 16.55-32.52 0-40.03L266.65 2.31a25.607 25.607 0 0 0-21.29 0L12.41 107.98c-16.55 7.51-16.55 32.53 0 40.04zm487.18 88.28l-58.09-26.33-161.64 73.27c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.51 209.97l-58.1 26.33c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 276.3c16.55-7.5 16.55-32.5 0-40zm0 127.8l-57.87-26.23-161.86 73.37c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.29 337.87 12.41 364.1c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 404.1c16.55-7.5 16.55-32.5 0-40z"/>
                    </svg>
                </div>
                <div @click=""
                    :class="{
                        'circleThing flex justify-center items-center text-gray-800 cursor-pointer bg-white hover:text-gray-600': activeTab == '',
                        'h-8 w-8 rounded-full border border-black shadow flex justify-center items-center bg-gray-300 hover:bg-gray-300 cursor-pointer hover:text-gray-600 text-gray-800': activeTab != ''
                    }">
                    <svg :class="{'rotate-back': activeTab == ''}" class="fill-current inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M464 0H144c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h320c26.51 0 48-21.49 48-48v-48h48c26.51 0 48-21.49 48-48V48c0-26.51-21.49-48-48-48zM362 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h42v224c0 26.51 21.49 48 48 48h224v42a6 6 0 0 1-6 6zm96-96H150a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h308a6 6 0 0 1 6 6v308a6 6 0 0 1-6 6z"/>
                    </svg>
                </div>
                <div @click=""
                    :class="{
                        'circleThing flex justify-center items-center text-gray-800 cursor-pointer bg-white hover:text-gray-600': activeTab == '',
                        'h-8 w-8 rounded-full border border-black shadow flex justify-center items-center bg-gray-300 hover:bg-gray-300 cursor-pointer hover:text-gray-600 text-gray-800': activeTab != ''
                    }">
                    <svg :class="{'rotate-back': activeTab == ''}" class="fill-current inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"/>
                    </svg>
                </div>

                <div @click=""
                    class="h-8 w-8 rounded-full border border-black shadow flex justify-center items-center bg-red-700 hover:bg-red-600 hover:text-gray-100 cursor-pointer text-gray-100">
                    <svg :class="{'rotate-back': activeTab == ''}" class="fill-current inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/>
                    </svg>
                </div>
            </div>

            <page-childrens class="mt-4" v-if="activeTab === 'CHILDRENS'"></page-childrens>
            <page-siblings class="mt-4" v-if="activeTab === 'SIBLINGS'"></page-siblings>

            <div class="mt-6" v-if="activeTab == 'MAIN'">
                <div class="pt-3 px-6 flex">
                    <svg class="h-5 w-5 tooltip-target b3 fill-current inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>navigation-menu-4</title>
                        <g>
                            <path d="M2.25,24.003c-1.241,0-2.25-1.009-2.25-2.25v-19.5c0-1.241,1.009-2.25,2.25-2.25h19.5c1.241,0,2.25,1.009,2.25,2.25v19.5 c0,1.241-1.009,2.25-2.25,2.25H2.25z M2.25,1.503c-0.414,0-0.75,0.336-0.75,0.75v19.5c0,0.414,0.336,0.75,0.75,0.75h19.5 c0.414,0,0.75-0.336,0.75-0.75v-19.5c0-0.414-0.336-0.75-0.75-0.75H2.25z"/>
                            <path d="M6.75,8.253C6.336,8.253,6,7.917,6,7.503s0.336-0.75,0.75-0.75h10.5c0.414,0,0.75,0.336,0.75,0.75s-0.336,0.75-0.75,0.75 H6.75z"/>
                            <path d="M6.75,12.753c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h10.5c0.414,0,0.75,0.336,0.75,0.75 s-0.336,0.75-0.75,0.75H6.75z"/>
                            <path d="M6.75,17.253c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h10.5c0.414,0,0.75,0.336,0.75,0.75 s-0.336,0.75-0.75,0.75H6.75z"/>
                        </g>
                    </svg>
                    <div class="ml-2 italic opacity-75">
                        <v-popover offset="16" :placement="'right-end'" :disabled="false">
                            <div v-if="page.menu != null" @click="getMenus()" class="tooltip-target b3 cursor-pointer">{{ page.menu.id }}</div>
                            <div v-else class="tooltip-target b3 cursor-pointer" @click="getMenus()">Přidat Menu</div>
                            <template slot="popover">
                                <div class="w-64 flex flex-col">
                                    <div v-if="menus.length != 0">
                                        <div class="font-bold text-center hover:bg-gray-200 py-2 cursor-pointer" v-for="menu in menus" @click="assignMenu(menu)" v-close-popover>{{ menu.name == null ? menu.id : menu.name }}</div>
                                        <div class="w-full text-center text-sm text-gray-700 border-t cursor-pointer hover:text-gray-900 py-2 hover:bg-gray-200" v-close-popover @click="createMenu()">+ Vytvořit Menu</div>
                                    </div>
                                    <div v-else>
                                        <div class="w-full text-center text-sm text-gray-600 py-2">Neexsitují zatím žádná menu</div>
                                        <div class="w-full text-center text-sm text-gray-700 cursor-pointer hover:text-gray-900 py-2 hover:bg-gray-200" v-close-popover @click="createMenu()">+ Vytvořit Menu</div>
                                    </div>
                                </div>
                            </template>
                        </v-popover>
                    </div>
                </div>
                <page-styles></page-styles>
            </div>
        </div>

        <modal name="create-page" height="auto" :scrollable="true" :width="300">
            <div class="px-6 py-3">
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full px-2 mt-2 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs mb-2" for="page-name">
                            Jméno <span class="italic text-gray-500 lowercase font-medium">(dobrovolné)</span>
                        </label>
                        <input v-model="newPage.name" class="appearance-none block w-full bg-white text-gray-700 border rounded py-2 px-2 mb-1 leading-tight focus:outline-none focus:bg-white" type="text">
                    </div>
                    <div class="w-full px-2 md:mb-0 mt-2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs mb-2" for="page-name">
                            URL
                        </label>
                        <input v-model="newPage.urlPath" class="appearance-none block w-full bg-white text-gray-700 border rounded py-2 px-2 mb-1 leading-tight focus:outline-none focus:bg-white" type="text">
                    </div>
                </div>
                <div class="flex -mx-3 mt-4">
                    <div class="w-1/2 px-1 md:mb-0 text-xs">
                        <button @click="createPage()" class="w-full py-2 bg-teal-600 hover:bg-teal-600 rounded shadow uppercase text-white hover:bg-teal-700" style="outline: none">Vytvořit</button>
                    </div>
                     <div class="w-1/2 px-1 md:mb-0 text-xs">
                        <button @click="$modal.hide('create-page')" class="w-full py-2 bg-teal-600 hover:bg-teal-600 rounded shadow uppercase text-white hover:bg-teal-700" style="outline: none">Zrušit</button>
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
            newName: null,

            edit: false,

            activeTab: 'MAIN', // CHILDRENS
            createButtonsEnabled: true,

            newPage: {
                name: null,
                urlPath: null,
            },

            menus: [],
        };
    },

    computed: {
        ...mapGetters(['page', 'pages', 'currentPageId'])
    },

    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'unsetAll', 'getPages', 'selectPage']),

        startEditing() {
            this.edit = true;
            this.newName = this.page.name;
        },

        stopEditing() {
            this.edit = false;
            this.newName = null;
        },

        save() {
            axios.put('/api/pages/' + this.page.id, {
                name: this.newName
            }).then(response => {
                this.getRenderedHtml(this.currentPageId);
                this.refetchContent();
                this.stopEditing();
            });
        },

        createPage() {
            axios.post('/api/pages', {
                name: this.newPage.name,
                urlPath: this.newPage.urlPath,
            }).then((response) => {
                this.selectPage(response.data.data.id);
            });
        },

        getMenus() {
            axios.get('/api/menus')
                .then(response => {
                    this.menus = response.data.data;
                });
        },

        createMenu() {
            axios.post('/api/menus', {
                'page_id': this.page.id,
            }).then(response => {
                this.getMenus();
                this.getRenderedHtml(this.currentPageId);
                this.refetchContent();
            });
        },

        assignMenu(menu) {
            axios.post('/api/pages/' + this.page.id + '/menu', {
                menu_id: menu.id
            }).then(response => {
                this.getMenus();
                this.getRenderedHtml(this.currentPageId);
                this.refetchContent();
            });
        }
    }
}
</script>

<style>
    .tooltip.popover .popover-inner {
        padding: 0px!important;
    }
</style>
