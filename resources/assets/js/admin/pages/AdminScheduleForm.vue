<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
      <router-link to="/admin">戻る</router-link>
    </div>
    <div v-if="schedule">
      <p v-if="schedule.id">更新</p>
      <p v-else>新規登録</p>
      <form>
        <p>タイトル：<input type="text" name="title" id="title" required="required" placeholder="タイトル" v-model="schedule.title" /></p>
        <p>内容：<textarea name="tenantnote" id="tenantnote" placeholder="内容" v-model="schedule.description"></textarea></p>
        <p><router-link to="/admin/schedules/list">戻る</router-link><input type="submit" class="button" value="登録" /></p>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        loading: true,
        showAlert: false,
        schedule: null,
      }
    },
    props: {
    },
    components: {
    },
    methods: {
      fetchData() {
        const self = this
        window.axios.get('/api/admin/schedule/daily/'+this.$route.params.year+'/'+this.$route.params.month+'/'+this.$route.params.day)
        .then( response => {
          if(response.data.schedules) {
            this.schedule = response.data.schedules
          } else {
            this.schedule = []
            this.schedule.id = null
            this.schedule.title = null
            this.schedule.description = null
          }
        }).finally(() => {
          this.loading = false
        })
      },
      goBack () {
        window.history.length > 1
          ? this.$router.go(-1)
          : this.$router.push('/')
      },
    },
    mounted() {
      this.fetchData()
    },
    computed: {
    },
  }
</script>