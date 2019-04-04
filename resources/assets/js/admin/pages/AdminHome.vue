<template>
<v-app>
  <v-navigation-drawer
    fixed
    clipped
    app
  >
    <v-list dense class="pt-0">
      <router-link to="admin/">
        <v-list-tile>
          <v-list-tile-action>
            <v-icon>dashboard</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>ホーム</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </router-link>
      <router-link to="admin/setting">
        <v-list-tile>
          <v-list-tile-action>
            <v-icon>settings</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>設定</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </router-link>
      <router-link to="admin/users/list">
        <v-list-tile>
          <v-list-tile-content>
            <v-list-tile-title><v-icon>people</v-icon>利用者一覧</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </router-link>
    </v-list>
  </v-navigation-drawer>
  <v-toolbar
    dark
    color="primary"
    clipped-left
    fixed
    app
  >
    <v-toolbar-title class="white--text">{{$store.getters['appdata/tenantName']}}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn icon @click="logout">
      <v-icon>exit_to_app</v-icon>
    </v-btn>
  </v-toolbar>
  <v-content>
    <v-container fluid fill-height>
      <v-fade-transition mode="out-in">
        <router-view></router-view>
      </v-fade-transition>
    </v-container>
  </v-content>
</v-app>
</template>

<script>
  export default {
    data() {
      return {
      }
    },
    components: {
    },
    methods: {
      // ログアウト
      async  logout() {
        await this.$store.dispatch('admin/logout')
        this.$router.push('/admin/login')
      },
    },
    mounted() {
    },
    computed: {
    },
  }
</script>