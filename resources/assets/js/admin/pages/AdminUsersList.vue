<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
    </div>
    <p>利用者一覧</p>
    <ul v-for="(user, index) in users" :key="index">
      <li>[{{user.id}}] {{user.name}}</li>
    </ul>
    <router-link to="/admin">ホーム</router-link>
  </div>
</template>

<script>
  export default {
    data: () => {
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
      async fetchData() {
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''

        let url = '/api/admin/users/list'
        await window.axios.get(url)
        .then( (response) => {
          if(response.data.users.length <= 0) {
            this.showAlert = true
            this.alertMessage = 'データが存在しませんでした。'
          }
          this.users = response.data.users
        }).catch( (error) => {
          console.log(error.response)
          this.showAlert = true
          this.alertMessage = 'データ取得に失敗しました。'
        }).finally( () => {
          this.loading = false
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