<template>
  <div class="schedule-day">
    <div class="panel-heading">{{date}}</div>
    <div class="panel-body">{{title}}</div>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
        message: 'hello'
      }
    },
    mounted() {
    },
    props: ['date', 'title'],

  }
</script>

<style lang="scss" scoped>
.schedule-day {
  float: left;
  border: 1px solid rgb(196, 196, 196);
}
</style>