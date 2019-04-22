<template>
  <transition mode="out-in">
    <RouterView />
  </transition>
</template>

<script>
export default {
  components: {
  },
  async mounted() {
    console.log('★LAYOUT admin.vue mounted')
    /*
    const self = this
    if(localStorage.getItem('token')) {
      await window.axios.get('/api/me')
      .then(function (response) {
      }).catch(async function (error) {
        console.log('[app.vueで/api/meに失敗してリダイレクト]')
        await self.$store.dispatch('auth/logout')
        self.$router.push('/login')
      })
    }
    */
  },
}
</script>