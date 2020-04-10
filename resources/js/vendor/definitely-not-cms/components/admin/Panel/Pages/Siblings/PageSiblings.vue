<template>
    <div>
        <div class="h-full mx-3 flex flex-wrap py-6">
            <a :href="page.url" @click="selectPage(page.id);" :class="{'text-gray-800': page.id == currentPageId, 'text-gray-500': page.id != currentPageId}" class="w-1/4 py-2 cursor-pointer hover:text-gray-800 text-center" v-for="page in pages">
                <svg class="fill-current inline-block h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g>
                        <path d="M3,22.5c-1.241,0-2.25-1.009-2.25-2.25V3.75C0.75,2.509,1.759,1.5,3,1.5h18c1.241,0,2.25,1.009,2.25,2.25v16.5
                            c0,1.241-1.009,2.25-2.25,2.25H3z M21,21c0.414,0,0.75-0.336,0.75-0.75V7.5h-12V21H21z M2.25,20.25C2.25,20.664,2.586,21,3,21h5.25
                            V7.5h-6V20.25z M21.75,6V3.75C21.75,3.336,21.414,3,21,3H3C2.586,3,2.25,3.336,2.25,3.75V6H21.75z"/>
                        <path d="M4.5,10.5c-0.414,0-0.75-0.336-0.75-0.75S4.086,9,4.5,9H6c0.414,0,0.75,0.336,0.75,0.75S6.414,10.5,6,10.5H4.5z"/>
                        <path d="M4.5,13.5c-0.414,0-0.75-0.336-0.75-0.75S4.086,12,4.5,12H6c0.414,0,0.75,0.336,0.75,0.75S6.414,13.5,6,13.5H4.5z"/>
                        <path d="M4.5,16.5c-0.414,0-0.75-0.336-0.75-0.75S4.086,15,4.5,15H6c0.414,0,0.75,0.336,0.75,0.75S6.414,16.5,6,16.5H4.5z"/>
                        <path d="M4.5,19.5c-0.414,0-0.75-0.336-0.75-0.75S4.086,18,4.5,18H6c0.414,0,0.75,0.336,0.75,0.75S6.414,19.5,6,19.5H4.5z"/>
                        <path d="M12.75,19.5c-0.827,0-1.5-0.673-1.5-1.5v-7.5c0-0.827,0.673-1.5,1.5-1.5h6c0.827,0,1.5,0.673,1.5,1.5V18
                            c0,0.827-0.673,1.5-1.5,1.5H12.75z M18.75,18v-3h-3v3H18.75z M12.75,18h1.5v-3h-1.5V18z M18.75,13.5v-3h-6l0,3H18.75z"/>
                    </g>
                </svg>
                <div class="text-center text-xs italic text-wrap">{{ page.name }}</div>
            </a>
        </div>
        <div class="px-8 pb-4 text-xs font-bold text-gray-700 hover:text-gray-900 cursor-pointer" @click="$modal.show('create-page')" >
            <svg class="fill-current inline-block h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g>
                    <title>app-window-add</title>
                    <path d="M17.518,24.006c-3.584,0-6.5-2.916-6.5-6.5c0-3.584,2.916-6.5,6.5-6.5s6.5,2.916,6.5,6.5
                        C24.018,21.09,21.102,24.006,17.518,24.006z M17.518,12.006c-3.033,0-5.5,2.467-5.5,5.5s2.467,5.5,5.5,5.5s5.5-2.467,5.5-5.5
                        S20.551,12.006,17.518,12.006z"/>
                    <path d="M17.518,21.006c-0.276,0-0.5-0.224-0.5-0.5v-2.5h-2.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h2.5v-2.5
                        c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5v2.5h2.5c0.276,0,0.5,0.224,0.5,0.5s-0.224,0.5-0.5,0.5h-2.5v2.5
                        C18.018,20.781,17.794,21.006,17.518,21.006z"/>
                    <circle cx="3.515" cy="2.504" r="0.75"/>
                    <path d="M5.515,3.254c-0.414,0-0.75-0.336-0.75-0.75c0-0.391,0.307-0.719,0.699-0.746c0.004,0,0.032-0.002,0.033-0.002
                        c0.434,0,0.769,0.336,0.769,0.748C6.265,2.917,5.929,3.254,5.515,3.254z"/>
                    <path d="M7.515,3.254c-0.414,0-0.75-0.336-0.75-0.75c0-0.409,0.333-0.745,0.742-0.749c0.425,0.004,0.758,0.34,0.758,0.749
                        C8.265,2.917,7.929,3.254,7.515,3.254z"/>
                    <path d="M2.515,17c-1.379,0-2.5-1.122-2.5-2.5v-12c0-1.379,1.121-2.5,2.5-2.5h16c1.378,0,2.5,1.121,2.5,2.5v6
                        c0,0.276-0.224,0.5-0.5,0.5s-0.5-0.224-0.5-0.5V5.004h-19V14.5c0,0.827,0.673,1.5,1.5,1.5h6c0.276,0,0.5,0.224,0.5,0.5
                        S8.791,17,8.515,17H2.515z M20.015,4.004V2.5c0-0.827-0.673-1.5-1.5-1.5h-16c-0.827,0-1.5,0.673-1.5,1.5v1.504H20.015z"/>
                </g>
            </svg>
            Vytvořit stránku
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
                <div class="flex -mx-3 mt-4 text-white">
                    <div class="w-1/2 px-1 md:mb-0 text-xs">
                        <button @click="createPage()" class="w-full py-2 bg-teal-600 hover:bg-teal-600 rounded shadow uppercase hover:bg-teal-700" style="outline: none">Vytvořit</button>
                    </div>
                     <div class="w-1/2 px-1 md:mb-0 text-xs">
                        <button @click="$modal.hide('create-page')" class="w-full py-2 bg-teal-600 hover:bg-teal-600 rounded shadow uppercase hover:bg-teal-700" style="outline: none">Zrušit</button>
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
            newPage: {
                name: null,
                urlPath: null,
            }
        };
    },

    computed: {
        ...mapGetters(['page', 'pages', 'currentPageId']),
    },

    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'selectPage', 'getPages']),

        createPage() {
            axios.post('/api/pages', {
                name: this.newPage.name,
                urlPath: this.newPage.urlPath,
            }).then((response) => {
                this.selectPage(response.data.data.id);
                this.refetchContent();
                window.location.href = response.data.data.url;
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
