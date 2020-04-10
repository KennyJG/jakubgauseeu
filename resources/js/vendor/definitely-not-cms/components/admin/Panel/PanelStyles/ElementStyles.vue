<template>
    <div class="pt-5 pb-2 relative">
        <div class="absolute top-0 right-0 mt-1">
            <visible :value="layout.display"></visible>
        </div>
        <div class="flex mt-4">
            <background-color :value="layout['background-color']"></background-color>
            <color :value="layout.color"></color>
        </div>
        <font-family :value="layout['font-family']"></font-family>
        <font-size :value="layout['font-size']" :unit="'px'"></font-size>
        <font-weight :value="layout['font-weight']"></font-weight>
        <text-align :value="layout['text-align']" class="mt-2"></text-align>
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