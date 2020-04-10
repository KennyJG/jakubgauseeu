<template>
    <div class="text-sm bg-gray-300">
        <div class="relative">
            <div class="pl-4">
                <div class="flex">
                    <div class="w-full px-1 flex items-center hidden">
                        <div class="w-1/4 text-gray-800 mr-2">Název</div>
                        <div v-if="!edit" @click="startEditing()">
                            <span class="italic text-gray-800" v-if="menuItem.name">{{ menuItem.name }}</span>
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
                <div disabled class="h-8 w-8 rounded-full border border-black shadow flex justify-center items-center bg-gray-200 cursor-pointer text-gray-500 cursor-not-allowed">
                    <svg class="fill-current inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
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

<!--            <menu-item-childrens class="mt-4" v-if="activeTab === 'CHILDRENS'"></menu-item-childrens>-->

            <div class="mt-6" v-if="activeTab == 'MAIN'">
                <div class="pt-3 px-6 flex">
                    <svg class="h-5 w-5 tooltip-target b3 fill-current inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>hyperlink-2</title>
                        <g>
                            <path d="M6.754,17.999c-0.2,0-0.389-0.078-0.53-0.22c-0.292-0.292-0.292-0.768,0-1.061l10.5-10.5c0.142-0.142,0.33-0.22,0.53-0.22s0.389,0.078,0.53,0.22c0.142,0.141,0.22,0.33,0.22,0.53s-0.078,0.389-0.22,0.53l-10.5,10.5C7.142,17.921,6.954,17.999,6.754,17.999z"/>
                            <path d="M5.254,24.003c-1.402,0-2.721-0.546-3.712-1.538c-2.047-2.047-2.047-5.377,0-7.425l2.25-2.25c0.972-0.971,2.317-1.527,3.691-1.527c0.1,0,0.2,0.003,0.3,0.009c0.413,0.024,0.729,0.379,0.706,0.792c-0.023,0.396-0.351,0.707-0.747,0.707c-0.007,0-0.038-0.001-0.045-0.001c-0.073-0.004-0.146-0.006-0.218-0.006c-0.975,0-1.932,0.397-2.625,1.088l-2.25,2.25c-1.462,1.462-1.462,3.841,0,5.303c0.708,0.708,1.65,1.098,2.652,1.098s1.943-0.39,2.652-1.098l2.25-2.25c0.748-0.749,1.142-1.786,1.082-2.844c-0.011-0.2,0.056-0.393,0.189-0.542c0.133-0.15,0.317-0.238,0.517-0.25c0.013-0.001,0.03-0.001,0.047-0.001c0.395,0,0.722,0.311,0.745,0.707c0.086,1.484-0.468,2.938-1.518,3.99l-2.25,2.25C7.975,23.457,6.656,24.003,5.254,24.003z"/>
                            <path d="M16.525,12.734c-0.1,0-0.199-0.003-0.299-0.009c-0.413-0.024-0.729-0.379-0.705-0.792c0.022-0.396,0.352-0.707,0.751-0.707c0.006,0,0.031,0.001,0.038,0.001c0.074,0.004,0.145,0.006,0.216,0.006c0.98,0,1.939-0.397,2.632-1.088l2.25-2.25c0.708-0.708,1.098-1.65,1.098-2.652s-0.39-1.943-1.098-2.652c-0.707-0.707-1.649-1.096-2.652-1.096s-1.945,0.389-2.652,1.096l-2.25,2.25c-0.746,0.75-1.138,1.786-1.077,2.843c0.012,0.2-0.055,0.392-0.188,0.542c-0.133,0.15-0.317,0.239-0.517,0.25c-0.007,0-0.037,0.001-0.044,0.001c-0.396,0-0.725-0.31-0.748-0.706c-0.087-1.483,0.465-2.937,1.512-3.99l2.251-2.251c0.991-0.992,2.31-1.538,3.712-1.538s2.721,0.546,3.712,1.538c0.992,0.991,1.538,2.31,1.538,3.712s-0.546,2.721-1.538,3.712l-2.25,2.25C19.244,12.177,17.899,12.734,16.525,12.734z"/>
                        </g>
                    </svg>
                    <v-popover offset="16" :placement="'right-start'" :disabled="false">
                        <div v-if="menuItem.link_id != null" class="tooltip-target b3 cursor-pointer ml-3" @click="newLink.type = null; newLink.value = null">{{ menuItem.link_id }}</div>
                        <div v-else class="tooltip-target b3 cursor-pointer ml-3 italic text-gray-700" @click="newLink.type = null; newLink.value = null">Přidat Odkaz</div>
                        <template slot="popover" style="outliine:none!important;">
                            <div class="w-64 flex flex-col px-3 py-1 text-sm">
                                <div v-if="newLink.type == null">
                                    <div @click="newLink.type = null; newLink.value = null;" v-close-popover class="absolute top-0 right-0 mr-1 mt-1">
                                        <svg class="mr-2 mt-2 fill-current inline-block h-3 w-3 hover:text-gray-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <title>close</title>
                                            <g>
                                                <path d="M23.25,23.999c-0.2,0-0.389-0.078-0.53-0.22L12,13.06L1.28,23.779c-0.142,0.142-0.33,0.22-0.53,0.22
                                                    s-0.389-0.078-0.53-0.22c-0.292-0.292-0.292-0.768,0-1.061l10.72-10.72L0.22,1.279C0.078,1.138,0,0.949,0,0.749
                                                    s0.078-0.389,0.22-0.53c0.141-0.142,0.33-0.22,0.53-0.22s0.389,0.078,0.53,0.22L12,10.938l10.72-10.72
                                                    c0.142-0.142,0.33-0.22,0.53-0.22s0.389,0.078,0.53,0.22C23.922,0.36,24,0.549,24,0.749s-0.078,0.389-0.22,0.53l-10.72,10.72
                                                    l10.72,10.72c0.292,0.292,0.292,0.768,0,1.061C23.639,23.921,23.45,23.999,23.25,23.999z"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div @click="newLink.type = 'INTERNAL'; getPages()" class="w-full text-center py-2 border-b border-gray-400 cursor-pointer hover:text-gray-600 mt-4">Odkaz na stránku</div>
                                    <div @click="newLink.type = 'EXTERNAL'" class="w-full text-center py-2 cursor-pointer hover:text-gray-600">Externí odkaz</div>
                                </div>
                                <div v-if="newLink.type != null">
                                    <div @click="newLink.type = null; newLink.value = null;">
                                        <svg class="ml-2 mt-2 fill-current inline-block h-4 w-4 hover:text-gray-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <title>move-back</title>
                                            <g>
                                                <path d="M23.25,20.998c-0.414,0-0.75-0.336-0.75-0.75v-9c0-0.414-0.336-0.75-0.75-0.75H2.561l3.97,3.97
                                                    c0.142,0.142,0.22,0.33,0.22,0.53s-0.078,0.389-0.22,0.53C6.389,15.67,6.2,15.748,6,15.748s-0.389-0.078-0.53-0.22l-5.25-5.25
                                                    c-0.07-0.07-0.125-0.152-0.163-0.245c-0.003-0.008-0.007-0.017-0.01-0.026C0.016,9.922,0,9.836,0,9.748
                                                    C0,9.66,0.016,9.572,0.048,9.487C0.05,9.48,0.053,9.473,0.055,9.466C0.095,9.37,0.15,9.287,0.221,9.217L5.47,3.968
                                                    C5.611,3.826,5.8,3.748,6,3.748s0.389,0.078,0.53,0.22c0.142,0.141,0.22,0.33,0.22,0.53s-0.078,0.389-0.22,0.53l-3.97,3.97H21.75
                                                    c1.241,0,2.25,1.009,2.25,2.25v9C24,20.662,23.664,20.998,23.25,20.998z"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div v-if="newLink.type == 'INTERNAL'">
                                        <div class="flex flex-wrap p-2">
                                            <div @click="newLink.value = singlePage.id" :class="{'text-gray-800': newLink.value == singlePage.id}" class="w-1/3 cursor-pointer text-gray-500 hover:text-gray-800 text-center p-2" v-for="singlePage in pages">
                                                <svg class="fill-current inline-block h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <g>
                                                        <path d="M3,22.5c-1.241,0-2.25-1.009-2.25-2.25V3.75C0.75,2.509,1.759,1.5,3,1.5h18c1.241,0,2.25,1.009,2.25,2.25v16.5c0,1.241-1.009,2.25-2.25,2.25H3z M21,21c0.414,0,0.75-0.336,0.75-0.75V7.5h-12V21H21z M2.25,20.25C2.25,20.664,2.586,21,3,21h5.25V7.5h-6V20.25z M21.75,6V3.75C21.75,3.336,21.414,3,21,3H3C2.586,3,2.25,3.336,2.25,3.75V6H21.75z"/>
                                                        <path d="M4.5,10.5c-0.414,0-0.75-0.336-0.75-0.75S4.086,9,4.5,9H6c0.414,0,0.75,0.336,0.75,0.75S6.414,10.5,6,10.5H4.5z"/>
                                                        <path d="M4.5,13.5c-0.414,0-0.75-0.336-0.75-0.75S4.086,12,4.5,12H6c0.414,0,0.75,0.336,0.75,0.75S6.414,13.5,6,13.5H4.5z"/>
                                                        <path d="M4.5,16.5c-0.414,0-0.75-0.336-0.75-0.75S4.086,15,4.5,15H6c0.414,0,0.75,0.336,0.75,0.75S6.414,16.5,6,16.5H4.5z"/>
                                                        <path d="M4.5,19.5c-0.414,0-0.75-0.336-0.75-0.75S4.086,18,4.5,18H6c0.414,0,0.75,0.336,0.75,0.75S6.414,19.5,6,19.5H4.5z"/>
                                                        <path d="M12.75,19.5c-0.827,0-1.5-0.673-1.5-1.5v-7.5c0-0.827,0.673-1.5,1.5-1.5h6c0.827,0,1.5,0.673,1.5,1.5V18c0,0.827-0.673,1.5-1.5,1.5H12.75z M18.75,18v-3h-3v3H18.75z M12.75,18h1.5v-3h-1.5V18z M18.75,13.5v-3h-6l0,3H18.75z"/>
                                                    </g>
                                                </svg>
                                                <div class="text-center text-xs italic text-wrap">{{ singlePage.name }}</div>
                                            </div>
                                            <div class="w-full flex mt-2">
                                                <button @click="createPageLink(newLink.value)" v-close-popover class="w-1/2 flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-500 text-sm py-1 px-2 rounded" type="button">
                                                    Create
                                                </button>
                                                <button @click="newLink.type = null; newLink.value = null;" class="w-1/2 flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-500 text-sm py-1 px-2 rounded" type="button">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="newLink.type == 'EXTERNAL'">
                                        <div class="p-2">
                                            <form class="w-full max-w-sm">
                                                <div class="flex items-center border-b border-b-2 border-gray-500 py-2">
                                                    <input v-model="newLink.value" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="https://www.seznam.cz/" aria-label="External page url">
                                                </div>
                                            </form>
                                            <div class="w-full flex mt-2">
                                                <button @click="createLink()" v-close-popover class="w-1/2 flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-500 text-sm py-1 px-2 rounded" type="button">
                                                    Create
                                                </button>
                                                <button @click="newLink.type = null; newLink.value = null;" class="w-1/2 flex-shrink-0 border-transparent border-4 text-gray-800 hover:text-gray-500 text-sm py-1 px-2 rounded" type="button">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </v-popover>
                </div>

                <menu-item-styles></menu-item-styles>
            </div>

            <div class="mt-6" v-if="activeTab == 'SIBLINGS'">
                <menu-item-siblings></menu-item-siblings>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters, mapMutations } from 'vuex';

    export default {
        data() {
            return {
                newName: null,

                newLink: {
                    type: null,
                    value: null
                },

                edit: false,

                activeTab: 'MAIN', // CHILDRENS
                createButtonsEnabled: true,
            };
        },

        computed: {
            ...mapGetters([ 'currentPageId', 'pages', 'page', 'menuItem'])
        },

        methods: {
            ...mapActions(['getPages', 'refetchContent', 'getRenderedHtml']),

            startEditing() {
                this.edit = true;
                this.newName = this.layout.name;
            },

            stopEditing() {
                this.edit = false;
                this.newName = null;
            },

            save() {
                axios.put('/api/layouts/' + this.layout.id, {
                    name: this.newName
                }).then(response => {
                    this.getRenderedHtml(this.currentPageId);
                    this.refetchContent();
                    this.stopEditing();
                });
            },

            createLink() {
                axios.post('/api/links', {
                    type: this.newLink.type,
                    value: this.newLink.value,
                    menu_item_id: this.menuItem.id,
                }).then(response => {
                    this.getRenderedHtml(this.currentPageId);
                    this.refetchContent();
                });
            },

            createPageLink(id) {
                axios.post('/api/links', {
                    type: this.newLink.type,
                    value: id,
                    menu_item_id: this.menuItem.id,
                }).then(response => {
                    this.getRenderedHtml(this.currentPageId);
                    this.refetchContent();
                });
            },
        }
    }
</script>

<style>
    div.tooltip {
        outline: none!important;;
    }

    button {
        outline: none!important;
    }
</style>
