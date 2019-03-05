<template>
  <div class="calendar">
    <ul id="example-1">
      <li v-for="rec in schedules" :key = "rec.id">
        <router-link v-bind:to="detailUrl(rec.date)">{{ rec.date }}({{rec.day_of_week}})</router-link> - {{ rec.title }}
      </li>
    </ul>

    <div class="b-calendar__calendar">
      <div class="b-calendar__weekdays">
        <div class="weekday" v-for="(day, index) in days" :key="index">
          <strong>{{day}}</strong>
        </div>
      </div>
      <div class="b-calendar__dates">
        <div class="date text-right" :class="{'today': date.today, 'blank': date.blank, 'no-border-right': date.key % 7 === 0, }"
             v-for="date in dateList(year, month)" :key="date.key" :data-date="date.date" @click="setSelectedDate(date.moment)">
          <span class="day">{{date.dayNumber}}</span>
          <span class="weekday">{{date.weekDay}}</span>
          <div class="additional" v-show="date.additional">
            <span class="year" v-show="date.additional.year">{{date.additional.year}}</span>
            <span class="month" v-show="date.additional.month">{{date.additional.month}}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import CalendarDay from '../components/CalendarDay'
  export default {
    data() {
      console.log('Calendar.vue data')
      return {
        today: moment(),
        dateContext: moment([this.$store.getters['appdata/currentYear'], this.$store.getters['appdata/currentMonth'] - 1, 1]),
        selectedDate: moment(),
        days: ["月", "火", "水", "木", "金", "土", "日"],
      }
    },
    mounted() {
      console.log('Calendar.vue mounted')
    },
    updated() {
      console.log('Calendar.vue updated')
      console.log('カレンダー内: ' + this.year + '-' + this.month)
    },
    props: [
      'schedules', 'currentYear', 'currentMonth'
    ],
    components: {
      CalendarDay,
    },
    computed: {
      detailUrl: function() {
        return function (date) {
          const arr = date.split('-')
          return '/detail/'+arr[0]+'/'+arr[1]+'/'+arr[2]
        }
      },
      /*
      dateContext: function() {
        if(!this.currentYear && !this.currentMonth) {
          return moment([this.currentYear, this.currentMonth, 1])
        }else {
          return moment()
        }
      },
      */
      year: function() {
        return this.currentYear
        //return this.dateContext.format("YYYY");
      },
      month: function() {
        return this.currentMonth
        //return this.dateContext.format("MM");
      },
      daysInMonth: function() {
        return this.dateContext.daysInMonth();
      },
      currentDate: function() {
        return this.dateContext.get("date");
      },
      firstDayOfMonth: function() {
        let firstDay = moment(this.dateContext).subtract(this.currentDate,"days");
        return firstDay.weekday();
      },
      previousMonth: function() {
        return moment(this.dateContext).subtract(1, "month");
      },
      previousMonthAsString: function() {
        return this.previousMonth.format("MMMM");
      },
      nextMonth: function() {
        return moment(this.dateContext).add(1, "month");
      },
      nextMonthAsString: function() {
        return this.nextMonth.format("MMMM");
      },
      daysInPreviousMonth: function() {
        return this.previousMonth.daysInMonth();
      },
      daysFromPreviousMonth: function() {
        let daysList = [];
        let count = this.daysInPreviousMonth - this.firstDayOfMonth;
        while (count < this.daysInPreviousMonth) {
          count++;
          daysList[count] = count;
        }
        return daysList.filter(function() {
          return true;
        });
      },
      
        initialDate: function() {
          return this.formattingDay(this.today.get("date"));
        },
        initialMonth: function() {
          return this.today.format("MMMM");
        },
        initialYear: function() {
          return this.today.format("Y");
        },
        todayInCurrentMonthAndYear: function() {
          return (
                this.month === this.initialMonth &&
                this.year === this.initialYear
            );
        },
        selectedDayAndMonth: function() {
            let dayAndMonth = this.selectedDate.format("D MMMM");
            dayAndMonth = dayAndMonth.split(" ");
            dayAndMonth = {
                day: dayAndMonth[0],
                month: dayAndMonth[1]
            };

            return dayAndMonth;
        },
        selectedWeekDay: function() {
            return this.selectedDate.format("dddd");
        },
        todayIsEqualSelectDate: function() {
            return (
                this.selectedDate.format("YYYYMMDD") ===
                this.today.format("YYYYMMDD")
            );
        }      
    },
    methods: {
      addMonth: function() {
        this.dateContext = this.nextMonth;
      },
      subtractMonth: function() {
        this.dateContext = this.previousMonth;
      },
      setSelectedDate: function(moment) {
        this.selectedDate = moment;
      },
      goToday: function() {
        this.selectedDate = this.today;
        this.dateContext = this.today;
      },
      formattingDay(day) {
        return ("0" + day).slice(-2);
      },
      getWeekDay(day) {
        let index = day;
        if (index > 7) {
          index %= 7;
        }
        index = index === 0 ? 6 : index - 1;
          return this.days[index];
      },
      dateList(y, m) {
        //this.dateContext = moment([this.year, this.month - 1, 1]);
        if(!y && !m) {
          return true;
        }
        let $this = this;
        let dateList = [];
        let previousMonth = this.previousMonth;
        let nextMonth = this.nextMonth;
        //this.dateContext = moment([y, m - 1, 1])
        let dateContext2 = moment([y, m - 1, 1])
        console.log('★ dateList内: ' + dateContext2.format("YYYY-MM-DD"))

        //dates for display
        let formattedCurrentMonth = dateContext2.format("MM");
        let formattedCurrentYear = dateContext2.format("Y");
        let formattedPreviousMonth = previousMonth.format("MM");
        let formattedPreviousYear = previousMonth.format("Y");
        let formattedNextMonth = nextMonth.format("MM");
        let formattedNextYear = nextMonth.format("Y");

        //counters
        let countDayInCurrentMonth = 0;
        let countDayInPreviousMonth = 0;

        //filling in dates from the previous month
        this.daysFromPreviousMonth.forEach(function(dayFromPreviousMonth) {
          countDayInCurrentMonth++;
          countDayInPreviousMonth++;
          let formattedDay = $this.formattingDay(dayFromPreviousMonth);
          let previousMonth = $this.daysFromPreviousMonth.length === countDayInPreviousMonth ? $this.previousMonthAsString : false;
          let previousYear = formattedCurrentYear !== formattedPreviousYear && $this.daysFromPreviousMonth.length === countDayInPreviousMonth
                        ? formattedPreviousYear
                        : false;
          let additional = {
            month: previousMonth,
            year: previousYear
          };
 
          if (!previousMonth && !previousYear) {
            additional = false;
          }

          dateList[countDayInCurrentMonth] = {
            key: countDayInCurrentMonth,
            dayNumber: formattedDay,
            date: formattedDay + "." + formattedPreviousMonth + "." + formattedPreviousYear, 
            blank: true,
            today: false,
            additional: additional,
            weekDay: false,
            moment: moment(formattedPreviousYear + formattedPreviousMonth + formattedDay)};
          });

          //filling in dates from the current month
          while (countDayInCurrentMonth < this.firstDayOfMonth + this.daysInMonth) {
            countDayInCurrentMonth++;
            let day = countDayInCurrentMonth - countDayInPreviousMonth;
            let weekDay = this.getWeekDay(countDayInCurrentMonth);
            let formattedDay = this.formattingDay(day);

            dateList[countDayInCurrentMonth] = {
              key: countDayInCurrentMonth,
              dayNumber: formattedDay,
              date: formattedDay + "." + formattedCurrentMonth + "." + formattedCurrentYear,
              blank: false,
              today: formattedDay === this.initialDate && this.todayInCurrentMonthAndYear, 
              additional: false,
              weekDay: weekDay,
              moment: moment(formattedCurrentYear + formattedCurrentMonth + formattedDay)
            };
          }

          let daysInNextMonth = 7 - (countDayInCurrentMonth % 7);
          let countDayInCurrentMonthSaved = countDayInCurrentMonth;
          let day = 0;

          //filling in dates from the next month
          if (daysInNextMonth < 7) {
            while (
              countDayInCurrentMonth <
              countDayInCurrentMonthSaved + daysInNextMonth
            ) {
              countDayInCurrentMonth++;
              day++;
              let formattedDay = this.formattingDay(day);
              let nextMonth = day === 1 ? this.nextMonthAsString : false;
              let nextYear = formattedCurrentYear !== formattedNextYear && day === 1 ? formattedNextYear : false;
              let additional = {
                month: nextMonth,
                year: nextYear
              };
              if (!nextMonth && !nextYear) {
                additional = false;
              }
              dateList[countDayInCurrentMonth] = {
                key: countDayInCurrentMonth,
                dayNumber: formattedDay,
                date: formattedDay + "." + formattedNextMonth + "." + formattedNextYear,
                blank: true,
                today: false,
                additional: additional,
                weekDay: false,
                moment: moment(formattedNextYear + formattedNextMonth + formattedDay)
              };
            }
          }
          return dateList.filter(function() {
            return true;
          });
        },
    },
    filters: {
      capitalize: function(value) {
        if (!value) return "";
        value = value.toString();
        return value.charAt(0).toUpperCase() + value.slice(1);
      }
    }
}
</script>

<style lang="scss" scoped>
$font-family-base: "HelveticaNeue-Light", "Helvetica Neue Light",
    "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
$font-weight-base: 300;
$font-size: 1.125em;
$line-height: 1.3;

body {
    font-family: $font-family-base;
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