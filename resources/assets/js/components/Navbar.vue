<template>
  <header id="header">
    <div id="top_header">
      <div class="container clearfix">
        <h1 class="col-3"><RouterLink to="/"><img src="/images/logo_wh.png" alt="ロゴマーク"/></RouterLink></h1>
        <h2 class="col-9">{{ tenantName }}</h2>
      </div>
    </div>
    <div id="nav-header" class="header-logo-menu">
      <div class="container">
        <div class="nav-drawer-wrap">
          <div id="nav-drawer">
            <input id="nav-input" type="checkbox" class="nav-unshown">
            <label id="nav-open" for="nav-input"><span class="burger"></span><span class="text">MENU</span></label>
            <label class="nav-unshown" id="nav-close" for="nav-input"></label>
            <div id="nav-content">
              <div class="logo_wrap">
                <RouterLink to="/"><img src="/images/logo_green.png" alt="ロゴマーク"/></RouterLink>
              </div>
              <div class="menu">
                <ul>
                  <li>
                    <RouterLink to="/user"><i class="fas fa-user-circle fa-lg"></i>
                      <!--****************************************************************
                        <span class="msg_wrap available">未読メッセージが<span class="num">2</span>通あります。</span>
                        available　クラスがない場合は非表示
                      ********************************************************************-->
                      <span class="name_wrap"><span class="name">{{ username }}</span>さん</span>
                      <span class="msg_wrap available" v-if="unreadNotice > 0">未読メッセージが<span class="num">{{unreadNotice}}</span>あります。</span>
                    </RouterLink>
                  </li>
                  <li><RouterLink to="/"><i class="fas fa-home fa-lg"></i>ホーム</RouterLink></li>
                  <li><RouterLink to="/user"><i class="fas fa-user fa-lg"></i>マイページ</RouterLink></li>
                  <li><RouterLink to="/notice"><i class="fas fa-comments fa-lg"></i>お知らせ<span class="num">2</span></RouterLink></li>
                  <li><a v-if="isLogin" href="#" @click="logout"><i class="fas fa-sign-out-alt fa-lg"></i>ログアウト</a></li>
                </ul>
              </div>
            </div><!--#nav-content-->
          </div><!--#nav-drawer-->
        </div>
        <div id="main_header" class="clearfix">
          <div class="menu display_pc">
            <ul class="clearfix">
              <li><RouterLink to="/"><i class="fas fa-home fa-lg"></i>ホーム</RouterLink></li>
              <li><RouterLink to="/user"><i class="fas fa-user fa-lg"></i>マイページ</RouterLink></li>
              <li><RouterLink to="/notice"><i class="fas fa-comments fa-lg"></i>お知らせ</RouterLink></li>
              <li><a v-if="isLogin" href="#" @click="logout"><i class="fas fa-sign-out-alt fa-lg"></i>ログアウト</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div><!--.header-logo-menu-->
  </header>
</template>

<script>
export default {
  data () {
    return {
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['user/isLogin']
    },
    username () {
      return this.$store.getters['user/username']
    },
    unreadNotice () {
      return this.$store.getters['user/unread_notice']
    },
    tenantName () {
      return this.$store.getters['appdata/tenantName']
    },
  },
  methods: {
    // ログアウト
    async  logout() {
      await this.$store.dispatch('auth/logout')
      this.$router.push('/login')
    },
  },
  mounted() {
    //console.log('Navbar mounted.')
  },
  updated() {
    //console.log('Navbar updated.')
  },
}
</script>

<style media="screen">
[v-cloak] {
  display: none;
}
</style>