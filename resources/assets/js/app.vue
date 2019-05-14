<template>
  <RouterView />
</template>

<script>
export default {
  components: {
  },
  mounted() {
    async () => {
      if(localStorage.getItem('token')) {
        await window.axios.get('/api/me')
        .then( (response) => {
        }).catch(async (error) => {
          console.log('[app.vueで/api/meに失敗してリダイレクト]')
          this.$store.dispatch('auth/logout')
          this.$router.push('/login')
        })
      }
    }
  },
}
</script>