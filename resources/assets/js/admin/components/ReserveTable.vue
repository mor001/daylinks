<template>
  <div>
    <table>
      <tr>
        <th>
        </th>
        <th style="border:1px solid" v-for="date in reserves" :key="date.key">
          {{date.label}}
        </th>
      </tr>
      <tr v-for="user in this.users" :key="user.key">
        <td>{{user.name}}</td>
        <td style="border:1px solid" v-for="date in reserves" :key="date.key">
          {{status(date.date, user.id)}}
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        days: ["月", "火", "水", "木", "金", "土", "日"],
        checkList: null,
        dateList: [],
        m: this.currentMonth,
      }
    },
    props: {
      reserves: { required: true },
      holidays: { required: true },
      users: { required: true },
      currentYear: { required: true },
      currentMonth: { required: true },
    },
    components: {
    },
    computed: {
      status() {
        return (date, user_id) => {
          for (var i = 0; i < this.reserves.length; i++) {
            const data = this.reserves[i]
            if(data.date === date) {
              if(data.schedule && data.schedule.reserves) {
                for (var j = 0; j < data.schedule.reserves.length; j++) {
                  const reserve = data.schedule.reserves[j]
                  if(reserve.user_id === user_id) {
                    return reserve.status
                  } 
                }
              }
            }
          }
          return ''
        }
      },
      formUrl() {
        return (date) => {
          const arr = date.split('-')
          return '/admin/schedules/form/'+arr[0]+'/'+arr[1]+'/'+arr[2]
        }
      },
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
      holiday() {
        return (date) => {
          for (var i = 0; i < this.holidays.length; i++) {
            const holiday = this.holidays[i]
            if(holiday.date === date) {
              return holiday.title
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
    },
    methods: {
    },
    filters: {
    },
    watch: {
    },
    mounted() {
    },
}
</script>
