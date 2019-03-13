<template>
  <div>
    <div class="alert alert-danger" role="alert" v-if="showAlert">
      {{ alertMessage }}
    </div>
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
    const self = this
    return {
      loginForm: {
        userid: 'muto',
        password: 'aaa111'
      },
      showAlert: false,
      alertMessage: self.$store.getters['error/message'],
    }
  },
  computed: {
  },
  methods: {
    login () {
      const self = this
      this.$store.dispatch('auth/login' , this.loginForm)
      .then(response => {
        if(self.$store.getters['error/message'] !== '') {
          self.showAlert = true
          self.alertMessage = self.$store.getters['error/message']
        } else {
          self.$store.commit('appdata/setCurrentYear', window.moment().format('YYYY'))
          self.$store.commit('appdata/setCurrentMonth', window.moment().format('MM'))
          self.$router.push('/')
        }
      }).catch(error => {
        console.log('ログインに失敗しました。')
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