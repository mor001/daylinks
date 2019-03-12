<template>
  <div>
    <div class="alert alert-danger" role="alert" v-if="showAlert">
      {{ alertMessage }}
    </div>
    <h3>管理画面ログイン</h3>
    <b-form @submit.prevent="login">
      <h1></h1>
      <b-form-group
        id="igUserId"
        label="ユーザーID:"
        label-for="userid"
      >
        <b-form-input
          id="userid"
          type="text"
          v-model="loginForm.userid"
          required />
      </b-form-group>
      <b-form-group
        id="igPassword"
        label="パスワード:"
        label-for="password"
      >
        <b-form-input
          id="password"
          type="password"
          v-model="loginForm.password"
          required />
      </b-form-group>

      <b-button
        size="lg"
        type="submit"
        variant="outline-primary">
        ログイン
      </b-button>
    </b-form>
  </div>
</template>

<script>
export default {
  data () {
    return {
      loginForm: {
        userid: 'admin',
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
      await this.$store.dispatch('admin/login' , this.loginForm)
      .then(function (response) {
        const m = window.moment()
        self.$store.commit('appdata/setCurrentYear', m.format('YYYY'))
        self.$store.commit('appdata/setCurrentMonth', m.format('MM'))
        self.$router.push('/admin')
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