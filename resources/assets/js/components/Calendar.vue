<template>
  <div class="calendar_wrap month-type">
    <div class="calendar_header">
      <div class="weekday"><span>月</span></div>
      <div class="weekday"><span>火</span></div>
      <div class="weekday"><span>水</span></div>
      <div class="weekday"><span>木</span></div>
      <div class="weekday"><span>金</span></div>
      <div class="saturday"><span>土</span></div>
      <div class="sunday"><span>日</span></div>
    </div><!--.calendar_header-->
    <div class="calendar_body">
      <!--ここから繰り返し(calendar_body内 date_wrap)-->
      <!--****************************************************************
        date_cntにクラス名をつける ( date_wrap > a > date_cnt )
        平日 : "weekday"  土曜 : "saturday"  日曜 : "sunday"  祝日 : "holiday"
        status_cntにクラス名をつける ( date_wrap > a > status_cnt )
        予約申請中 : "reserve_info"          予約済み："reserve_success"
        キャンセル申請中："reserve_warning"  キャンセル済："reserve_danger"
      ********************************************************************-->
      <div class="date_wrap" :class="{'today': date.today, 'blank': date.blank, }"
            v-for="date in dateList" :key="date.key" :data-date="date.date">
        <div class="date_cnt">
          <span class="month">{{this.currentMonth}}月</span>
          <span class="date">{{date.dayNumber}}<span class="date_list_type">日</span></span>
          <span class="day">{{date.weekDay}}</span>
        </div><!--date_cnt-->

        <template v-if="date.schedule">
          <router-link v-bind:to="detailUrl(date.schedule.date)" class="title">
            <div class="title_cnt">
              <span class="title">{{date.schedule.title}}<br /></span>
              <!--<span class="sub_title">イベントのサブタイトルなどの詳細</span>-->
            </div><!--title_cnt-->
            <template v-if="date.schedule.reserve">
              <div class="status_cnt reserve_info">
                <span v-if="date.schedule.reserve.status === 'app_r'" class="reserve"><span class="inner">予約<span class="br">申請中</span></span></span>
                <span v-if="date.schedule.reserve.status === 'reserved'" class="reserve"><span class="inner">予約<span class="br">済</span></span></span>
                <span v-if="date.schedule.reserve.status === 'app_c'" class="reserve"><span class="inner">キャンセル<span class="br">申請中</span></span></span>
                <span v-if="date.schedule.reserve.status === 'canceled'" class="reserve"><span class="inner">キャンセル<span class="br">済</span></span></span>
                <div class="msg_cnt unread" v-if="unread(date.schedule) > 0">
                  <span class="num">{{unread(date.schedule)}}</span>
                  <span class="message">件の未読メッセージ</span>
                </div><!--.msg_cnt-->
                <div class="msg_cnt read" v-else>
                  <span class="num">{{date.schedule.contacts.length}}</span>
                  <span class="message">件の既読メッセージ</span>
                </div><!--.msg_cnt-->
               </div><!--.status_cnt-->
            </template>
            <template v-else>
              <span>予約なし</span>
            </template>
          </router-link>
        </template>
      </div><!--.date_wrap-->
    </div><!--.calendar_body-->
  </div><!-- calendar -->
</template>

<script>
import Common from '../common/common'
export default {
    mixins: [ Common ],
    data() {
      return {
        days: ["日", "月", "火", "水", "木", "金", "土"],
      }
    },
    props: {
      schedules: { required: true },
      currentYear: { required: true },
      currentMonth: { required: true },
    },
    components: {
    },
    computed: {
      schedule() {
        return (date) => {
          for (var i = 0; i < this.schedules.length; i++) {
            const schedule = this.schedules[i]
            if(schedule.date === date) {
              return schedule
            }
          }
          return false
        }
      },
      unread() {
        return (schedule) => {
          if(Array.isArray(schedule.contacts) && schedule.contacts.length <= 0) {
            return 0
          }
          let sum = 0;
          for (var i = 0; i < schedule.contacts.length; i++) {
            const contact = schedule.contacts[i]
            if(contact.is_read === 0) {
              sum++
            }
          }
          return sum
        }
      },
      dateList() {
        const year = this.currentYear
        const month = this.currentMonth
        const currentYM = moment([year, month - 1, 1])  // 引数の年月で初期化
        //const currentYM = moment(year+month+'01', 'YYYYMMDD')  // 引数の年月で初期化
        const startDate = moment(currentYM.startOf('month'))    // 月の最初の日を取得
        const endDate = moment(currentYM.endOf('month'))        // 月の最後の日を取得
        const endDayCount = endDate.date()              // 月の末日
        let startDay = startDate.day()                // 月の最初の日の曜日を取得
        let dayCount = 1                                // 日にちのカウント
        let index = 0
        let dateList = []

        /*
        console.log(currentYM)
        console.log(startDate)
        console.log(endDate)
        console.log('月初曜日: ' + startDate.day())
        console.log('月末曜日: ' + currentYM.endOf('month').format('YYYY-MM-DD dddd'))
        */

        if(startDay === 0) {
          startDay = 7
        }

        for (let w = 0; w < 6; w++) {
          for (let d = 1; d <= 7; d++) {
            const currentDate = moment([year, month - 1, dayCount])
            if (w == 0 && d < startDay) {
              // 1行目で1日の曜日の前
              dateList[index] = {}
            } else if (dayCount > endDayCount) {
              // 末尾の日数を超えた
              dateList[index] = {}
            } else {
              let schedule = this.schedule(currentDate.format('YYYY-MM-DD'))
              dateList[index] = {
                key: dayCount,
                dayNumber: dayCount,
                date: year + "-" + month  + "-" + dayCount,
                blank: false,
                today: currentDate.format('YYYYMMDD') == moment().format('YYYYMMDD'), 
                additional: false,
                weekDay: d,
                moment: currentDate,
                schedule: schedule,
              };
              dayCount++
            }
            index++
          }
        }

/*
        for (let w = 0; w < 6; w++) {
          for (let d = 0; d < 7; d++) {
            const currentDate = moment([year, month - 1, dayCount])
            if (w == 0 && d < startDay) {
              // 1行目で1日の曜日の前
              dateList[index] = {}
            } else if (dayCount > endDayCount) {
              // 末尾の日数を超えた
              dateList[index] = {}
            } else {
              let schedule = this.schedule(currentDate.format('YYYY-MM-DD'))
              dateList[index] = {
                key: dayCount,
                dayNumber: dayCount,
                date: year + "-" + month  + "-" + dayCount,
                blank: false,
                today: currentDate.format('YYYYMMDD') == moment().format('YYYYMMDD'), 
                additional: false,
                weekDay: d,
                moment: currentDate,
                schedule: schedule,
              };
              dayCount++
            }
            index++
          }
        }
*/
        //console.log(dateList)
        return dateList.filter( () => {
          return true
        })
      },
    },
    methods: {
    },
    filters: {
    }
}
</script>

