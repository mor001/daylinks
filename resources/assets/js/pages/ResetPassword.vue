<template>
  <main id="main">
    <article class="login">
      <h1><img src="images/logo_green.png" alt="ロゴマーク" /></h1>
      <!--▼▼エラーメッセージここから-->
      <div id="login_message" class="login_error" v-if="showAlert">
        <p>パスワードを再設定に失敗しました。</p>
      </div>
      <div v-if="success" class="info">
        <p>パスワードを再設定しました。</p>
        <p><RouterLink to="/login">ログイン</RouterLink>へ戻る</p>
      </div>
      <div v-else id="login_form">
        <form @submit.prevent="reset">
          <input id="token" type="hidden" :value="form.token" />
          <div class="login_item">
            <label for="email"></label>
            <input type="text" name="email" id="email" required="required" placeholder="メールアドレス" v-model="form.email" />
          </div>
          <div class="login_item">
            <label for="password"></label>
            <input type="password" name="password" id="password" required="required" placeholder="新しいパスワード" v-model="form.password" />
          </div>
          <div class="login_item">
            <label for="password_confirmation"></label>
            <input type="password" name="password_confirmation" id="password_confirmation" required="required" placeholder="新しいパスワード確認入力" v-model="form.password_confirmation" />
          </div>
          <div class="button-panel">
            <input type="submit" class="button" title="リセット" value="リセット">
          </div>
        </form>
      </div>
    </article>
  </main>
</template>

<script>
export default {
  data () {
    return {
      loading: false,
      showAlert: false,
      success: false,
      form: {
        email: null,
        password: null,
        password_confirmation: null,
        token: this.$route.params.token,
      },
    }
  },
  mounted() {

  },
  methods: {
    async reset() {
      this.loading = true
      this.showAlert = false
      this.success = false
      await window.axios.post('/api/password/reset' , this.form)
      .then( (response) => {
        this.success = true
      }).catch( (error) => {
        console.log(error)
        this.showAlert = true
      }).finally( () => {
        this.loading = false
      })
    }
  }
}
</script>