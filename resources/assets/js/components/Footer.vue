<template>
  <footer class="footer">
    <a v-if="isLogin" href="#" @click="logout">Logout</a>
  </footer>
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
  },
  methods: {
    // ログアウト
    async  logout() {
      await this.$store.dispatch('auth/logout')
      this.$router.push('/login')
    },
  },
}
</script>