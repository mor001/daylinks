<template>
  <div>
    <loading v-if="loading" class="loading"></loading>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
    </div>
    <p>利用者一覧</p>
    <ul v-for="(user, index) in users" :key="index">
      <li>[{{user.id}}] {{user.name}}</li>
    </ul>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        users: [],
        showAlert: false,
        alertMessage: null,
        loading: true,
      }
    },
    components: {
    },
    methods: {
      fetchData () {
        const self = this
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''
        
        let url = '/api/admin/users/list'
        window.axios.get(url)
        .then(response => {
          if(response.data.users.length <= 0) {
            self.showAlert = true
            self.alertMessage = 'データが存在しませんでした。'
          }
          self.users = response.data.users
        }).catch(error => {
          console.log(error.response)
          self.showAlert = true
          self.alertMessage = 'データ取得に失敗しました。'
        }).finally(() => {
          self.loading = false
        })
      },
    },
    mounted() {
      this.fetchData()
    },
    computed: {
    },
  }
</script>