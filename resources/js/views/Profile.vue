<template>
    <div class="h-full bg-white">
        <ul class="nav nav-tabs nav-primary">
            <li class="nav-item">
                <router-link to="/profile" class="nav-link">プロフィール変更</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/profile/address" class="nav-link">配達場所🚛</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/profile/drafts" class="nav-link">保存一覧</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/profile/history" class="nav-link">購入履歴</router-link>
            </li>
        </ul>  
        <div class="container">
            <router-view></router-view>    
        </div>      
    </div>
</template>
<script>
export default {
    data() {
        return {
        }
    },
}
</script>