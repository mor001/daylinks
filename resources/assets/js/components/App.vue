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
        console.log('err:', err);
        this.$router.push({path: '/login'});
    });
  },
  methods: {
    logout() {
      axios.get('/api/logout').then(res => {
        localStorage.removeItem('isLogin');
        localStorage.removeItem('token');
        this.$router.push({path: '/'});
      });
    }
  }
}
</script>