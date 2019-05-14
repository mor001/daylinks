<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
      <router-link to="/admin">戻る</router-link>
    </div>
    <div v-if="this.schedules">
      <div v-for="date in this.schedules" :key="date.key">
        <p>{{date}}</p>
      </div>
      <a @click="$emit('closeForm', 'OK')">戻る</a>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => {
      return {
        loading: false,
        showAlert: false,
        schedule: null,
      }
    },
    props: {
      schedules: { required: true },
    },
    components: {
    },
    methods: {
      fetchData: () => {
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
      goBack () {
        window.history.length > 1
          ? this.$router.go(-1)
          : this.$router.push('/')
      },
    },
    mounted() {
      //this.fetchData()
    },
    computed: {
    },
  }
</script>