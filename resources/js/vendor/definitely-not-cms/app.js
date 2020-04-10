/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.EventBus = new Vue();
Vue.prototype.$event = window.EventBus;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('Uppy', require('./components/Uppy.vue').default);

Vue.component('page-render', require('./components/PageRender.vue').default);

Vue.component('panel', require('./components/admin/Panel/Panel.vue').default);

Vue.component('page-panel', require('./components/admin/Panel/PagePanel.vue').default);

Vue.component('page-childrens', require('./components/admin/Panel/Pages/Childrens/PageChildrens.vue').default);

Vue.component('page-siblings', require('./components/admin/Panel/Pages/Siblings/PageSiblings.vue').default);

Vue.component('layout-panel', require('./components/admin/Panel/LayoutPanel.vue').default);

Vue.component('layout-childrens', require('./components/admin/Panel/Layouts/Childrens/Childrens.vue').default);
Vue.component('layout-column-childrens', require('./components/admin/Panel/Layouts/Childrens/ColumnChildrens.vue').default);
Vue.component('layout-row-childrens', require('./components/admin/Panel/Layouts/Childrens/RowChildrens.vue').default);
Vue.component('layout-section-childrens', require('./components/admin/Panel/Layouts/Childrens/SectionChildrens.vue').default);

Vue.component('layout-siblings', require('./components/admin/Panel/Layouts/Siblings/Siblings.vue').default);
Vue.component('layout-section-siblings', require('./components/admin/Panel/Layouts/Siblings/SectionSiblings.vue').default);
Vue.component('layout-row-siblings', require('./components/admin/Panel/Layouts/Siblings/RowSiblings.vue').default);
Vue.component('layout-column-siblings', require('./components/admin/Panel/Layouts/Siblings/ColumnSiblings.vue').default);
Vue.component('layout-element-siblings', require('./components/admin/Panel/Layouts/Siblings/ElementSiblings.vue').default);

Vue.component('add-element', require('./components/admin/Panel/Layouts/Childrens/AddElement.vue').default);
Vue.component('elements', require('./components/admin/Panel/Layouts/Childrens/Elements.vue').default);

Vue.component('menu-panel', require('./components/admin/Panel/MenuPanel.vue').default);

Vue.component('menu-childrens', require('./components/admin/Panel/Menus/Childrens/MenuChildrens.vue').default);

Vue.component('menu-item-panel', require('./components/admin/Panel/MenuItemPanel.vue').default);

Vue.component('menu-item-siblings', require('./components/admin/Panel/Menus/Siblings/MenuItemSiblings.vue').default);

Vue.component('structure-path', require('./components/admin/Panel/StructurePath.vue').default);

Vue.component('page-styles', require('./components/admin/Panel/PanelStyles/PageStyles.vue').default);
Vue.component('section-styles', require('./components/admin/Panel/PanelStyles/SectionStyles.vue').default);
Vue.component('column-styles', require('./components/admin/Panel/PanelStyles/ColumnStyles.vue').default);
Vue.component('row-styles', require('./components/admin/Panel/PanelStyles/RowStyles.vue').default);
Vue.component('element-styles', require('./components/admin/Panel/PanelStyles/ElementStyles.vue').default);
Vue.component('menu-styles', require('./components/admin/Panel/PanelStyles/MenuStyles.vue').default);
Vue.component('menu-item-styles', require('./components/admin/Panel/PanelStyles/MenuItemStyles.vue').default);

Vue.component('width', require('./components/admin/Panel/Styles/Width.vue').default);
Vue.component('height', require('./components/admin/Panel/Styles/Height.vue').default);
Vue.component('color', require('./components/admin/Panel/Styles/Color.vue').default);
Vue.component('background-color', require('./components/admin/Panel/Styles/BackgroundColor.vue').default);
Vue.component('background-image', require('./components/admin/Panel/Styles/BackgroundImage.vue').default);
Vue.component('visible', require('./components/admin/Panel/Styles/Visible.vue').default);
Vue.component('font-size', require('./components/admin/Panel/Styles/FontSize.vue').default);
Vue.component('font-family', require('./components/admin/Panel/Styles/FontFamily.vue').default);
Vue.component('font-weight', require('./components/admin/Panel/Styles/FontWeight.vue').default);
Vue.component('text-align', require('./components/admin/Panel/Styles/TextAlign.vue').default);
// Vue.component('modal', require('./components/Utils/Modal.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store/store';
import { Chrome } from 'vue-color';
import VModal from 'vue-js-modal';
import VTooltip from 'v-tooltip';

Vue.use(VTooltip);

Vue.use(VModal);
Vue.component('chrome-picker', Chrome);

const app = new Vue({
    el: '#app',
    store
});
