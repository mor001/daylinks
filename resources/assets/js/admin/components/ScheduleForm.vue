<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
      <router-link to="/admin">戻る</router-link>
    </div>
    <div v-if="!loading">
      <div v-for="date in this.dateList" :key="date.key">
        <p>{{date}}</p>
      </div>
      <p v-if="errors.length">
        <b>入力エラーがあります:</b>
        <ul>
          <li v-for="error in errors" :key="error.key">{{ error }}</li>
        </ul>
      </p>
      <form>
        <p>タイトル：<input type="text" name="title" id="title" required="required" placeholder="タイトル" v-model="schedule.title" /></p>
        <p>内容：<textarea name="description" id="description" placeholder="内容" v-model="schedule.description"></textarea></p>
        <p>公開日時：<input type="text" name="publish" id="publish" required="required" placeholder="公開日時" v-model="schedule.publish" /></p>
        <p>
          <a @click="$emit('closeForm', false)">戻る</a>
          <button type="button" class="reserve_info" value="予約する" @click="regist()">登録</button>
        </p>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        errors: [],
        loading: false,
        showAlert: false,
        schedule: {title: '', description: '', publish: moment().format('YYYY-MM-DD HH:00:00')},
      }
    },
    props: {
      dateList: { required: true },
    },
    components: {
    },
    methods: {
      checkForm() {
        this.errors = []
        if (!this.schedule.title) {
          this.errors.push('タイトルを入力してください。')
        }
        if (!this.schedule.description) {
          this.errors.push('内容を入力してください。')
        }
        if (!this.schedule.publish) {
          this.errors.push('公開日時を入力してください。')
        }
        if (!moment(this.schedule.publish).isValid()) {
          this.errors.push('公開日時を正しく入力してください。')
        }
        //if (!this.errors.length) {
        //  return true;
        //}
        //e.preventDefault();
      },
      fetchData(id) {
        this.loading = true
        //window.axios.get('/api/admin/schedule/daily/'+this.$route.params.year+'/'+this.$route.params.month+'/'+this.$route.params.day)
        window.axios.get(`/api/admin/schedule/daily/id/${id}`)
        .then( (response) => {
          if(response.data.schedules) {
            this.schedule = response.data.schedules
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
        this.checkForm()
        if (this.errors.length > 0) {
          console.log(this.errors)
          return
        }
        var postData = {
          'dateList': this.dateList,
          'title': this.schedule.title,
          'description': this.schedule.description,
          'publish': this.schedule.publish,
        };
        await window.axios.post('/api/admin/schedule/save', postData)
        .then( (response) => {
          if(response.data.result) {
            this.$emit('closeForm', true)
          } else {
            console.log(response.data.message)
          }
        }).catch( (error) => {
          console.log(error)
        })
      }
    },
    mounted() {
      if(this.dateList) {
        this.fetchData(this.dateList[0].id)
      }
    },
    computed: {
    },
  }
</script>