<template>
  <main id="main">
    <article class="login">
      <div id="login_wrap">
        <h1><img src="images/logo_green.png" alt="ロゴマーク" /></h1>
          <div id="login_message">
            <p>メールアドレスを入力してください。新しいパスワードを作成するためのリンクをメールでお送りします。</p>
          </div>

          <div v-if="showAlert" id="login_message" class="login_error">
            <p>入力されたメールアドレスは登録されていません。</p>
          </div>
          <div v-if="success" class="info">
            <p>パスワードリセットのご案内メールを{{email}}に送信しました。</p>
          </div>
          <div v-else id="login_form">
            <form @submit.prevent="sendResetMail">
              <div class="login_item">
                <label for="email"></label>
            <input type="email" name="email" required="required" placeholder="メールアドレス" v-model="form.email" />
              </div>
              <div class="button-panel">
                <input type="submit" class="button" title="新しいパスワードを取得" value="新しいパスワードを取得" />
              </div>
            </form>
          </div><!--#login_form-->

          <div class="login-footer">
            <p><RouterLink to="/login"><i class="fas fa-long-arrow-alt-left right_pd"></i>ログイン画面へ戻る</RouterLink></p>
          </div>

        </div><!--#login_wrap-->
      </article>
    </main><!--#main-->
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
      },
    }
  },
  mounted() {

  },
  methods: {
    async sendResetMail () {
      this.loading = true
      this.showAlert = false
      this.success = false
      await window.axios.post('/api/password/reset/request', this.form)
      .then( (response) => {
        this.success = true
      }).catch(error => {
        this.showAlert = true
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>