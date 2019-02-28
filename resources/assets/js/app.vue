<template>
  <div>
    <header>
      <Navbar />
    </header>
    <main>
      <div class="container">
        <RouterView />
      </div>
    </main>
    <footer>
      <Footer />
    </footer>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'

export default {
  components: {
    Navbar,
    Footer
  },
  async mounted() {
    console.log('★ app.vue mounted')
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
  },
}
</script>