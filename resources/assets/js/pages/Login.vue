<template>
  <div>
    <div class="alert alert-danger" role="alert" v-if="showAlert">
      {{ alertMessage }}
    </div>
    <form @submit.prevent="login">
      <h1></h1>
      <p>ユーザーID: <input type="userid" v-model="loginForm.userid"></p>
      <p>パスワード: <input type="password" v-model="loginForm.password"></p>
      <p><button type="submit" class="btn btn-primary">ログイン</button></p>
    </form>
  </div>
</template>

<script>
export default {
  data () {
    return {
      loginForm: {
        userid: 'muto',
        password: 'aaa111'
      },
      showAlert: false,
      alertMessage: '',
    }
  },
  computed: {
  },
  methods: {
    async login () {
      const self = this
      await this.$store.dispatch('auth/login' , this.loginForm)
      .then(function (response) {
        const m = window.moment();
        self.$store.commit('appdata/setCurrentYear', m.format('YYYY'))
        self.$store.commit('appdata/setCurrentMonth', m.format('MM'))
        self.$router.push('/')
      }).catch(function (error) {
        console.log(error)
        self.showAlert = true
        self.alertMessage = 'ログインに失敗しました。'
      })
    }
  },
  created () {
  },
  mounted () {
  },
}
</script>