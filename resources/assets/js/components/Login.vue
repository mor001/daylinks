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
                const token = res.data.access_token;
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                state.isLogin = true;
                this.$router.push({path: '/'});
            }).catch(error => {
                this.isError = true;
            });
        }
    }
}
</script>