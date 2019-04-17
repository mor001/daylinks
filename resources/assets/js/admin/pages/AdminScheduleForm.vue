<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
      <router-link to="/admin">戻る</router-link>
    </div>
    <div v-else>
      <p v-if="schedule">更新</p>
      <p v-else>新規登録</p>
      <form>
        <p>タイトル：<input type="text" name="name" id="name"  required="required" placeholder="タイトル" v-model="schedule.title" /></p>
        <p>内容：<textarea name="tenantnote" id="tenantnote" placeholder="内容" v-model="schedule.description"></textarea></p>
        <p><router-link to="/admin">戻る</router-link> <input type="submit" class="button" value="登録" /></p>
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
      targetDateList: { required: true },
    },
    components: {
    },
    methods: {
      fetchData() {
        window.axios.get('/api/admin/schedule/daily/'+this.$route.params.year+'/'+this.$route.params.month+'/'+this.$route.params.day)
        .then( response => {
          if(response.data.schedules !== null) {
            this.schedule = response.data.schedules
          } else {
            this.schedule.title = ''
            this.schedule.description = ''
          }
        }).finally(() => {
          this.loading = false
        })
      },
    },
    mounted() {
      this.fetchData()
    },
    computed: {
    },
  }
</script>