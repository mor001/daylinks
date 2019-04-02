<template>
  <div>
    <p>お探しのページは見つかりませんでした。</p>
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
