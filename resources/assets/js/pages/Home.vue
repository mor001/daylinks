<template>
    <div>
        <p v-show="loading" class="loader">Now loading...</p>
        <p v-if="showAlert">情報の取得に失敗しました。</p>
        <h1>ホーム</h1>
        <div>
          <router-link v-bind:to="{name: 'home', params: { year: '2019', month: '01' }}">前月</router-link>
          <router-link v-bind:to="{name: 'home', params: { year: '2019', month: '03' }}">次月</router-link>
        </div>
        <ul id="example-1">
          <li v-for="rec in schedules.data" :key = "rec.id">
            <router-link v-bind:to="detailUrl(rec.date)">{{ rec.date }}({{rec.day_of_week}})</router-link> - {{ rec.title }}
          </li>
        </ul>
    </div>
</template>

<script>
  import * as CONSTS from '../common/const';
  const moment = require('moment');

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
        let paramY = this.$route.params.year
        let paramM = this.$route.params.month
        console.log('M: ' + this.$route.params.month)
        if(this.$route.params.month.length < 2) {
          paramM = '0' + paramM
        }
        console.log('url: ' + '/api/schedule/monthly/' + paramY + '/' + paramM)
        window.axios.get('/api/schedule/monthly/' + paramY + '/' + paramM)
        .then(function (response) {
          self.schedules = response.data
          self.y = response.data.y
          self.m = response.data.m
          console.log(response)
          console.log('年2：' + self.y)
          console.log('月2：' + self.m)
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
          const arr = date.split('-')
          return '/detail/'+arr[0]+'/'+arr[1]+'/'+arr[2]
        }
      },
      nextLink: function() {
        return function(y, m) {
          const mm = moment([y, m - 1, 1]).add(1, 'month');
          return '/home/' + mm.format("YYYY") + '/' + mm.format("MM");
        }
      },
      prevLink: () => {
        return function(y, m) {
          const mm = moment([y, m - 1, 1]).add(-1, 'month');
          return '/home/' + mm.format("YYYY") + '/' + mm.format("MM");
        }
      },
    },
  }
</script>