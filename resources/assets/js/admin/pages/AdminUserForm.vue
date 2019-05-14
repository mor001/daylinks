<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
      <router-link to="/admin">戻る</router-link>
    </div>
    <div v-else>
      <p v-if="userid !== undefined">利用者更新</p>
      <p v-else>利用者新規登録</p>
      <form>
  <p><input type="text" name="name" id="name"  required="required" placeholder="氏名" v-model="user.name" /></p>
  <p><input type="text" name="kana" id="kana"  required="required" placeholder="かな" v-model="user.kana" /></p>
  <p><input type="text" name="password" id="password"  required="required" placeholder="パスワード" v-model="user.password" /></p>
  <p><input type="text" name="parents" id="parents" placeholder="保護者名" v-model="user.parents" /></p>
  <p><input type="text" name="parents_kana" id="parents_kana" placeholder="保護者名かな" v-model="user.parents_kana" /></p>
  <p><input type="email" name="email" id="email"  required="required" placeholder="メールアドレス" v-model="user.email" /></p>
  <p><input type="text" name="limit" id="limit" required="required" placeholder="利用日数" v-model="user.limit" /></p>
  <p><textarea name="tenantnote" id="tenantnote" placeholder="備考" v-model="user.tenantnote"></textarea></p>
  <p><router-link to="/admin">戻る</router-link> <input type="submit" class="button" value="登録" /></p>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => {
      return {
        user: [],
        showAlert: false,
        alertMessage: null,
        loading: false,
        userid: null,
      }
    },
    components: {
    },
    methods: {
      fetchData() {
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''
        
        let url = '/api/admin/users/detail/' + this.userid
        window.axios.get(url)
        .then( (response) => {
          if(response.data.user === null) {
            this.showAlert = true
            this.alertMessage = 'データが存在しませんでした。'
          } else {
            this.user = response.data.user
          }
        }).catch( (error) => {
          console.log(error.response)
          this.showAlert = true
          this.alertMessage = 'データ取得に失敗しました。'
        }).finally( () => {
          this.loading = false
        })
      },
    },
    mounted() {
      this.userid = this.$route.params.userid
      if(this.userid !== undefined) {
        this.fetchData()
      }
    },
    computed: {
    },
  }
</script>