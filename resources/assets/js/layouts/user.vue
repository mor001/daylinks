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
      return this.$store.getters['user/isLogin']
    },
  },
  components: {
    Navbar,
    Footer,
  },
  methods: {
  },
  mounted() {
    console.log('★LAYOUT user.vue mounted')
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
