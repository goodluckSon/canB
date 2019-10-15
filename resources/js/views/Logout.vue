<template>
    <div class="h-full bg-white">
        <div class="container">
            <h1 class="text-center py-4 text-primary">ログアウト</h1>
            <div class="spinner"></div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.Logout();
    },
    methods: {
        async Logout(){
            this.loading = true;
            await this.$store.dispatch('Logout',this.user)
                    .then(res=>{
                        this.$store.commit('エラー','ログアウト 成功')
                        this.$router.push('/')
                    })
                    .catch(error=>{
                        this.error= error;
                    })
                    .then(()=>{
                        this.loading = false;
                    })

        }
    },
}
</script>
<style lang="scss">
.spinner{
    width: 50px;
    height: 50px;
    margin-top: 10px;
    margin: auto;
    border: 3px dotted #6b46c1;
    border-right-color: #2a008d;
    border-left-color: #ae94ec;
    border-radius: 50%;
    animation: Spinner 0.6s linear infinite forwards;
}
@keyframes Spinner {
    100%{
        transform: rotate(360deg);
    }
}
</style>
