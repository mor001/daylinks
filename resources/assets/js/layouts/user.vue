<template>
  <div>
    <header v-if="isLogin">
      <Navbar />
    </header>
    <transition mode="out-in">
      <RouterView />
    </transition>
    <footer>
      <Footer />
    </footer>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'

export default {
  data() {
    return {
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/isLogin']
    },
  },
  components: {
    Navbar,
    Footer,
  },
  methods: {
  },
  async mounted() {
    console.log('★LAYOUT user.vue mounted')
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

<style scoped>
.v-enter-active, .v-leave-active {
  transition: opacity .5s;
}
.v-enter, .v-leave-to {
  opacity: 0;
}
</style>
