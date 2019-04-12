<template>
<div>
  <ul>
    <li><router-link to="admin/">ホーム</router-link></li>
    <li><router-link to="admin/schedules/list">スケジュールリスト</router-link></li>
    <li><router-link to="admin/users/list">利用者一覧</router-link></li>
    <li><router-link to="admin/users/form">利用者新規登録</router-link></li>
    <li><router-link to="admin/users/form/1">利用者更新</router-link></li>
    <li><router-link to="admin/users/form/4">利用者更新 該当ユーザーなしVer</router-link></li>
    <li><a href="#" @click="logout">ログアウト</a></li>
  </ul>
</div>
</template>

<script>
  export default {
    data() {
      return {
      }
    },
    components: {
    },
    methods: {
      // ログアウト
      async  logout() {
        await this.$store.dispatch('admin/logout')
        this.$router.push('/admin/login')
      },
    },
    mounted() {
    },
    computed: {
    },
  }
</script>