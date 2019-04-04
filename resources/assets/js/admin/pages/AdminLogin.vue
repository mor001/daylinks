<template>
<v-app id="inspire">
  <v-content>
    <v-container fluid fill-height>
      <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
          <v-card class="elevation-12">
            <v-toolbar dark color="primary">
              <v-toolbar-title>管理画面ログイン</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>
              <v-form>
                <v-text-field prepend-icon="person" name="userid" label="ユーザーID" type="text" v-model="loginForm.userid"></v-text-field>
                <v-text-field prepend-icon="lock" name="password" label="パスワード" id="password" type="password" v-model="loginForm.password"></v-text-field>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn @click="login" color="primary">ログイン</v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-content>
</v-app>
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