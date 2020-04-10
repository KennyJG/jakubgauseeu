<template>
    <div class="pt-5 pb-2 relative">
        <background-color :value="page['background-color']"></background-color>
        <background-image :value="page['background-image']"></background-image>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    computed: {
        ...mapGetters(['page'])
    },
}
</script>

<style>

</style>