<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
      <router-link to="/admin">戻る</router-link>
    </div>
    <div>
      <div v-for="date in this.dateList" :key="date.key">
        <p>{{date}}</p>
      </div>
      <form @submit.prevent="regist">
        <p>タイトル：<input type="text" name="title" id="title" required="required" placeholder="タイトル" v-model="schedule.title" /></p>
        <p>内容：<textarea name="description" id="description" placeholder="内容" v-model="schedule.description"></textarea></p>
        <p>公開日時：<input type="text" name="publish" id="publish" required="required" placeholder="公開日時" v-model="schedule.publish" /></p>
        <p><a @click="$emit('closeForm', 'OK')">戻る</a><input type="submit" class="button" value="登録" /></p>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        loading: false,
        showAlert: false,
        schedule: {title: '', description: '', publish: moment().format('YYYY-MM-DD hh:mm:ss')},
      }
    },
    props: {
      dateList: { required: true },
    },
    components: {
    },
    methods: {
      fetchData() {
        window.axios.get('/api/admin/schedule/daily/'+this.$route.params.year+'/'+this.$route.params.month+'/'+this.$route.params.day)
        .then( (response) => {
          if(response.data.schedules) {
            this.schedule = response.data.schedules
          } else {
            this.schedule = []
            this.schedule.id = null
            this.schedule.title = null
            this.schedule.description = null
          }
        }).finally( () => {
          this.loading = false
        })
      },
      goBack() {
        window.history.length > 1
          ? this.$router.go(-1)
          : this.$router.push('/')
      },
      async regist() {
        var postData = {
          'dateList': this.dateList,
          'title': this.schedule.title,
          'description': this.schedule.description,
          'publish': this.schedule.publish,
        };
        await window.axios.post('/api/admin/schedule/save', postData)
        .then( (response) => {
          console.log(response.data)
        }).catch( (error) => {
          console.log(error)
        })
      }
    },
    mounted() {
      //this.fetchData()
    },
    computed: {
    },
  }
</script>