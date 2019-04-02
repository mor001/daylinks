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
            <td>{{ reserve_status }}</td>
          </tr>
        </table>
        <div style="margin:2em;">
          <p>付帯事項、お問い合わせ</p>
          <ul v-for="(contact, index) in contacts" :key="index">
            <li>[{{contact.created_at}}] {{contact.contents}}</li>
          </ul>
          <div>
            <b-form @submit.prevent="postContact">
              <input id="schedule_id" type="hidden" :value="contactForm.schedule_id" />
              <input id="flow" type="hidden" :value="contactForm.flow" />
              <b-form-group
                id="exampleInputGroup1"
                label=""
                label-for="contents"
                description=""
              >
              <b-form-input
                id="contents"
                type="text"
                v-model="contactForm.contents"
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
            <template v-if="canReserve === false">
              <p>締切されました。</p>
            </template>
            <template v-else>
              <b-button v-if="reserve_status === 'なし'" id="myButton" variant="success" @click="postReserve(null, 'app_r')">予約する</b-button>
              <b-button v-if="reserve_status === '予約済' || reserve_status === '予約申請中'" variant="warning" @click="postReserve(reserve_id, 'app_c')">予約をキャンセル</b-button>
            </template>
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
      contactForm: {
        user_id: this.$store.getters['auth/user'].id,
        schedule_id: null,
        flow: 'user_to_tenant',
        contents: '',
      },
    }
  },
  computed: {
    canReserve: function() {
      if(this.detail.status === 'open') {
        if(moment().isBefore(moment(this.detail.date), 'day')) {
          return true
        } else {
          return false
        }
      } else {
        return false
      }
    },
    reserve_status: function() {
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
    contacts: function() {
      if(this.detail) {
        if(Array.isArray(this.detail.contacts) && this.detail.contacts.length > 0) {
          return this.detail.contacts
        } else {
          return false
        }
      } else {
        return false
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
        this.contactForm.schedule_id = this.detail.id
        //console.log(this.detail)
      }).finally(() => {
        this.loading = false
      })
    },
    postContact() {
      const self = this
      this.loading = true
      this.showAlert = false
      let url = '/api/contact/save'
      window.axios.post(url, this.contactForm)
      .then(function (response) {
        self.$set(self.detail, 'contacts', response.data.contacts)
        self.contactForm.contents = ''
      }).catch(function (error) {
        self.showAlert = true
      }).finally(() => {
        self.loading = false
      })
    },
    async postReserve(id, status) {
      let msg = ''
      let ret = false
      if(id == null) {
        msg = '予約申請を行います。よろしいですか？'
      } else {
        msg = '予約キャンセル申請を行います。よろしいですか？'
      }
      const options = {title: '確認', size: 'lg', okLabel: 'OK', cancelLabel: 'キャンセル'}
      await this.$dialogs.confirm(msg, options)
      .then(res => {
        ret = res.ok // {ok: true|false|undefined}
      })
      if(ret !== true) return
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