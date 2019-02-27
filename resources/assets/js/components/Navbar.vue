<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/">
      Home
    </RouterLink>
    <div class="navbar__menu">
      <span v-if="isLogin" v-cloak class="navbar__item">
        ようこそ、{{ username }}さん
      </span>
      <span v-else v-cloak class="navbar__item">
        <RouterLink to="/login">ログイン</RouterLink>してください
      </span>
      <div v-if="isLogin" class="navbar__item">
        <RouterLink class="button button--link" to="/user">
          user info
        </RouterLink>
        <a v-if="isLogin" href="#" @click="logout">Logout</a>
      </div>
    </div>
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