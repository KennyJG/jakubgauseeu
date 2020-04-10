<template>
    <div class="pt-5 pb-2 relative">
        <background-color :value="menu['background-color']"></background-color>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    computed: {
        ...mapGetters(['menu'])
    },
}
</script>

<style>

</style>
