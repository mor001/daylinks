<template>
    <div>
        <p v-show="loading" class="loader">Now loading...</p>
        <p v-if="showAlert">{{ alertMessage }}</p>
        <h1>ホーム</h1>
        <div>
          <a href="#" @click="prev">前月</a>
          <a href="#" @click="next">次月</a>
        </div>
        <ul id="example-1">
          <li v-for="rec in schedules" :key = "rec.id">
            <router-link v-bind:to="detailUrl(rec.date)">{{ rec.date }}({{rec.day_of_week}})</router-link> - {{ rec.title }}
          </li>
        </ul>
    </div>
</template>

<script>
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
        self.loading = true
        self.showAlert = false
        self.alertMessage = ''
        let url = '/api/schedule/monthly/' + this.y + '/' + this.m
        console.log('url: ' + url)
        window.axios.get(url)
        .then(function (response) {
          if(response.data.schedules.length <= 0) {
            self.showAlert = true
            self.alertMessage = 'データが存在しませんでした。'
          }
          self.schedules = response.data.schedules
          self.y = response.data.y
          self.m = response.data.m
        }).catch(function (error) {
          console.log(error.response)
          self.showAlert = true
          self.alertMessage = 'データ取得に失敗しました。'
        }).finally(() => {
          self.loading = false
          self.$store.commit('appdata/setCurrentYear', self.y)
          self.$store.commit('appdata/setCurrentMonth', self.m)
        })
      },
      prev() {
        const m = window.moment([this.y, this.m - 1, 1]).add(-1, 'month');
        this.y = m.format('YYYY')
        this.m = m.format('MM')
        this.fetchSchedules()
      },
      next() {
        const m = window.moment([this.y, this.m - 1, 1]).add(1, 'month');
        this.y = m.format('YYYY')
        this.m = m.format('MM')
        this.fetchSchedules()
      },
    },
    mounted() {
      console.log('Home.vue mounted')
      const m = window.moment();
      this.y = this.$store.getters['appdata/currentYear']
      this.m = this.$store.getters['appdata/currentMonth']
      if(!this.y) {
        this.y = m.format("YYYY")
      }
      if(!this.m) {
        this.m = m.format("MM")
      }
      this.fetchSchedules()
    },
    computed: {
      detailUrl: function() {
        return function (date) {
          const arr = date.split('-')
          return '/detail/'+arr[0]+'/'+arr[1]+'/'+arr[2]
        }
      },
    },
  }
</script>