<template>
    <div class="pt-5 pb-2 relative">
        <background-color :value="menuItem['background-color']"></background-color>
        <color :value="menuItem['color']"></color>
        <font-family :value="menuItem['font-family']"></font-family>
        <font-size :value="menuItem['font-size']"></font-size>
        <font-weight :value="menuItem['font-weight']"></font-weight>
        <div class="absolute top-0 right-0 mt-1">
            <visible :value="menuItem.display"></visible>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    computed: {
        ...mapGetters(['menuItem'])
    },
}
</script>

<style>

</style>
