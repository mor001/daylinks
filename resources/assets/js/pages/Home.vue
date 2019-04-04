<template>
  <main id="main">
    <loading v-if="loading" class="loading"></loading>
    <p v-if="showAlert">{{ alertMessage }}</p>
    <div id="main_contents">
      <article class="container">
        <div class="common_cnt">
          <h2>{{$store.getters['appdata/tenantName']}}</h2>
        </div>
        <div class="calendar_wrap month-type">
          <div class="pager_wrap">
            <div>
              <a href="#" class="prev" @click="prev"><i class="fas fa-caret-square-left"></i></a>
              <p><span>{{this.y}}</span>年<span>{{this.m}}</span>月</p>
              <a href="#" class="next" @click="next"><i class="fas fa-caret-square-right"></i></a>
            </div>
            <nav class="clearfix">
              <ul>
                <li class="trigger-month carrent" title="月表示"><a href="index.html"></a></li>
                <li class="trigger-list" title="リスト表示"><a href="list.html"></a></li>
              </ul>
            </nav>
          </div>
          <Calendar :schedules="schedules" :current-year="this.y" :current-month="this.m" />
        </div> <!--.calendar_wrap-->
      </article><!--.container-->
    </div><!--#main_contents-->
  </main><!--#main-->
</template>

<script>
  import Calendar from '../components/Calendar'
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
    components: {
      Calendar,
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
    },
    filters: {
    },
  }
</script>