<template>
  <main id="main">
    <div v-show="loading" class="loader">読み込み中...</div>
    <p v-if="showAlert">{{ alertMessage }}</p>
    <div v-show="!loading" id="main_contents">
      <article class="container">
        <div id="pager" class="pager_wrap">
          <div class="inner">
            <a href="#" class="prev" @click="prev"><i class="fas fa-caret-square-left"></i></a>
            <p><span>{{this.y}}</span>年<span>{{this.m}}</span>月</p>
            <a href="#" class="next" @click="next"><i class="fas fa-caret-square-right"></i></a>
          </div>
        </div>

        <div class="calender_nav full-width">
          <ul class="clearfix">
            <li class="col-4"><a href="#" @click="setCalendarView(true)"><i class="fas fa-calendar-alt"></i>MONTH</a></li>
            <li class="col-4"><a href="#" @click="setCalendarView(false)"><i class="fas fa-calendar-week"></i>LIST</a></li>
            <li class="col-4"><router-link v-bind:to="detailUrl('2019-08-21')" class="title"><i class="fas fa-calendar-day"></i>TODAY</router-link></li>
          </ul>
        </div>
        <Calendar v-if="showCalendar" :schedules="schedules" :current-year="this.y" :current-month="this.m" />
        <ListView v-else :schedules="schedules" :current-year="this.y" :current-month="this.m" />
      </article><!--.container-->
    </div><!--#main_contents-->
  </main><!--#main-->
</template>

<script>
  import Calendar from '../components/Calendar'
  import ListView from '../components/ListView'
  import Common from '../common/common'
  export default {
    mixins: [ Common ],
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
      ListView,
    },
    methods: {
      fetchSchedules () {
        const self = this
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''
        
        //this.$store.dispatch('schedule/fetchMonthly' , this.y, this.m)
        //this.schedules = this.$store.getters['schedule/schedules']

        let url = '/api/schedule/monthly/' + this.y + '/' + this.m
        window.axios.get(url)
        .then(response => {
          if(response.data.schedules.length <= 0) {
            self.showAlert = true
            self.alertMessage = 'データが存在しませんでした。'
          }
          self.schedules = response.data.schedules
          self.y = response.data.y
          self.m = response.data.m
          self.limit = response.data.limit
          self.$store.commit('user/setUnreadNotice', response.data.unread_notice)
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
      setCalendarView(showCalendar) {
        this.showCalendar = showCalendar
      },
    },
    mounted() {
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
      today: function() {
        return window.moment().format('YYYY-MM-DD')
      },
    },
    filters: {
    },
  }
</script>