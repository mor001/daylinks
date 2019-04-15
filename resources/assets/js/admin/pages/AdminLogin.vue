<template>
<div class="login-box">
  <p v-if="showAlert">{{ alertMessage }}</p>
  <div class="login-logo">
    <p>daylinks管理画面</p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form @submit.prevent="login">
      <p>
        <input type="userid" v-model="form.userid">
      </p>
      <p>
        <input type="password" v-model="form.password">
      </p>
      <button type="submit">ログイン</button>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</template>

<script>
export default {
  data () {
    return {
      form: {
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
      await this.$store.dispatch('admin/login' , this.form)
      .then(function (response) {
        if(self.$store.getters['error/message'] !== '') {
          self.showAlert = true
          self.alertMessage = self.$store.getters['error/message']
        } else {
          self.$store.commit('appdata/setCurrentYear', window.moment().format('YYYY'))
          self.$store.commit('appdata/setCurrentMonth', window.moment().format('MM'))
          self.$router.push('/admin')
        }
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