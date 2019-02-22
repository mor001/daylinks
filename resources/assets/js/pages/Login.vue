<template>
    <div>
        <p v-show="isError">認証に失敗しました。</p>
        <form @submit.prevent="login">
            <h1>ログイン</h1>
            ユーザーID: <input type="userid" v-model="loginForm.userid">
            パスワード: <input type="password" v-model="loginForm.password">
            <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
    </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    data () {
        return {
            loading: true,
            isError: false,
            loginForm: {
              userid: '',
              password: ''
            },
        }
    },
    computed: {
      ...mapState({
        apiStatus: state => state.auth.apiStatus,
        loginErrors: state => state.auth.loginErrorMessages
      })
    },    
    methods: {
      async login () {
        // authストアのloginアクションを呼び出す
        await this.$store.dispatch('auth/login', this.loginForm)
        if (this.apiStatus) {
          console.log(this.apiStatus);
          // トップページに移動する
          this.$router.push('/')
        }
      }
    }
}
</script>