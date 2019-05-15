<template>
    <div>
      <loading v-if="loading" class="loading"></loading>
      <div v-if="showAlert" class="error">
        <p>パスワードリセットに失敗しました。</p>
      </div>
      <div v-if="success" class="info">
        <p>パスワードを再設定しました。</p>
        <p><RouterLink to="/login">ログイン</RouterLink>へ戻る</p>
      </div>
      <div v-else class="content">
        <b-form @submit.prevent="reset">
          <input id="token" type="hidden" :value="form.token" />
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

          <b-form-group
              id="igPassword"
              label="新しいパスワード:"
              label-for="password"
          >
          <b-form-input
              id="password"
              type="password"
              v-model="form.password"
              required />
          </b-form-group>

          <b-form-group
              id="igPasswordConfirmation"
              label="新しいパスワード確認入力:"
              label-for="password_confirmation"
          >
          <b-form-input
              id="password_confirmation"
              type="password"
              v-model="form.password_confirmation"
              required />
          </b-form-group>

          <b-button
            size="lg"
            type="submit"
            variant="outline-primary">
            リセット
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