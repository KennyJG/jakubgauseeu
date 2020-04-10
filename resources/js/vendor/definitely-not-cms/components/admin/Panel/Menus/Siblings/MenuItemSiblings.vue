<template>
    <div class="h-full py-6 mx-3">
        <div>
            <div v-if="menuItem.siblings.length == 0" class="mt-3 mb-3 text-gray-800 text-center">
                <div @click="createMenuItem()" class="cursor-pointer">
                    <svg class="fill-current inline-block h-10 w-10 mt-6 mb-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>list-add</title>
                        <g>
                            <path d="M17.25,23.873c-3.722,0-6.75-3.028-6.75-6.75s3.028-6.75,6.75-6.75S24,13.401,24,17.123S20.972,23.873,17.25,23.873zM17.25,11.873c-2.895,0-5.25,2.355-5.25,5.25s2.355,5.25,5.25,5.25s5.25-2.355,5.25-5.25S20.145,11.873,17.25,11.873z"/>
                            <path d="M17.25,20.873c-0.414,0-0.75-0.336-0.75-0.75v-2.25h-2.25c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h2.25v-2.25c0-0.414,0.336-0.75,0.75-0.75S18,13.709,18,14.123v2.25h2.25c0.414,0,0.75,0.336,0.75,0.75s-0.336,0.75-0.75,0.75H18v2.25C18,20.537,17.664,20.873,17.25,20.873z"/>
                            <path d="M5.25,2.873c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h15c0.414,0,0.75,0.336,0.75,0.75s-0.336,0.75-0.75,0.75H5.25z"/>
                            <path d="M5.25,8.873c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h15c0.414,0,0.75,0.336,0.75,0.75s-0.336,0.75-0.75,0.75H5.25z"/>
                            <path d="M5.25,14.873c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h3c0.414,0,0.75,0.336,0.75,0.75s-0.336,0.75-0.75,0.75H5.25z"/>
                            <circle cx="1.125" cy="2.123" r="1.125"/>
                            <circle cx="1.125" cy="8.123" r="1.125"/>
                            <circle cx="1.125" cy="14.123" r="1.125"/>
                        </g>
                    </svg>
                    <div class="mb-6 text-gray-500">+ Přidat položku</div>
                </div>
            </div>
            <div v-else>
                <div class="mt-3 mb-3 text-gray-800 text-center">Položky</div>
                <div class="mb-6">
                    <div class="flex flex-col w-full relative">
                        <div class="w-3/4 mx-auto border-gray-800 ">
                            <div>
                                <div @click="selectMenuItem(item.id); highlightSelected('MenuItem-' + item.id)" v-for="(item, key) in menuItem.siblings" :class="{'mt-3': key !== 0, 'bg-gray-300': menuItem.id == item.id}" class="px-3 py-2 border border-gray-400 flex justify-center items-center cursor-pointer hover:bg-gray-200 relative">
                                    <div v-if="item.name">{{ item.name }}</div>
                                    <div v-else class="italic opacity-75 text-gray-800">Bez názvu</div>
                                    <div class="absolute top-0 right-0 -mr-2 -mt-2 h-6 w-6 rounded-full hover:bg-gray-100 shadow-md flex justify-center items-center hover:text-red-500 text-gray-100 bg-red-500 cursor-pointer">
                                        <svg @click.stop="deleteMenuItem(item.id)" class="fill-current inline-block h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center text-gray-300">
                        |
                    </div>

                    <div class="flex justify-center">
                        <div @click="createMenuItem()" class="h-6 w-6 rounded-full hover:bg-gray-100 shadow-sm flex justify-center items-center hover:text-gray-500 text-gray-100 bg-gray-300 cursor-pointer">
                            <svg class="fill-current inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/>
                            </svg>
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

            }
        },

        computed: {
            ...mapGetters(['currentPageId', 'menuItem']),
        },

        methods: {
            ...mapActions(['getRenderedHtml', 'refetchContent', 'selectPage', 'getPages', 'selectMenuItem', 'highlightSelected']),
        },

        createMenuItem() {
            axios.post('/api/menu-items', {
                menu_id: this.menuItem.menu_id,
            }).then((response) => {
                this.getRenderedHtml(this.currentPageId);
                this.refetchContent();
            });
        },

        deleteMenuItem(id) {
            if (window.confirm('Opravdu chcete odstranit tuto položku?')) {
                axios.delete('/api/menu-items/' + id)
                    .then(response => {
                        this.getRenderedHtml(this.page.id);
                        this.refetchContent();
                    });
            }
        }
    }
</script>

<style scoped>

</style>
