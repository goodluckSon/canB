<template>
    <div class="container bg-white w-full h-screen">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-6 h-full text-right">
                <div class="py-4"></div>
                <div class="py-4"></div>
                <div class="py-4"></div>
                <h6 class="text-primary display-4 text-right">Welcome</h6>
                <img :src="require('../../assets/logo.png')" class="w-25" alt="">
                <div class="py-4"></div>
                <div class="py-2"></div>
                    <router-link 
                            v-if="!$store.state.token" to="/login" 
                            class="btn btn-primary">
                            Login
                    </router-link>
                    <router-link 
                            v-else to="/profile" 
                            class="btn btn-primary">
                            プロフィール
                    </router-link>
                    <router-link 
                            to="/create" 
                            class="btn btn-primary">
                            Start
                    </router-link>                
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 h-full">
                <div class="align-self-center text-left">
                    <div class="py-4"></div>
                    <div class="py-4"></div>
                    <div class="py-4"></div>
                    <h6 class="text-grey display-4">canBとは</h6>
                    <p class="text-grey py-3">
                        様々なデバイスをご自身の思うままにデザインをすることが出来るサービスです．<br/>
                        豊富なフレームから自分の好みにカスマイズすることが可能<br/>
                        ご自身のお気に入りの言葉や画像をお好きなカバーに組み込むことが出来ます
                    </p>                    
                    <a href="/pdf.pdf" class="btn btn-primary">対応機種</a>
                </div>
            </div>
        </div>
    </div>
</template>