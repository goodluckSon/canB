<template>
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-0">
        <router-link to="/" class="navbar-brand">CanB</router-link>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" v-if="$store.state.token">
                <li class="nav-item">
                    <router-link to="/" class="nav-link">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/profile" class="nav-link">プロフィール</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/logout" class="nav-link">ログアウト</router-link>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto" v-else>
                <li class="nav-item">
                    <router-link to="/" class="nav-link">ホーム</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/login" class="nav-link">ログイン</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/join" class="nav-link">新規登録</router-link>
                </li>
            </ul>
            <div class="navbar-nav ml-auto">
                <router-link to="/create" class="btn btn-sm btn-outline-light text-uppercase">Start</router-link>
            </div>
        </div>
        </nav>
        <router-view></router-view>
        <transition name="slide">
            <div class="alert alert-black mb-0 border-0 w-25 pos-fix-bottom-right text-white" v-if="$store.state.notification">
            {{$store.state.notification}}
            <button @click="$store.commit('NotificationClose')" class="material-icons text-white close">close</button>
            </div>
        </transition>
    </div>
</template>
