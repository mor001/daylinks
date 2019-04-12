<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
      <router-link to="/admin">戻る</router-link>
    </div>
    <div v-else>
      <a href="#" class="prev" @click="prev"><i class="fas fa-caret-square-left"></i></a>
      <p><span>{{this.y}}</span>年<span>{{this.m}}</span>月 スケジュール一覧</p>
      <a href="#" class="next" @click="next"><i class="fas fa-caret-square-right"></i></a>
      <Calendar v-if="showCalendar" :schedules="schedules" :current-year="this.y" :current-month="this.m" />
    </div>
  </div>
</template>

<script>
  import Calendar from '../components/Calendar'
  //import ListView from '../components/ListView'
  export default {
    data() {
      return {
        schedules: [],
        showAlert: false,
        alertMessage: '',
        loading: true,
        showCalendar: true,
        y: 0,
        m: 0,
        d: 0,
        limit: 0,
      }
    },
    components: {
      Calendar,
      //ListView,
    },
    methods: {
      fetchSchedules () {
        const self = this
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''
        
        let url = '/api/admin/schedule/monthly/' + this.y + '/' + this.m
        window.axios.get(url)
        .then(response => {
          self.schedules = response.data.schedules
          self.y = response.data.y
          self.m = response.data.m
        }).catch(error => {
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
        const m = window.moment([this.y, this.m - 1, 1]).add(-1, 'month')
        this.y = m.format('YYYY')
        this.m = m.format('MM')
        this.fetchSchedules()
      },
      next() {
        const m = window.moment([this.y, this.m - 1, 1]).add(1, 'month')
        this.y = m.format('YYYY')
        this.m = m.format('MM')
        this.fetchSchedules()
      },
      setCalendarView(showCalendar) {
        this.showCalendar = showCalendar
      },
    },
    mounted() {
      const m = window.moment()
      this.y = m.format("YYYY")
      this.m = m.format("MM")
      this.fetchSchedules()
    },
    computed: {
    },
    filters: {
    },
  }
</script>