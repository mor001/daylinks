<template>
    <div>
        <p v-show="loading" class="loader">Now loading...</p>
        <p v-if="showAlert">情報の取得に失敗しました。</p>
        <h1>ホーム</h1>
        <ul id="example-1">
          <li v-for="rec in schedules.data" :key = "rec.id">
            <router-link v-bind:to="detailUrl(rec.date)">{{ rec.date }}({{rec.day_of_week}})</router-link> - {{ rec.title }}
          </li>
        </ul>
    </div>
</template>

<script>
  import * as CONSTS from '../common/const';
  
  export default {
    data() {
      return {
        schedules: [],
        showAlert: false,
        alertMessage: '',
        y: 0,
        m: 0,
        d: 0,
        loading: true,
      }
    },
    methods: {
      fetchSchedules () {
        const self = this
        window.axios.get('/api/schedule/monthly/2019/01')
        .then(function (response) {
          self.schedules = response.data
        }).catch(function (error) {
          self.showAlert = true
          self.alertMessage = 'データ取得に失敗しました。'
        }).finally(() => self.loading = false) 
      },
    },
    mounted() {
      this.fetchSchedules()
    },
    computed: {
      detailUrl: function() {
        return function (date) {
          var arr = date.split('-')
          return '/detail/'+arr[0]+'/'+arr[1]+'/'+arr[2]
        }
      }
    },
  }
</script>