<style lang="scss" scoped>
$font-weight-base: 300;
$font-size: 1.125em;
$line-height: 1.3;

body {
  font-weight: $font-weight-base;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  font-size: $font-size;
  line-height: $line-height;
}

.b-calendar {
  display: flex;
  align-items: center;
  margin: 2.5em 0;
  &__information {
    background-color: rgba(0, 123, 255, 0.2);
    border-radius: 1.2rem 0 0 1.2rem;
    height: 100%;
    .today {
      flex-direction: column;
      padding-top: 3em;
      .weekDay {
        font-size: 1.2em;
        font-weight: 100;
        padding-bottom: 0.5em;
      }
      .day {
        font-size: 5.5em;
        font-weight: 600;
        line-height: 1;
      }
      .month {
        font-size: 2em;
        font-weight: 200;
        line-height: 1;
      }
    }
  }
  &__calendar {
      min-height: 40rem;
  }
  &__header {
    margin-bottom: 2rem;
    .month {
      font-size: 1.25em;
      font-weight: 200;
      text-transform: capitalize;
    }
    .year {
      font-size: 1.5em;
      font-weight: 600;
      margin-bottom: 1rem;
    }
    .arrow {
      background: transparent;
      border: 1px solid rgba(0, 0, 0, 0.1);
      border-radius: 50%;
      color: #000;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 2.5rem;
      width: 2.5rem;
      &:hover {
        cursor: pointer;
      }
      &-left {
        i {
          transform: translateX(-10%);
        }
      }
      &-right {
        i {
          transform: translateX(10%);
        }
      }
    }
  } 
  &__weekdays {
    display: flex;
    margin-bottom: 1.25rem;
    .weekday {
      width: calc(100% / 7);
      padding: 0.25rem 0.5rem;
    }
  }
  &__dates {
    display: flex;
    flex-wrap: wrap;
    position: relative;
    &:after {
      content: "";
      position: absolute;
      bottom: 0;
      background-color: #fff;
      height: 1px;
      width: 100%;
      z-index: 1;
    }
    .date {
      border-right: 1px solid rgba(0, 0, 0, 0.05);
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      font-weight: 200;
      min-height: 4.5rem;
      padding: 0.25rem 0.5rem;
      position: relative;
      width: calc(100% / 7);
      &.blank {
        background-color: rgba(0, 0, 0, 0.02);
        color: rgba(0, 0, 0, 0.2);
      }
      &.no-border-right {
        border-right: none;
      }
      &.today {
        background-color: rgba(0, 123, 255, 0.2);
      }
      .weekday {
        display: none;
      }
      .additional {
        font-size: 0.75em;
        position: absolute;
        bottom: 0.25rem;
        left: 0.5rem;
        .year {
          padding-right: 0.25rem;
          font-size: 0.75em;
        }
      }
      .title {
        font-size: 0.7em;
      }
    }
  }
}

.b-footer {
  padding: 15px 0;
}

@media (max-width: 768px) {
  .b-calendar__information {
    min-height: auto;
    padding-top: 2rem;
    padding-bottom: 2rem;
    border-radius: 2.5rem 2.5rem 0 0;
    .today {
      padding-top: 0;
    }
  }
}

@media (max-width: 480px) {
  .b-calendar {
    &__weekdays {
      display: none;
    }
    &__dates {
      .date {
        width: 100%;
        text-align: left !important;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        &.blank {
          display: none;
        }
        .weekday {
          display: block;
          margin-left: 0.25rem;
        }
      }
    }
  }
}

</style>