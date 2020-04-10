<template>
    <div class="px-8">
        <layout-column-childrens v-if="layout.type == 'COLUMN'"></layout-column-childrens>
        <layout-row-childrens v-if="layout.type == 'ROW'"></layout-row-childrens>
        <layout-section-childrens v-if="layout.type == 'SECTION'"></layout-section-childrens>
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