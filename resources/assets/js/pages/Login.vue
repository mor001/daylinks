<template>
  <main id="main">
    <article class="login">
      <h1><img src="images/logo_green.png" alt="ロゴマーク" /></h1>
      <!--▼▼エラーメッセージここから-->
      <div id="login_message" class="login_error" v-if="showAlert">
        <p>{{ alertMessage }}</p>
      </div>
      <!--▲▲エラーメッセージここまで-->
      <div id="login_form">
        <form @submit.prevent="login">
          <div class="login_item">
            <label for="text"></label>
            <input type="text" name="userid" id="userid"  required="required" placeholder="ユーザーID" v-model="loginForm.userid" />
          </div>
          <div class="login_item">
            <label for="password"></label>
            <input type="password" name="password" required="required" placeholder="パスワード" v-model="loginForm.password" />
          </div>
          <div class="button-panel">
            <input type="submit" class="button" title="ログイン" value="ログイン">
          </div>
        </form>
      </div><!--#login_form-->

      <!--▼▼初期画面のみ、lost_passwordkから遷移した場合はここから下の中身を消してください。-->
      <div class="login-footer">
        <p><RouterLink to="/forgot">パスワードを忘れた方はこちら<i class="fas fa-long-arrow-alt-right left_pd"></i></RouterLink></p>
      </div>
      <!--▲▲初期画面のみ、lost_passwordkから遷移した場合はここから上の中身を消してください。-->
    </article>
  </main><!--#main-->
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