<template>
    <div>
        <p v-show="loading" class="loader">Now loading...</p>
        <p v-show="isError">情報の取得に失敗しました。</p>
        <h1>詳細</h1>
    </div>
</template>

<script>
    export default {
        data() {
          return {
            loading: true,
            isError: false,
            detail: {}
          }
        },
        mounted() {
            axios.get('/api/schedule/daily/'+this.$route.params.year+'/'+this.$route.params.month+'/'+this.$route.params.day)
                .then( response => {
                    this.detail = response.data;
                    this.loading = false;
                });
        }
    }
</script>