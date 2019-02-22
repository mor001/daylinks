<template>
  <div>
    <p>システムエラーが発生しました。</p>
    <p>エラーコード: {{ errorCode }} </p>
  </div>
</template>

<script>
export default {
  computed: {
    errorCode () {
      return this.$store.getters['error/code']
    }
  }
}
</script>
