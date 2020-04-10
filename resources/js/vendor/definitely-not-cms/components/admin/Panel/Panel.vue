<template>
<div>
    <!-- Draggable DIV -->
    <div id="panel" class="fixed bg-white shadow-md border border-black bg-gray-300" style="top: 100px; left: 10px; z-index: 9999999; width:350px;">
        <!-- Include a header DIV with the same name as the draggable DIV, followed by "header" -->
        <div id="panel-header" class="cursor-move h-10 flex px-4 py-4 text-gray-800 bg-gray-200 border-b border-black">
            <div class="w-1/3 flex items-center justify-start">
                <div @click="showPages = !showPages; getPages()" class="text-sm font-bold mr-4 flex items-center cursor-pointer">
                    <svg class="fill-current inline-block h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>browser-page-layout</title>
                        <g>
                            <path d="M3,22.5c-1.241,0-2.25-1.009-2.25-2.25V3.75C0.75,2.509,1.759,1.5,3,1.5h18c1.241,0,2.25,1.009,2.25,2.25v16.5
                                c0,1.241-1.009,2.25-2.25,2.25H3z M21,21c0.414,0,0.75-0.336,0.75-0.75V15h-12v6H21z M2.25,20.25C2.25,20.664,2.586,21,3,21h5.25
                                V7.5h-6V20.25z M21.75,13.5v-6h-12v6H21.75z M21.75,6V3.75C21.75,3.336,21.414,3,21,3H3C2.586,3,2.25,3.336,2.25,3.75V6H21.75z"/>
                        </g>
                    </svg>
                    <div class="ml-1">{{ page.name }}</div>
                    <svg v-if="!showPages" class="fill-current inline-block h-3 w-3 ml-1 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>arrow-down-1</title>
                        <g>
                            <path d="M12,18.999c-0.4,0-0.776-0.156-1.059-0.438L0.22,7.841C0.078,7.699,0,7.511,0,7.31c0-0.2,0.078-0.389,0.22-0.53
                                c0.142-0.142,0.33-0.22,0.53-0.22s0.389,0.078,0.53,0.22L12,17.499L22.72,6.78c0.142-0.142,0.33-0.22,0.53-0.22
                                s0.389,0.078,0.53,0.22C23.922,6.922,24,7.11,24,7.31c0,0.2-0.078,0.389-0.22,0.53L13.06,18.56
                                C12.778,18.843,12.401,18.999,12,18.999z"/>
                        </g>
                    </svg>
                    <svg v-if="showPages" class="fill-current inline-block h-3 w-3 ml-1 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>arrow-up-1</title>
                        <g>
                            <path d="M0.75,17.939c-0.2,0-0.389-0.078-0.53-0.22c-0.292-0.292-0.292-0.768,0-1.061L10.94,5.94
                                C11.223,5.656,11.599,5.5,11.999,5.5c0.401,0,0.777,0.156,1.06,0.438l10.721,10.72c0.292,0.292,0.292,0.768,0,1.061
                                c-0.142,0.142-0.33,0.22-0.53,0.22s-0.389-0.078-0.53-0.22L12,7L1.28,17.719C1.139,17.861,0.95,17.939,0.75,17.939z"/>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="w-1/3 flex items-center justify-center">

                <v-popover
                    offset="4"
                    :disabled="false"
                >
                    <svg class="tooltip-target b3 fill-current inline-block h-5 w-5 cursor-pointer hover:text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>responsive-design</title>
                        <g>
                            <path d="M8.25,24c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h1.615l0.5-3H5.25C4.009,19.5,3,18.491,3,17.25v-1.5
                                C3,15.336,3.336,15,3.75,15H22.5V6.75C22.5,6.336,22.164,6,21.75,6h-10.5c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h10.5
                                C22.991,4.5,24,5.509,24,6.75v10.5c0,1.241-1.009,2.25-2.25,2.25h-5.115l0.5,3h1.615c0.414,0,0.75,0.336,0.75,0.75
                                S19.164,24,18.75,24H8.25z M15.615,22.5l-0.5-3h-3.229l-0.5,3H15.615z M4.5,17.25C4.5,17.664,4.836,18,5.25,18h16.5
                                c0.414,0,0.75-0.336,0.75-0.75V16.5h-18V17.25z"/>
                            <path d="M2.25,13.5C1.009,13.5,0,12.491,0,11.25v-9C0,1.009,1.009,0,2.25,0h4.5C7.991,0,9,1.009,9,2.25v9
                                c0,1.241-1.009,2.25-2.25,2.25H2.25z M1.5,11.25C1.5,11.664,1.836,12,2.25,12h4.5c0.414,0,0.75-0.336,0.75-0.75V10.5h-6V11.25z
                                M7.5,9V2.25c0-0.414-0.336-0.75-0.75-0.75h-4.5C1.836,1.5,1.5,1.836,1.5,2.25V9H7.5z"/>
                        </g>
                    </svg>


                    <template slot="popover">
                        <div class="text-xs">
                            <div @click="swapPageScreenStyle('sm')" :class="{'text-gray-800': page.screen_type == 'sm', 'text-gray-500': page.screen_type != 'sm'}" class="w-full py-1 px-2 cursor-pointer hover:text-gray-700 font-bold flex items-center">
                                <svg class="fill-current inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <title>mobile-phone</title>
                                    <g>
                                        <path d="M8.251,24c-2.068,0-3.75-1.682-3.75-3.75V3.75C4.501,1.682,6.183,0,8.251,0h7.5c2.068,0,3.75,1.682,3.75,3.75v16.5
                                            c0,2.068-1.682,3.75-3.75,3.75H8.251z M6.001,20.25c0,1.241,1.009,2.25,2.25,2.25h7.5c1.241,0,2.25-1.009,2.25-2.25V19.5h-12V20.25
                                            z M18.001,18V3.75c0-1.241-1.009-2.25-2.25-2.25h-7.5c-1.241,0-2.25,1.009-2.25,2.25V18H18.001z"/>
                                    </g>
                                </svg>
                                <span class="ml-1">Mobil</span>
                                <span class="pl-2 font-medium">(šířka webu < 640px)</span>
                            </div>
                            <div @click="swapPageScreenStyle('lg')" :class="{'text-gray-800': page.screen_type == 'lg', 'text-gray-500': page.screen_type != 'lg'}" class="w-full py-1 px-2 cursor-pointer hover:text-gray-700 font-bold flex items-center">
                                <svg class="fill-current inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M400 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM224 480c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm176-108c0 6.6-5.4 12-12 12H60c-6.6 0-12-5.4-12-12V60c0-6.6 5.4-12 12-12h328c6.6 0 12 5.4 12 12v312z"/>
                                </svg>
                                <span class="ml-1">Tablet</span>
                                <span class="float-right pl-2 font-medium">(šířka webu < 1920px)</span>
                            </div>
                            <div @click="swapPageScreenStyle('xl')" :class="{'text-gray-800': page.parent_id == null, 'text-gray-500': page.parent_id != null}" class="w-full py-1 px-2 cursor-pointer hover:text-gray-700 font-bold flex items-center">
                                <svg class="fill-current inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                   <title>monitor</title>
                                    <g>
                                        <path d="M6,24c-0.414,0-0.75-0.336-0.75-0.75S5.586,22.5,6,22.5h1.615l0.5-3H3.75C1.682,19.5,0,17.818,0,15.75v-12
                                            C0,1.682,1.682,0,3.75,0h16.5C22.318,0,24,1.682,24,3.75v12c0,2.068-1.682,3.75-3.75,3.75h-4.365l0.5,3H18
                                            c0.414,0,0.75,0.336,0.75,0.75S18.414,24,18,24H6z M14.865,22.5l-0.5-3H9.635l-0.5,3H14.865z M1.632,16.5
                                            C1.945,17.379,2.79,18,3.75,18h16.5c0.96,0,1.805-0.621,2.118-1.5H1.632z M22.5,15V3.75c0-1.241-1.009-2.25-2.25-2.25H3.75
                                            C2.509,1.5,1.5,2.509,1.5,3.75V15H22.5z"/>
                                    </g>
                                </svg>
                                <span class="ml-1">Počítač</span>
                                <span class="float-right pl-2 font-medium">(šířka webu > 1920px)</span>
                            </div>
                        </div>
                        <!-- <a v-close-popover>Close</a> -->
                    </template>
                </v-popover>
            </div>
            <div class="w-1/3 flex items-center justify-end">
                <svg class="fill-current inline-block h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"/>
                </svg>
            </div>
        </div>
        <div v-show="showPages" class="bg-gray-100 border-b border-black w-full mb-3 ">
            <div class="flex items-center justify-around h-20">
                <div @click="swipeLeft" class="left h-full flex items-center justify-center bg-gray-100 hover:text-gray-800 text-gray-700 cursor-pointer">
                    <button id="left-button" style="outline: none;">
                        <svg class="fill-current inline-block h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g>
                                <title>arrow-button-left-1</title>
                                <path d="M23.401,24c-0.134,0-0.259-0.052-0.354-0.146l-10.8-10.793c-0.584-0.585-0.584-1.536,0-2.121l10.8-10.793
                                    C23.142,0.052,23.268,0,23.401,0c0.134,0,0.259,0.052,0.354,0.146c0.195,0.195,0.195,0.512,0,0.707l-10.8,10.793
                                    c-0.195,0.195-0.195,0.512,0,0.707l10.8,10.793c0.094,0.094,0.146,0.219,0.146,0.353c0,0.134-0.052,0.26-0.146,0.354
                                    S23.535,24,23.401,24z"/>
                                <path d="M11.901,24c-0.134,0-0.259-0.052-0.354-0.146l-10.8-10.793c-0.585-0.585-0.585-1.536,0-2.121l10.8-10.793
                                    C11.642,0.052,11.768,0,11.901,0c0.134,0,0.259,0.052,0.354,0.146c0.195,0.195,0.195,0.512,0,0.707l-10.8,10.793
                                    c-0.195,0.195-0.195,0.512,0,0.707l10.8,10.793c0.094,0.094,0.146,0.22,0.146,0.353s-0.052,0.259-0.146,0.354
                                    C12.16,23.948,12.035,24,11.901,24z"/>
                            </g>
                        </svg>
                    </button>
                </div>
                <div class="center py-2" id="content" ref="content">
                    <a :href="page.url" @click="selectPage(page.id);" :class="{'text-gray-800': page.id == currentPageId, 'text-gray-500': page.id != currentPageId}" class="internal p-2 cursor-pointer hover:text-gray-800 text-center" v-for="page in pages">
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
                <div @click="swipeRight" class="right h-full flex items-center justify-center bg-gray-100 hover:text-gray-800 text-gray-700 cursor-pointer">
                    <button id="right-button" style="outline: none;">
                        <svg class="fill-current inline-block h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g>
                                <title>arrow-button-right-1</title>
                                <path d="M0.799,24c-0.134,0-0.259-0.052-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l10.792-10.793
                                    c0.195-0.195,0.195-0.512,0-0.707L0.446,0.854c-0.195-0.195-0.195-0.512,0-0.707C0.54,0.052,0.666,0,0.799,0
                                    s0.259,0.052,0.354,0.146l10.792,10.793c0.585,0.585,0.585,1.536,0,2.121L1.153,23.854C1.058,23.948,0.933,24,0.799,24z"/>
                                <path d="M12.299,24c-0.134,0-0.259-0.052-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l10.792-10.793
                                    c0.195-0.195,0.195-0.512,0-0.707L11.946,0.854c-0.195-0.195-0.195-0.512,0-0.707C12.04,0.052,12.166,0,12.299,0
                                    s0.259,0.052,0.354,0.146l10.792,10.793c0.584,0.585,0.584,1.536,0,2.121L12.653,23.854C12.558,23.948,12.433,24,12.299,24z"/>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="px-4 pb-4 text-xs font-bold text-gray-700 hover:text-gray-900 cursor-pointer" @click="$modal.show('create-page')" >
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
        </div>
        <structure-path></structure-path>

        <layout-panel v-if="layout"></layout-panel>
        <page-panel v-if="page && layout == null && menu == null && menuItem == null"></page-panel>
        <menu-panel v-if="menu"></menu-panel>
        <menu-item-panel v-if="menuItem"></menu-item-panel>

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
                        <label class="block uppercase tracking-wide text-gray-700 text-xs mb-2" for="page-url">
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
</div>

