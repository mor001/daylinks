<template>
  <RouterView />
</template>

<script>
export default {
  components: {
  },
  mounted() {
    const self = this
    async () => {
      if(localStorage.getItem('token')) {
        await window.axios.get('/api/me')
        .then(function (response) {
        }).catch(async function (error) {
          console.log('[app.vueで/api/meに失敗してリダイレクト]')
          self.$store.dispatch('auth/logout')
          self.$router.push('/login')
        })
      }
    }
  },
}
</script>