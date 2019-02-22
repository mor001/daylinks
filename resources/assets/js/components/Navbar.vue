<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/">
      Home
    </RouterLink>
    <div class="navbar__menu">
      <span v-if="isLogin" v-cloak class="navbar__item">
        ようこそ、{{username}}さん
      </span>
      <div v-if="isLogin" class="navbar__item">
        <RouterLink class="button button--link" to="/user">
          user info
        </RouterLink>
      </div>
      <div class="navbar__item">
        <RouterLink class="button button--link" to="/login">
          Login / Register
        </RouterLink>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    async username() {
      const user = await this.$store.dispatch('auth/currentUser')
      if(user != null) {
        console.log('111')
        console.log(user)
        return user.name
      } else {
        return '名無し'
      }
    },
  },
}
</script>

<style media="screen">
[v-cloak] {
  display: none;
}
</style>