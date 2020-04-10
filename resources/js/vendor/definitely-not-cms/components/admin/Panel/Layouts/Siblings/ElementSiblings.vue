<template>
    <div class="h-full py-6 mx-3">
        <div v-if="layout.type == 'ELEMENT'">
            <div class="my-3">
                <div class="mt-3 mb-3 text-gray-800 text-center">Elementy</div>
            </div>
            <div class="mb-6">
                <div v-for="element in layout.siblings">
                    <svg @click="selectLayout(element.id); highlightSelected('Layout-' + element.id)" class="fill-current inline-block h-6 w-6 text-gray-500 hover:text-gray-400 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M432 416h-23.41L277.88 53.69A32 32 0 0 0 247.58 32h-47.16a32 32 0 0 0-30.3 21.69L39.41 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16h-19.58l23.3-64h152.56l23.3 64H304a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM176.85 272L224 142.51 271.15 272z"/>
                    </svg>
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
        ...mapActions(['getRenderedHtml', 'refetchContent', 'setLayout', 'deleteLayout', 'highlightSelected']),
    }
}

</script>

<style>
</style>