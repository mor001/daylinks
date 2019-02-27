<template>
    <div>
        <p v-show="loading" class="loader">Now loading...</p>
        <p v-show="isError">情報の取得に失敗しました。</p>
        <h1>詳細</h1>
        <table>
            <tr>
                <th>日付</th>
                <td>{{ detail.date }}</td>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>{{ detail.title }}</td>
            </tr>
            <tr>
                <th>説明</th>
                <td>{{ detail.description }}</td>
            </tr>
            <tr>
                <th>登録日</th>
                <td>{{ detail.created_at }}</td>
            </tr>
        </table>
        <RouterLink class="button button--link" v-bind:to="'/'+this.$route.params.year+'/'+this.$route.params.month">戻る</RouterLink>
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
    window.axios.get('/api/schedule/daily/'+this.$route.params.year+'/'+this.$route.params.month+'/'+this.$route.params.day)
    .then( response => {
      this.detail = response.data.data;
      this.loading = false;
    });
  }
}
</script>