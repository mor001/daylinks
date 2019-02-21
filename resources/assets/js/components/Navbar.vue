<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/">
      Home
    </RouterLink>
    <div class="navbar__menu">
      <div v-if="isLogin" class="navbar__item">
        <button class="button">
          <i class="icon ion-md-add"></i>
          Submit a photo
        </button>
      </div>
      <span v-if="isLogin" class="navbar__item">
        {{ username }}
      </span>
      <div class="navbar__item">
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
      return this.$store.getters['auth/isLogin']
    },
    username () {
      return this.$store.getters['auth/user'].name
    }
  }
}
</script>
