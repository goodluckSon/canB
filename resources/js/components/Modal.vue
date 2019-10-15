<template>
    <div class="fixed top-0 bottom-0 left-0 right-0 w-full h-full">
        <div class="flex content-center flex-wrap bg-white w-full h-full">
        <div class="w-1/3 p-2">
            <div class="text-gray-700 text-center bg-gray-400 p-2">1</div>
        </div>
        <div class="w-1/3 p-2">
            <div class="text-gray-700 text-center bg-gray-400 p-2">2</div>
        </div>
        <div class="w-1/3 p-2">
            <div class="text-gray-700 text-center bg-gray-400 p-2">3</div>
        </div>
        <div class="w-1/3 p-2">
            <div class="text-gray-700 text-center bg-gray-400 p-2">4</div>
        </div>
        <div class="w-1/3 p-2">
            <div class="text-gray-700 text-center bg-gray-400 p-2">5</div>
        </div>
        </div>   
    </div>    
</template>

<script>
export default {
    props:{
        active:Boolean,
    },
    data() {
        return {
            modal:false,
        }
    },
    mounted() {
        this.modal = this.active;
    },
    methods: {
        closeModal(){
            this.modal = false;
            this.$emit("update:active", this.modal)
        }
    },
}
</script>
<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.2s;
    }
    .fade-enter{
        transition: opacity 0.2s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to{
        transform: translateX(80vw);
    }    
</style>
