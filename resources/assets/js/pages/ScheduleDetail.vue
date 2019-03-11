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
            <tr>
                <th>ステータス</th>
                <td>{{ status }}</td>
            </tr>
        </table>
        <div style="margin:2em;" v-if="comments">
          <p>お知らせ、お問い合わせ</p>
          <ul v-for="(comment, index) in comments" :key="index">
            <li>{{comment.created_at}} {{commentTarget(comment.flow)}} - {{comment.contents}}</li>
          </ul>
          <div>
            <b-form>
              <b-form-group
                id="exampleInputGroup1"
                label="コメント"
                label-for="memo"
                description=""
              >
              <b-form-input
                id="memo"
                type="text"
                required
                placeholder="付随事項、お問い合わせ等があれば内容をご記入ください。" />
              </b-form-group>
              <b-button type="submit" variant="primary">Submit</b-button>
            </b-form>
          </div>
        </div>
        <b-row>
          <b-col>
            <router-link to="/">
              <b-button>戻る</b-button>
            </router-link>
            <router-link to="/">
              <b-button id="myButton" variant="primary">予約する</b-button>
            </router-link>
            <router-link to="/">
              <b-button variant="warning">予約をキャンセル</b-button>
            </router-link>
          </b-col>
        </b-row>
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
  computed: {
    status: function() {
      if(this.detail.reserves) {
        if(this.detail.reserves[0].status === 'app_r') {
          return '予約申請中'
        } else if(this.detail.reserves[0].status === 'reserved') {
          return '予約済'
        } else if(this.detail.reserves[0].status === 'app_c') {
          return 'キャンセル申請中'
        } else if(this.detail.reserves[0].status === 'canceled') {
          return 'キャンセル済'
        } else {
          return this.detail.reserves[0].status
        }
      } else {
        return 'なし'
      }
    },
    comments: function() {
      if(this.detail.reserves) {
        if(this.detail.reserves[0].comments.length > 0) {
          return this.detail.reserves[0].comments
        } else {
          return false
        }
      } else {
        return false
      }
    },
    commentTarget: function() {
      return function (flow) {
        if(flow === 'user_to_tenant') {
          return this.$store.getters['auth/username'] + '様から' + this.$store.getters['appdata/tenantName'] + 'へ'
        } else {
          return this.$store.getters['appdata/tenantName'] + 'から' + this.$store.getters['auth/username'] + '様へ'
        }
      }
    },
  },
  mounted() {
    window.axios.get('/api/schedule/daily/'+this.$route.params.year+'/'+this.$route.params.month+'/'+this.$route.params.day)
    .then( response => {
      this.detail = response.data.schedules
      console.log(this.detail.reserves[0])
    }).finally(() => {
      this.loading = false
    })
  }
}
</script>