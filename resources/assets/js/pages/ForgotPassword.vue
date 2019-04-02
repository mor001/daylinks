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
        <b-form @submit.prevent="sendResetMail">
          <p>登録されているメールアドレスにパスワードリセットの手順を送信致します。</p>
          <p>登録されているメールアドレスを入力してメール送信をクリックしてください。</p>
          <p>登録されているメールアドレスが分からない場合は事業者までお問い合わせください。</p>
          <b-form-group
            id="igEmail"
            label="メールアドレス:"
            label-for="email"
          >
            <b-form-input
              id="email"
              type="text"
              v-model="form.email"
              required />
          </b-form-group>
          <b-button
            size="lg"
            type="submit"
            variant="outline-primary">
            メール送信
          </b-button>
        </b-form>
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
      const self = this
      this.loading = true
      this.showAlert = false
      this.success = false
      await window.axios.post('/api/password/reset/request', this.form)
      .then(response => {
        self.success = true
      }).catch(error => {
        self.showAlert = true
      }).finally(() => {
        self.loading = false
      })
    }
  }
}
</script>