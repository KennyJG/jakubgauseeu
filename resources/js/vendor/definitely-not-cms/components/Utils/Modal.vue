<template>
    <div :id="name" class="overlay text-left">
        <a href="#" class="cancel"></a>

        <div class="modal leading-loose">
            <div class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                <slot></slot>

                <footer class="flex mt-8">
                    <slot name="footer"></slot>
                </footer>

                 <a href="#" class="close">&times;</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name']
    }
</script>

<style>
    .overlay {
        visibility: hidden;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .4);
        transition: opacity .3s;
        opacity: 0;
    }
    .overlay:target {
        visibility: visible;
        opacity: 1;
    }
    .modal {
        position: relative;
        width: 500px;
        max-width: 80%;
    }
    
    .modal .close {
        position: absolute;
        top: 20px;
        right: 25px;
        color: grey;
        text-decoration: none;
    }
    .overlay .cancel {
        position: absolute;
        width: 100%;
        height: 100%;
    }
</style>