<template>
    <div class="bg-white h-full">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <router-link class="nav-link" :to="{name:'Administration'}"></router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{name:'AdminIconsIndex'}">アイコン</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{name:'FramesIndex'}"> フレーム</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{name:'DesignsIndex'}">デザイン</router-link>
            </li>
        </ul>
        <router-view></router-view>
    </div>
</template>
