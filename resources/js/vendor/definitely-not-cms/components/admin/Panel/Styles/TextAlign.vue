<template> 
    <div class="flex items-center justify-between px-6 pb-2">
        <div @click="newTextAlign = 'left'; save()" :class="{'bg-gray-300': value == 'left' || value == null}" class="rounded shadow-sm border py-2 px-2 flex hover:bg-gray-300 cursor-pointer">
            <svg class="fill-current text-gray-800 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M12.83 352h262.34A12.82 12.82 0 0 0 288 339.17v-38.34A12.82 12.82 0 0 0 275.17 288H12.83A12.82 12.82 0 0 0 0 300.83v38.34A12.82 12.82 0 0 0 12.83 352zm0-256h262.34A12.82 12.82 0 0 0 288 83.17V44.83A12.82 12.82 0 0 0 275.17 32H12.83A12.82 12.82 0 0 0 0 44.83v38.34A12.82 12.82 0 0 0 12.83 96zM432 160H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0 256H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"/>
            </svg>
        </div>
        <div @click="newTextAlign = 'justify'; save()" :class="{'bg-gray-300': value == 'justify'}" class="rounded shadow-sm border py-2 px-2 flex hover:bg-gray-300 cursor-pointer">
            <svg class="fill-current text-gray-800 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M432 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-128H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-128H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-128H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"/>
            </svg>
        </div>
        <div @click="newTextAlign = 'center'; save()" :class="{'bg-gray-300': value == 'center'}" class="rounded shadow-sm border py-2 px-2 flex hover:bg-gray-300 cursor-pointer">
            <svg class="fill-current text-gray-800 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M432 160H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0 256H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM108.1 96h231.81A12.09 12.09 0 0 0 352 83.9V44.09A12.09 12.09 0 0 0 339.91 32H108.1A12.09 12.09 0 0 0 96 44.09V83.9A12.1 12.1 0 0 0 108.1 96zm231.81 256A12.09 12.09 0 0 0 352 339.9v-39.81A12.09 12.09 0 0 0 339.91 288H108.1A12.09 12.09 0 0 0 96 300.09v39.81a12.1 12.1 0 0 0 12.1 12.1z"/>
            </svg>
        </div>
        <div @click="newTextAlign = 'right'; save()" :class="{'bg-gray-300': value == 'right'}" class="rounded shadow-sm border py-2 px-2 flex hover:bg-gray-300 cursor-pointer">
            <svg class="fill-current text-gray-800 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M16 224h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16zm416 192H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm3.17-384H172.83A12.82 12.82 0 0 0 160 44.83v38.34A12.82 12.82 0 0 0 172.83 96h262.34A12.82 12.82 0 0 0 448 83.17V44.83A12.82 12.82 0 0 0 435.17 32zm0 256H172.83A12.82 12.82 0 0 0 160 300.83v38.34A12.82 12.82 0 0 0 172.83 352h262.34A12.82 12.82 0 0 0 448 339.17v-38.34A12.82 12.82 0 0 0 435.17 288z"/>
            </svg>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    props: ['value', 'unit'],

    data() {
        return {
            newTextAlign: null,
        }
    },

    computed: {
        ...mapGetters(['currentPageId', 'getContent', 'getContentType'])
    },
    
    methods: {
        ...mapActions(['getRenderedHtml', 'refetchContent', 'reselect']),

        save() {
            let content = this.getContent;
            let contentType = this.getContentType;
            if (content !== null) {
                axios.post('/api/styles/text-align', {
                    value: this.newTextAlign,
                    model_id: content.id,
                    model_type: contentType,
                }).then(response => {
                    this.getRenderedHtml(this.currentPageId);
                    this.refetchContent();
                });
            }
        }
    },
}
</script>

<style>
.tooltip {
    z-index: 9999999999;
}
.tooltip.popover .popover-inner {
	 background: #f9f9f9;
	 color: black;
	 border-radius: 5px;
	 box-shadow: 0 5px 30px rgba(0, 0, 0, .1);
}
 .tooltip.popover .popover-arrow {
	 border-color: #f9f9f9;
}
 
</style>