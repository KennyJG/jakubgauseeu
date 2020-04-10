const state = {
    pages: null,
    pageId: null,
    page: null,
    currentPageId: null,

    layoutId: null,
    layout: null,

    menuId: null,
    menu: null,

    menuItemId: null,
    menuItem: null,

    styles: null,
    styleTypes: null,
    screenType: 'sm',

    hovered: null,
    selected: null,
}

const getters = {
    getContent: (state) => {
        if (state.layout) {
            return state.layout;
        } else if (state.menuItem) {
            return state.menuItem;
        } else if (state.menu) {
            return state.menu;
        } else if (state.page) {
            return state.page;
        }
        return null;
    },
    getContentType: (state) => {
        if (state.layout) {
            return 'App\\OPWilim\\Layouts\\Layout';
        } else if (state.menuItem) {
            return 'App\\OPWilim\\Menus\\MenuItem';
        } else if (state.menu) {
            return 'App\\OPWilim\\Menus\\Menu';
        } else if (state.page) {
            return 'App\\OPWilim\\Pages\\Page';
        }
        return null;
    },
    getPageId: (state) => state.pageId,
    pageId: (state) => state.pageId,
    page: (state) => state.page,
    pages: (state) => state.pages,
    currentPageId: (state) => state.currentPageId,

    getLayoutId: (state) => state.layoutId,
    layoutId: (state) => state.layoutId,
    layout: (state) => state.layout,

    menuId: (state) => state.menuId,
    menu: (state) => state.menu,

    menuItemId: (state) => state.menuItemId,
    menuItem: (state) => state.menuItem,

    styles: (state) => state.styles,
    styleTypes: (state) => state.styleTypes,
    screenType: (state) => state.screenType,

    hovered: (state) => state.hovered,
    selected: (state) => state.selected,
};

