<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
      <router-link to="/admin">戻る</router-link>
    </div>
    <div v-else style="display:flex;">
      <template v-if="!loading">
        <a href="#" class="prev" @click="prev"><i class="fas fa-caret-square-left"></i></a>
        <p><span>{{this.y}}</span>年<span>{{this.m}}</span>月 予約状況一覧</p>
        <a href="#" class="next" @click="next"><i class="fas fa-caret-square-right"></i></a>
      </template>
    </div>
    <template v-if="!loading">
      <ReserveTable :reserves="this.reserves" :holidays="this.holidays" :users="this.users" :current-year="this.y" :current-month="this.m" />
    </template>
  </div>
</template>

<script>
  import ReserveTable from '../components/ReserveTable'
  //import ListView from '../components/ListView'
  export default {
    data() {
      return {
        reserves: null,
        holidays: null,
        users: null,
        showAlert: false,
        alertMessage: '',
        loading: true,
        showCalendar: true,
        y: 0,
        m: 0,
        d: 0,
        limit: 0,
        checkList: null,
      }
    },
    components: {
      ReserveTable,
    },
    methods: {
      onOpenForm(arg) {
        this.checkList = arg
        this.showCalendar = false
      },
      onCloseForm(arg) {
        if(arg) {
          this.fetchSchedules()
        }
        this.showCalendar = true
      },
      async fetchSchedules() {
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''
        this.reserves = null
        let url = '/api/admin/reserve/monthly/' + this.y + '/' + this.m
        await window.axios.get(url)
        .then( (response) => {
          console.log(response.data.reserves)
          this.reserves = response.data.reserves
          this.holidays = response.data.holidays
          this.users = response.data.users
          this.y = response.data.y
          this.m = response.data.m
        }).catch( (error) => {
          console.log(error.response)
          this.showAlert = true
          this.alertMessage = 'データ取得に失敗しました。'
        }).finally( () => {
          this.loading = false
          this.$store.commit('admin/setCurrentYearReserve', this.y)
          this.$store.commit('admin/setCurrentMonthReserve', this.m)
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
      this.y = this.$store.getters['admin/currentYearReserve']
      this.m = this.$store.getters['admin/currentMonthReserve']
      if(!this.y) {
        this.y = m.format("YYYY")
      }
      if(!this.m) {
        this.m = m.format("MM")
      }
      this.fetchSchedules()
    },
    computed: {
    },
    filters: {
    },
  }
</script>