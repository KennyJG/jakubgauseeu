<template>
    <div class="pt-5 pb-2 relative">
        <div class="absolute top-0 right-0 mt-1">
            <visible :value="layout.display"></visible>
        </div>
        <width :value="layout.width" :unit="'%'" :units='["%"]'></width>
        <height v-if="layout.childs.length == 0" :value="layout.height" :unit="'px'" :units='["px"]'></height>
        <background-color :value="layout['background-color']"></background-color>
        <background-image class="mt-2" :value="layout['background-image']"></background-image>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    computed: {
        ...mapGetters(['layout'])
    },
}
</script>

<style>

</style>