</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    data() {
        return {
            showPages: false,

            newPage: {
                name: null,
                urlPath: null,
            }
        };
    },

    computed: {
        ...mapGetters([ 'currentPageId', 'pages', 'page', 'layout', 'menu', 'menuItem'])
    },

    methods: {
        ...mapActions(['getPages', 'selectPage', 'refetchContent', 'getRenderedHtml']),

        dragElement(elmnt) {
            var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
            if (document.getElementById(elmnt.id + "-header")) {
                // if present, the header is where you move the DIV from:
                document.getElementById(elmnt.id + "-header").onmousedown = dragMouseDown;
            } else {
                // otherwise, move the DIV from anywhere inside the DIV:
                elmnt.onmousedown = dragMouseDown;
            }

            function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
                // get the mouse cursor position at startup:
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                // call a function whenever the cursor moves:
                document.onmousemove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                e.preventDefault();
                // calculate the new cursor position:
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                // set the element's new position:
                elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
            }

            function closeDragElement() {
                // stop moving when mouse button is released:
                document.onmouseup = null;
                document.onmousemove = null;
            }
        },

        /**
         *  scrollTo - Horizontal Scrolling
         *  @param {(HTMLElement ref)} element - Scroll Container
         *  @param {number} scrollPixels - pixel to scroll
         *  @param {number} duration -  Duration of scrolling animation in millisec
         */
        scrollTo(element, scrollPixels, duration) {
            const scrollPos = element.scrollLeft;
            // Condition to check if scrolling is required
            if ( !( (scrollPos === 0 || scrollPixels > 0) && (element.clientWidth + scrollPos === element.scrollWidth || scrollPixels < 0)))
            {
                // Get the start timestamp
                const startTime =
                "now" in window.performance
                    ? performance.now()
                    : new Date().getTime();

                function scroll(timestamp) {
                //Calculate the timeelapsed
                const timeElapsed = timestamp - startTime;
                //Calculate progress
                const progress = Math.min(timeElapsed / duration, 1);
                //Set the scrolleft
                element.scrollLeft = scrollPos + scrollPixels * progress;
                //Check if elapsed time is less then duration then call the requestAnimation, otherwise exit
                if (timeElapsed < duration) {
                    //Request for animation
                    window.requestAnimationFrame(scroll);
                } else {
                    return;
                }
                }
                //Call requestAnimationFrame on scroll function first time
                window.requestAnimationFrame(scroll);
            }
        },

        swipeLeft() {
            const content = this.$refs.content;
            this.scrollTo(content, -300, 800);
        },

        swipeRight() {
            const content = this.$refs.content;
            this.scrollTo(content, 300, 800);
        },

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

        swapPageScreenStyle(screenType) {
            if (!this.hasChildWithScreenType(screenType)) {
                if (window.confirm('Opravdu chcete vytvořit tuto stránku pro ' + screenType)) {
                    axios.post('/api/pages/' + this.page.id + '/screen-type', {
                        screenType: screenType,
                    }).then(response => {
                        this.selectPage(response.data.data.id);
                    });
                }
            } else {
                this.selectPage(this.getChildWithScreenType(screenType).id);
                this.refetchContent();
                this.getRenderedHtml(this.getChildWithScreenType(screenType).id);
            }
        },

        hasChildWithScreenType(screenType) {
            return this.getChildWithScreenType(screenType) != null;
        },

        getChildWithScreenType(screenType) {
            let childPage = null;
            let page = this.page.parent_id != null ? this.page.parent : this.page;

            if (screenType == 'xl') {
                return page;
            }

            if (page.childrens.length == 0) {
                return null;
            }

            page.childrens.forEach(child => {
                if (child.screen_type == screenType) {
                    childPage = child;
                }
            });

            return childPage;
        }
    },

    mounted() {
        this.dragElement(document.getElementById("panel"));
    }
}


</script>

<style>
.left{
    float: left;
    width: 5%;
}

.internal{
    width: 28%;
    height: 100%;
    display: inline-block;
}

.center{
    float: left;
    width: 90%;
    height: 100%;
    overflow: hidden;
    white-space: nowrap;
}

.right{
    float: right;
    width: 5%;
    height: 100%;
}

.tooltip.popover .popover-inner {
    background: #f9f9f9;
    color: black;
    padding: 24px;
    border-radius: 5px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, .1);
    width: auto!important;
}

.tooltip.popover .popover-arrow {
	 border-color: #f9f9f9;
}

</style>
