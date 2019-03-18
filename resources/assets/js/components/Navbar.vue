<template>
  <nav class="navbar">
    <b-container>
      <b-col cols="5">
        <RouterLink to="/">
          Home
        </RouterLink>
      </b-col>
      <b-col cols="3">
        <span v-if="isLogin" v-cloak>
          ようこそ、{{ username }}さん
        </span>
        <span v-else v-cloak>
          <RouterLink to="/login">ログイン</RouterLink>してください
        </span>
      </b-col>
      <b-col v-if="isLogin">
        <RouterLink to="/user">マイページ</RouterLink>
      </b-col>
      <b-col v-if="isLogin">
        <RouterLink to="/notice">
          お知らせ
        </RouterLink>
      </b-col>
      <b-col v-if="isLogin">
        <a v-if="isLogin" href="#" @click="logout">ログアウト</a>
      </b-col>
    </b-container>
  </nav>
</template>

<script>
export default {
  data () {
    return {
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/isLogin']
    },
    username () {
      return this.$store.getters['auth/username']
    }
  },
  methods: {
    // ログアウト
    async  logout() {
      await this.$store.dispatch('auth/logout')
      this.$router.push('/login')
    },
  },
  mounted() {
    //console.log('Navbar mounted.')
  },
  updated() {
    //console.log('Navbar updated.')
  },
}
</script>

<style media="screen">
[v-cloak] {
  display: none;
}
</style>