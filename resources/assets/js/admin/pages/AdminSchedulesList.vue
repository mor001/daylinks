<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
      <router-link to="/admin">戻る</router-link>
    </div>
    <div v-else>
      <template v-if="this.showCalendar && schedules">
        <a href="#" class="prev" @click="prev"><i class="fas fa-caret-square-left"></i></a>
        <p><span>{{this.y}}</span>年<span>{{this.m}}</span>月 スケジュール一覧</p>
        <a href="#" class="next" @click="next"><i class="fas fa-caret-square-right"></i></a>
        <Calendar :schedules="this.schedules" :holidays="this.holidays" :current-year="this.y" :current-month="this.m" @openForm="onOpenForm" />
      </template>
      <template v-else>
        <ScheduleForm :schedules="this.checkList" @closeForm="onCloseForm" />
      </template>
    </div>
  </div>
</template>

<script>
  import Calendar from '../components/Calendar'
  import ScheduleForm from '../components/ScheduleForm'
  //import ListView from '../components/ListView'
  export default {
    data() {
      return {
        schedules: null,
        holidays: null,
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
      Calendar,
      //ListView,
      ScheduleForm,
    },
    methods: {
      onOpenForm(arg) {
        console.log('call onOpenForm')
        this.checkList = arg
        console.log(arg)
        this.showCalendar = false
      },
      onCloseForm(arg) {
        console.log('call onCloseForm')
        console.log(arg)
        this.showCalendar = true
      },
      async fetchSchedules() {
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''
        this.schedules = null
        let url = '/api/admin/schedule/monthly/' + this.y + '/' + this.m
        await window.axios.get(url)
        .then( (response) => {
          this.schedules = response.data.schedules
          this.holidays = response.data.holidays
          this.y = response.data.y
          this.m = response.data.m
        }).catch( (error) => {
          console.log(error.response)
          this.showAlert = true
          this.alertMessage = 'データ取得に失敗しました。'
        }).finally( () => {
          this.loading = false
          this.$store.commit('admin/setCurrentYear', this.y)
          this.$store.commit('admin/setCurrentMonth', this.m)
        })
        console.log(this.schedules)
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
      this.y = this.$store.getters['admin/currentYear']
      this.m = this.$store.getters['admin/currentMonth']
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