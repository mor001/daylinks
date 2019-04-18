<template>
    <div>
      <div v-show="loading" class="loader">読み込み中...</div>
      <div v-if="showAlert" class="error">
        <p>情報の取得に失敗しました。</p>
      </div>
      <div v-if="user" class="content">
        <h1>ユーザー情報</h1>
        <table>
          <tr>
            <th>ID</th>
            <td>{{ user.id }}</td>
          </tr>
          <tr>
            <th>ユーザーID</th>
            <td>{{ user.userid }}</td>
          </tr>
          <tr>
            <th>ユーザー名</th>
            <td>{{ user.name }}</td>
          </tr>
          <tr>
            <th>メール</th>
            <td>{{ user.email }}</td>
          </tr>
          <tr>
            <th>登録日</th>
            <td>{{ user.created_at }}</td>
          </tr>
        </table>
      </div>
    </div>
</template>

<script>
export default {
  data () {
    return {
      loading: true,
      showAlert: false,
      user: null,
    }
  },
  mounted() {
    const self = this
    window.axios.get('/api/me')
    .then(response => {
      this.user = response.data
    }).catch(error => {
      this.showAlert = true
    }).finally(() => {
      this.loading = false
    })
  }
}
</script>