<template>
     <div class="h-full" v-html="getHtml" />
</template>

<script>
import {mapGetters, mapActions, mapMutations} from 'vuex';

export default {
    props: ['pageId'],

    data() {
        return {
        };
    },

    computed: {
        ...mapGetters(['getHtml', 'isPanelVisible', 'hovered', 'selected'])
    },

    methods: {
        ...mapActions(['setPage', 'getRenderedHtml', 'togglePanel', 'selectContent', 'setCurrentPageId', 'highlightSelected', 'highlightHovered']),
        ...mapMutations(['SET_LAYOUT_ID', 'SET_PAGE_ID', 'SET_CURRENT_PAGE_ID', 'SET_HOVERED', 'SET_SELECTED']),
    },

    mounted() {
        this.setPage(this.pageId);
        this.getRenderedHtml(this.pageId);
        this.setCurrentPageId(this.pageId);

        this.$event.$on('layoutHovered', ({layoutId, event}) => {
            event.stopPropagation();
            let layout = document.getElementById(this.hovered);
            if (layout) {
                layout.style.outline = "none";
            }
            if (this.selected !== layoutId) {
                layout = document.getElementById(layoutId);
                if (layout) {
                    this.highlightHovered(layoutId);
                    layout.style.outline = "3px solid orange";
                    layout.style['outline-offset'] = '-3px';
                }
            }
        });

        this.$event.$on('layoutSelectedFromStructrue', ({layoutId}) => {
            if (layoutId !== this.selected) {
                let selectedLayout = document.getElementById(this.selected);
                if (selectedLayout) {
                    selectedLayout.style.outline = "none";
                }
            }
            let layout = document.getElementById(layoutId);
            if (layout) {
                layout.style.outline = "3px solid red";
                layout.style['outline-offset'] = '-3px';
            }
        });

        this.$event.$on('layoutSelected', ({layoutId, event}) => {
            if (layoutId == this.selected) {
                if (this.isPanelVisible) {
                    this.togglePanel();
                }

                let selectedLayout = document.getElementById(this.selected);
                if (selectedLayout) {
                    selectedLayout.style.outline = "none";
                    this.highlightSelected(null);
                }
            } else {
                if (!this.isPanelVisible) {
                    this.togglePanel();
                }

                event.stopPropagation();

                let selectedLayout = document.getElementById(this.selected);
                if (selectedLayout) {
                    selectedLayout.style.outline = "none";
                }

                let hoveredLayout = document.getElementById(this.hovered);
                if (hoveredLayout) {
                    hoveredLayout.style.outline = "none";
                    this.highlightHovered(null);
                }

                let layout = document.getElementById(layoutId);
                if (layout) {
                    this.highlightSelected(layoutId);
                    layout.style.outline = "3px solid red";
                    layout.style['outline-offset'] = '-3px';
                    this.selectContent({
                        contentId: layoutId.replace('Layout-', ''),
                        contentType: 'LAYOUT'
                    });
                }
            }
        });

        this.$event.$on('menuHovered', ({menuId, event}) => {
            event.stopPropagation();
            let content = document.getElementById(this.hovered);
            if (content) {
                content.style.outline = "none";
            }
            if (this.selected !== menuId) {
                content = document.getElementById(menuId);
                if (content) {
                    this.highlightHovered(menuId);
                    content.style.outline = "3px solid orange";
                    content.style['outline-offset'] = '-3px';
                }
            }
        });

        this.$event.$on('menuSelected', ({menuId, event}) => {
            if (menuId == this.selected) {
                if (this.isPanelVisible) {
                    this.togglePanel();
                }

                let selectedContent = document.getElementById(this.selected);
                if (selectedContent) {
                    selectedContent.style.outline = "none";
                    this.highlightSelected(null)
                }
            } else {
                if (!this.isPanelVisible) {
                    this.togglePanel();
                }

                event.stopPropagation();

                let selectedContent = document.getElementById(this.selected);
                if (selectedContent) {
                    selectedContent.style.outline = "none";
                }

                let hoveredContent = document.getElementById(this.hovered);
                if (hoveredContent) {
                    hoveredContent.style.outline = "none";
                    this.highlightHovered(null)
                }

                let content = document.getElementById(menuId);
                if (content) {
                    this.highlightSelected(menuId);
                    content.style.outline = "3px solid red";
                    content.style['outline-offset'] = '-3px';
                    this.selectContent({
                        contentId: menuId.replace('Menu-', ''),
                        contentType: 'MENU'
                    });
                }
            }
        });

        this.$event.$on('menuItemHovered', ({menuItemId, event}) => {
            event.stopPropagation();
            let content = document.getElementById(this.hovered);
            if (content) {
                content.style.outline = "none";
            }
            if (this.selected !== menuItemId) {
                content = document.getElementById(menuItemId);
                if (content) {
                    this.highlightHovered(menuItemId);
                    content.style.outline = "3px solid orange";
                    content.style['outline-offset'] = '-3px';
                }
            }
        });

        this.$event.$on('menuItemSelected', ({menuItemId, event}) => {
            if (menuItemId == this.selected) {
                if (this.isPanelVisible) {
                    this.togglePanel();
                }
                let selectedContent = document.getElementById(this.selected);
                if (selectedContent) {
                    selectedContent.style.outline = "none";
                    this.highlightSelected(null);
                }
            } else {
                if (!this.isPanelVisible) {
                    this.togglePanel();
                }

                event.stopPropagation();

                let selectedContent = document.getElementById(this.selected);
                if (selectedContent) {
                    selectedContent.style.outline = "none";
                }

                let hoveredContent = document.getElementById(this.hovered);
                if (hoveredContent) {
                    hoveredContent.style.outline = "none";
                    this.highlightHovered(null);
                }

                let content = document.getElementById(menuItemId);
                if (content) {
                    this.highlightSelected(menuItemId);
                    content.style.outline = "3px solid red";
                    content.style['outline-offset'] = '-3px';
                    this.selectContent({
                        contentId: menuItemId.replace('MenuItem-', ''),
                        contentType: 'MENU_ITEM'
                    });
                }
            }
        });
    }
}
</script>

<style>

</style>