const actions = {
    selectContent({ dispatch }, {contentId: contentId, contentType: contentType}) {
        switch (contentType) {
            case 'LAYOUT':
                dispatch('selectLayout', contentId);
                break;
            case 'MENU':
                dispatch('selectMenu', contentId);
                break;
            case 'MENU_ITEM':
                dispatch('selectMenuItem', contentId);
                break;
            case 'PAGE':
                dispatch('selectPage', contentId);
                break;
        }
    },

    selectLayout({ dispatch }, layoutId) {
        dispatch('unsetAll');
        dispatch('setLayout', layoutId);
        dispatch('setStyles', {
            contentId: layoutId,
            contentType: 'App\\OPWilim\\Layouts\\Layout'
        });
        dispatch('setStyleTypes', {
            contentId: layoutId,
            contentType: 'App\\OPWilim\\Layouts\\Layout'
        });
    },

    selectMenu({ dispatch }, menuId) {
        dispatch('unsetAll');
        dispatch('setMenu', menuId);
        dispatch('setStyles', {
            contentId: menuId,
            contentType: 'App\\OPWilim\\Menus\\Menu'
        });
        dispatch('setStyleTypes', {
            contentId: menuId,
            contentType: 'App\\OPWilim\\Menus\\Menu'
        });
    },

    selectMenuItem({ dispatch }, menuItemId) {
        dispatch('unsetAll');
        dispatch('setMenuItem', menuItemId);
        dispatch('setStyles', {
            contentId: menuItemId,
            contentType: 'App\\OPWilim\\Menus\\MenuItem'
        });
        dispatch('setStyleTypes', {
            contentId: menuItemId,
            contentType: 'App\\OPWilim\\Menus\\MenuItem'
        });
    },

    selectPage({ dispatch }, pageId) {
        dispatch('unsetAll');
        dispatch('setPage', pageId);
        dispatch('setCurrentPageId', pageId);
        dispatch('getRenderedHtml', pageId);
    },

    unsetAll({ commit }) {
        commit('SET_PAGE', null);
        commit('SET_PAGE_ID', null);

        commit('SET_LAYOUT', null);
        commit('SET_LAYOUT_ID', null);

        commit('SET_MENU', null);
        commit('SET_MENU_ID', null);

        commit('SET_MENU_ITEM', null);
        commit('SET_MENU_ITEM_ID', null);

        commit('SET_STYLES', null);
        commit('SET_STYLE_TYPES', null);
        commit('SET_SCREEN_TYPE', null);
    },

    setPage({ commit }, pageId) {
        axios.get('/api/pages/' + pageId)
            .then(response => {
                commit('SET_PAGE_ID', pageId);
                commit('SET_PAGE', JSON.parse(JSON.stringify(response.data.data)));
            });
    },

    setLayout({ commit, dispatch }, layoutId) {
        axios.get('/api/layouts/' + layoutId)
            .then(response => {
                commit('SET_LAYOUT_ID', layoutId);
                commit('SET_LAYOUT', JSON.parse(JSON.stringify(response.data.data)));
                dispatch('setPage', response.data.data.page_id);
            });
    },

    setMenu({ commit, state, dispatch }, menuId) {
        axios.get('/api/menus/' + menuId)
            .then(response => {
                commit('SET_MENU_ID', menuId);
                commit('SET_MENU', JSON.parse(JSON.stringify(response.data.data)));
                dispatch('setPage', state.currentPageId);
            });
    },

    setMenuItem({ commit, dispatch, state }, menuItemId) {
        axios.get('/api/menu-items/' + menuItemId)
            .then(response => {
                commit('SET_MENU_ITEM_ID', menuItemId);
                commit('SET_MENU_ITEM', JSON.parse(JSON.stringify(response.data.data)));
                dispatch('setPage', state.currentPageId);
            });
    },

    setStyles({ commit, state}, {contentId: contentId, contentType: contentType}) {
        axios.get('/api/styles?modelId=' + contentId + '&modelType=' + contentType + '&screenType=sm')
            .then((response) => {
                commit('SET_STYLES', response.data.data);
            });
    },

    setStyleTypes({ commit, state }, {contentId: contentId, contentType: contentType}) {
        axios.get('/api/style-types?modelId=' + contentId + '&modelType=' + contentType + '&screenType=sm')
            .then((response) => {
                commit('SET_STYLE_TYPES', response.data.data);
            });
    },

    setScreenType({ commit, dispatch, state }, screenType) {
        commit('SET_SCREEN_TYPE', screenType);
        dispatch('setStyles', state.layoutId, 'TODO');
        dispatch('setStyleTypes', state.layoutId, 'TODO');
    },

    refetchContent({ dispatch, state }) {
        if (state.layout) {
            dispatch('setLayout', state.layoutId);
        } else if (state.menuItem) {
            dispatch('setMenuItem', state.menuItemId);
        } else if (state.menu) {
            dispatch('setMenu', state.menuId);
        } else if (state.page) {
            dispatch('setPage', state.pageId);
        }
    },

    setCurrentPageId({ commit }, pageId) {
        commit('SET_CURRENT_PAGE_ID', pageId);
    },

    deleteLayout({ dispatch, state }, layoutId) {
        if (state.layout && state.layout.id == layoutId) {
            dispatch('unsetAll');
        }
        axios.delete('/api/layouts/' + layoutId)
            .then(response => {
                dispatch('refetchContent');
            });
    },

    getPages({ commit }) {
        axios.get('/api/pages')
            .then(response => {
                commit('SET_PAGES', JSON.parse(JSON.stringify(response.data.data)));
            });
    },

    highlightSelected({ commit }, id) {
        EventBus.$emit(
            'layoutSelectedFromStructrue',
            { layoutId: id }
        );

        commit('SET_SELECTED', id);
    },

    reselect({ commit, state }) {
        let selected = state.selected;
        commit('SET_SELECTED', null);


        EventBus.$emit(
            'layoutSelectedFromStructrue',
            { layoutId: selected }
        );

        commit('SET_SELECTED', selected);
    },

    highlightHovered({ commit }, id) {
        commit('SET_HOVERED', id);
    }
};

const mutations = {
    SET_PAGES: (state, pages) => {
        state.pages = pages;
    },
    SET_PAGE: (state, page) => {
        state.page = page;
    },
    SET_PAGE_ID: (state, id) => {
        state.pageId = id;
    },
    SET_CURRENT_PAGE_ID: (state, id) => {
        state.currentPageId = id;
    },

    SET_LAYOUT: (state, layout) => {
        state.layout = layout;
    },
    SET_LAYOUT_ID: (state, id) => {
        state.layoutId = id;
    },

    SET_MENU: (state, menu) => {
        state.menu = menu;
    },
    SET_MENU_ID: (state, id) => {
        state.menuId = id;
    },

    SET_MENU_ITEM: (state, menuItem) => {
        state.menuItem = menuItem;
    },
    SET_MENU_ITEM_ID: (state, menuItemId) => {
        state.menuItemId = menuItemId;
    },

    SET_STYLES: (state, styles) => {
        state.styles = styles;
    },
    SET_STYLE_TYPES: (state, styleTypes) => {
        state.styleTypes = styleTypes;
    },
    SET_SCREEN_TYPE: (state, screenType) => {
        state.screenType = screenType;
    },

    SET_SELECTED: (state, selected) => {
        state.selected = selected;
    },
    SET_HOVERED: (state, hovered) => {
        state.hovered = hovered;
    }
};

export default { state, getters, actions, mutations }
