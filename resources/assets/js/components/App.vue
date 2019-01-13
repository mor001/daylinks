<template>
    <div>
        <ul>
            <li><router-link to="/">ホーム</router-link></li>
            <li><router-link to="/login">ログイン</router-link></li>
            <li><router-link to="/user">ユーザー情報</router-link></li>
            <li @click="logout">ログアウト</li>
            <li><router-link to="/detail/2019/01/15">test</router-link></li>
        </ul>
        <hr>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        methods: {
            logout() {
                axios.get('/api/logout').then(res => {
                    this.$store.commit('setLogin', false);
                    this.$router.push({path: '/'});
                });
            }
        }
    }
</script>