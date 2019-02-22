<template>
  <footer class="footer">
    <a href="#" @click="logout">Logout</a>
  </footer>
</template>

<script>
export default {
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')
      this.$router.push('/login')
    }
  }
}
</script>