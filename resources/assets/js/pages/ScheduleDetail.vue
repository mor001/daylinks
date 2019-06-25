<template>
  <div>
    <div v-show="loading" class="loader">読み込み中...</div>
    <div v-if="showAlert" class="error">
      <p>情報の取得に失敗しました。</p>
    </div>
    <div v-if="detail" id="main_contents">
      <article class="container">
        <div class="common_cnt">
          <h2>{{$store.getters['appdata/tenantName']}}</h2>
        </div>
        <div class="detail_wrap">
          <h3>
            <span class="month">{{this.$route.params.month}}月</span>
            <span class="date">{{this.$route.params.day}}<span class="date_list_type">日</span></span>
            <span class="day">X曜日</span>
          </h3>
          <div class="detail_cnt">
            <div class="inner">
              <h4 class="main_title">{{detail.title}}</h4>
              <div class="text_box">
                <p>
                  {{ detail.description }}
                </p>
              </div>
              <!--****************************************************************
                main_titleにクラス名をつける
                予約申請中 : "reserve_info"          予約済み："reserve_success"
                キャンセル申請中："reserve_warning"  キャンセル済："reserve_danger"
              ********************************************************************-->
              <h4 class="main_title reserve_info"><span>ステータス  ：  </span><span>{{ reserve_status }}</span></h4>
            </div>
            <div class="chat_wrap">
              <h4>お知らせ、お問い合わせ</h4>
              <div class="inner" v-for="(contact, index) in contacts" :key="index">
                <div v-bind:class="{ 'mycomment': contact.destination === '0', 'facility_cnt': contact.destination === '1' }">
                  <div class="chatting">
                    <div class="says">
                      <p>{{contact.contents}}</p>
                      <span class="time">{{contact.created_at}}</span>
                    </div>
                  </div>
                </div>
              </div><!--.inner-->
            </div><!--.chat_wrap-->
            <div class="comment_wrap">
              <div class="mycomment">
                <div class="chatting">
                  <div class="says">
                    <form @submit.prevent="postContact">
                      <div class="textarea_wrap">
                          <input id="schedule_id" type="hidden" :value="contactForm.schedule_id" />
                          <input id="destination" type="hidden" :value="contactForm.destination" />
                          <textarea id="contents" class="textlines" v-model="contactForm.contents" placeholder="お問い合わせ・連絡事項などを入力して送信ボタンをクリックしてください。"></textarea>
                      </div>
                      <div class="submit_wrap">
                        <button type="submit" value="送信する"><i class="fas fa-envelope fa-fw fa-lg"></i>送信する</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="btn_cnt">
            <div class="btn">
              <router-link to="/"><button type="submit" class="back" value="戻る"><i class="fas fa-undo-alt fa-fw"></i>戻る</button></router-link>
            </div>
            <template v-if="canReserve === false">
              <p>締切されました。</p>
            </template>
            <template v-else>
              <div class="btn" v-if="reserve_status === 'なし'">
                <button type="submit" class="reserve_info" value="予約する" @click="postReserve(null, 'app_r')">予約する</button>
              </div>
              <div class="btn" v-if="reserve_status === '予約済' || reserve_status === '予約申請中'">
                <button type="submit" class="reserve_warning" value="予約をキャンセル" @click="postReserve(reserve_id, 'app_c')">予約をキャンセル</button>
              </div>
            </template>
          </div>
        </div><!--.detail_wrap-->
      </article><!--.container-->
    </div><!--#main_contents-->
    <div v-else id="main_contents">
      <article class="container">
        <div class="common_cnt">
          <h2>{{$store.getters['appdata/tenantName']}}</h2>
        </div>
        <div class="detail_wrap">
          <p>予定が登録されていません。</p>
        </div><!--.detail_wrap-->
      </article><!--.container-->
    </div><!--#main_contents-->
  </div>
</template>

<script>
import DialogHelper from '../helper/DialogHelper';
export default {
  data() {
    return {
      loading: true,
      showAlert: false,
      detail: null,
      contactForm: {
        user_id: this.$store.getters['user/user'].id,
        schedule_id: null,
        destination: '0',
        contents: '',
      },
    }
  },
  computed: {
    canReserve() {
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
    reserve_status() {
      if(this.detail.reserve) {
        if(this.detail.reserve.status === 'app_r') {
          return '予約申請中'
        } else if(this.detail.reserve.status === 'reserved') {
          return '予約済'
        } else if(this.detail.reserve.status === 'app_c') {
          return 'キャンセル申請中'
        } else if(this.detail.reserve.status === 'canceled') {
          return 'キャンセル済'
        } else {
          return this.detail.reserve.status
        }
      } else {
        return 'なし'
      }
    },
    reserve_id() {
      if(this.detail.reserve) {
        return this.detail.reserve.id
      } else {
        return null
      }
    },
    contacts() {
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
        if(response.data.schedules) {
          console.log(response.data)
          //this.$set(this, 'detail', response.data.schedules)
          this.detail = response.data.schedules
          this.contactForm.schedule_id = this.detail.id
        }
      }).finally(() => {
        this.loading = false
      })
    },
    postContact() {
      this.loading = true
      this.showAlert = false
      let url = '/api/contact/save'
      window.axios.post(url, this.contactForm)
      .then( (response) => {
        this.$set(this.detail, 'contacts', response.data.contacts)
        this.contactForm.contents = ''
      }).catch( (error) => {
        this.showAlert = true
      }).finally( () => {
        this.loading = false
      })
    },
    async postReserve(id, status) {
      let message = ''
      let ret = false
      if(id == null) {
        message = '予約申請を行います。よろしいですか？'
      } else {
        message = '予約キャンセル申請を行います。よろしいですか？'
      }
      await DialogHelper.showDialog(this, {
        subject: '確認',
        message: message,
        primaryLabel: 'ええで',
        secondaryLabel: 'やっぱやめとくわ',
        ok: () => { ret = true },
        cancel: () => { }
      })
      console.log('戻り値: '+ret)
      if(ret !== true) return
      this.loading = true
      this.showAlert = false
      let url = '/api/schedule/reserve'
      const data = {reserve_id: id, schedule_id: this.detail.id, leave_school_time: null, status: status}
      this.$set(this, 'detail', null)
      window.axios.post(url, data)
      .then( (response) => {
      }).catch( (error) => {
        console.log(error)
        this.showAlert = true
      }).finally( () => {
        this.fetchData()
        this.loading = false
      })
    },
  }
}
</script>

<style lang="scss" scoped>

</style>