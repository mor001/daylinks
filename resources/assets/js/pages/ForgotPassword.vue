<template>
    <div>
      <loading v-if="loading" class="loading"></loading>
      <div v-if="showAlert" class="error">
        <p>パスワードリセットの送信に失敗しました。</p>
      </div>
      <div v-if="success" class="info">
        <p>パスワードリセットのご案内メールを{{email}}に送信しました。</p>
      </div>
      <div v-else class="content">
        <form @submit.prevent="sendResetMail">
          <p>登録されているメールアドレスにパスワードリセットの手順を送信致します。</p>
          <p>登録されているメールアドレスを入力してメール送信をクリックしてください。</p>
          <p>登録されているメールアドレスが分からない場合は事業者までお問い合わせください。</p>
          <div class="login_item">
            <label for="email"></label>
            <input type="email" name="email" required="required" placeholder="メールアドレス" v-model="form.email" />
          </div>
          <button type="submit">メール送信</button>
        </form>
      </div>
    </div>
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