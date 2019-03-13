<template>
    <div>
      <loading v-if="loading" class="loading"></loading>
      <div v-if="showAlert" class="error">
        <p>情報の取得に失敗しました。</p>
      </div>
      <div v-if="detail" class="content">
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
        <div style="margin:2em;">
          <p>付帯事項、お問い合わせ</p>
          <ul v-for="(comment, index) in comments" :key="index">
            <li>{{comment.created_at}} {{commentTarget(comment.flow)}} - {{comment.contents}}</li>
          </ul>
          <div>
            <b-form @submit.prevent="postComment">
              <input id="schedule_id" type="hidden" :value="commentForm.schedule_id" />
              <input id="flow" type="hidden" :value="commentForm.flow" />
              <b-form-group
                id="exampleInputGroup1"
                label=""
                label-for="contents"
                description=""
              >
              <b-form-input
                id="contents"
                type="text"
                v-model="commentForm.contents"
                required
                placeholder="付帯事項、お問い合わせ等があれば内容をご記入ください。" />
              </b-form-group>
              <b-button type="submit" variant="primary">送信</b-button>
            </b-form>
          </div>
        </div>
        <b-row>
          <b-col>
            <router-link to="/">
              <b-button>戻る</b-button>
            </router-link>
            <b-button v-if="status === 'なし'" id="myButton" variant="success" @click="postReserve(null, 'app_r')">予約する</b-button>
            <b-button v-if="status === '予約済' || status === '予約申請中'" variant="warning" @click="postReserve(reserve_id, 'app_c')">予約をキャンセル</b-button>
          </b-col>
        </b-row>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      loading: true,
      showAlert: false,
      detail: null,
      commentForm: {
        schedule_id: null,
        flow: 'user_to_tenant',
        contents: '',
      },
    }
  },
  computed: {
    status: function() {
      if(Array.isArray(this.detail.reserves) && this.detail.reserves.length > 0) {
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
    reserve_id: function() {
      if(Array.isArray(this.detail.reserves) && this.detail.reserves.length > 0) {
        return this.detail.reserves[0].id
      } else {
        return null
      }
    },
    comments: function() {
      if(this.detail) {
        if(Array.isArray(this.detail.comments) && this.detail.comments.length > 0) {
          return this.detail.comments
        } else {
          return false
        }
      } else {
        return false
      }
    },
    commentTarget: function() {
      return function(flow) {
        if(flow === 'user_to_tenant') {
          return this.$store.getters['auth/username'] + '様から' + this.$store.getters['appdata/tenantName'] + 'へ'
        } else {
          return this.$store.getters['appdata/tenantName'] + 'から' + this.$store.getters['auth/username'] + '様へ'
        }
      }
    },
  },
  mounted() {
    this.fetchData()
  },
  methods: {
    fetchData() {
      window.axios.get('/api/schedule/daily/'+this.$route.params.year+'/'+this.$route.params.month+'/'+this.$route.params.day)
      .then( response => {
        //this.$set(this, 'detail', response.data.schedules)
        this.detail = response.data.schedules
        this.commentForm.schedule_id = this.detail.id
        //console.log(this.detail)
      }).finally(() => {
        this.loading = false
      })
    },
    postComment() {
      const self = this
      this.loading = true
      this.showAlert = false
      let url = '/api/comment/save'
      window.axios.post(url, this.commentForm)
      .then(function (response) {
        self.$set(self.detail, 'comments', response.data.comments)
        self.$set(self.commentForm, 'contents', '')
        self.commentForm.contents = ''
      }).catch(function (error) {
        self.showAlert = true
      }).finally(() => {
        self.loading = false
      })
    },
    postReserve(id, status) {
      const self = this
      this.loading = true
      this.showAlert = false
      let url = '/api/schedule/reserve'
      const data = {reserve_id: id, schedule_id: this.detail.id, leave_school_time: null, status: status}
      this.$set(this, 'detail', null)
      window.axios.post(url, data)
      .then(function (response) {
      }).catch(function (error) {
        console.log(error)
        self.showAlert = true
      }).finally(() => {
        self.fetchData()
        self.loading = false
      })
    },
  }
}
</script>

<style lang="scss" scoped>

</style>