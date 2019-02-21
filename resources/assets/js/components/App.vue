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
    <Footer />
  </div>
</template>

<script>
import Navbar from './Navbar.vue'
import Footer from './Footer.vue'

export default {
  components: {
    Navbar,
    Footer
  },
  mounted() {
    axios.get('/api/me').then(res => {
    }).catch(err => {
        console.log('meに失敗');
        console.log('err:', err);
        this.$router.push({path: '/login'});
    });
    console.log('app mounted');
  },
  methods: {
    logout() {
      axios.get('/api/logout').then(res => {
        this.$store.commit('auth/setLogin', false);
        localStorage.setItem('isLogin', false);
        this.$router.push({path: '/'});
      });
    }
  }
}
</script>