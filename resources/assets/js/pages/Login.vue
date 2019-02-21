<template>
    <div>
        <p v-show="isError">認証に失敗しました。</p>
        <form @submit.prevent="login">
            <h1>ログイン</h1>
            ユーザーID: <input type="userid" v-model="userid">
            パスワード: <input type="password" v-model="password">
            <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isError: false,
            userid: '',
            password: '',
        }
    },
    methods: {
        login() {
            axios.post('/api/login', {
                userid: this.userid,
                password: this.password
            }).then(res => {
                console.log('★★★');
                const token = 'Bearer ' + res.data.access_token;
                console.log(res);
                axios.defaults.headers.common['Authorization'] = token;
                this.$store.commit('auth/setLogin', true);
                this.$store.commit('auth/setToken', token);
                localStorage.setItem('isLogin', true);
                localStorage.setItem('token', token);
                this.$router.push({path: '/'});
            }).catch(error => {
                localStorage.isLogin = false;
                this.isError = true;
            });
        }
    }
}
</script>