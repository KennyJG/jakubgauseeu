<template>
    <div class="px-8">
        <layout-column-siblings v-if="layout.type == 'COLUMN'"></layout-column-siblings>
        <layout-row-siblings v-if="layout.type == 'ROW'"></layout-row-siblings>
        <layout-section-siblings v-if="layout.type == 'SECTION'"></layout-section-siblings>
        <layout-element-siblings v-if="layout.type == 'ELEMENT'"></layout-element-siblings>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters(['layout', 'currentPageId']),
    }
}
</script>

<style>

</style>