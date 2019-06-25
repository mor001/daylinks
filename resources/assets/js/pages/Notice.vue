<template>
  <div id="tab">
    <div v-show="loading" class="loader">読み込み中...</div>
    <ul class="tabMenu">
      <li @click="isSelect('1')">お知らせ</li>
      <li @click="isSelect('2')">お問合せ</li>
    </ul>
    <div class="tabContents">
      <div v-if="isActive === '1'">
        <template v-if="notices">
          <ul v-for="(notice, index) in notices" :key="index">
            <li>[{{notice.created_at}}] {{notice.contents}} <a href="#" @click="readNotice(notice)">{{ readLabel(notice) }}</a></li>
          </ul>
        </template>
      </div>
      <div v-else-if="isActive === '2'">
        <template v-if="contacts && contacts.length > 0">
          <div v-for="(contact, index) in contacts" :key="index">
            <p>[{{contact.created_at}}] {{contact.contents}} 返信:{{contact.replies.length}}件 <a v-if="contact.is_read === 0" href="#" @click="readContacts(contact)">{{ readLabel(contact) }}</a></p>
            <p v-for="(reply, index) in contact.replies" :key="index">
              [{{reply.created_at}}] {{reply.contents}}
            </p>
          </div>
        </template>
        <template v-else>
          <p>未読のお問い合わせはありません。<span><a href="#" @click="fetchContact(true)">全て表示する</a></span></p>
        </template>
      </div>
    </div>

  </div>
</template>

<script>
  export default {
    data() {
      return {
        notices: null,
        contacts: null,
        showAlert: false,
        alertMessage: '',
        loading: true,
        isActive: '1'
      }
    },
    components: {
    },
    methods: {
      fetchNotice (getAll = false) {
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''
        let url = ''
        getAll === false ? url = '/api/notice' : url = '/api/notice/all'
        window.axios.get(url)
        .then( (response) => {
          if(response.data.notices.length <= 0) {
            //this.showAlert = true
            //this.alertMessage = 'データが存在しませんでした。'
          }
          this.$set(this, 'notices', response.data.notices)
          //self.$set(this, 'contacts', response.data.contacts)
        }).catch( (error) => {
          console.log(error.response)
          this.showAlert = true
          this.alertMessage = 'データ取得に失敗しました。'
        }).finally( () => {
          this.loading = false
        })
      },
      fetchContact (getAll = false) {
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''
        let url = ''
        getAll === false ? url = '/api/contact/general' : url = '/api/contact/general/all'
        window.axios.get(url)
        .then( (response) => {
          this.$set(this, 'contacts', response.data.contacts)
        }).catch( (error) => {
          console.log(error.response)
          this.showAlert = true
          this.alertMessage = 'データ取得に失敗しました。'
        }).finally( () => {
          this.loading = false
        })
      },
      readNotice (notice) {
        this.loading = true
        this.showAlert = false
        this.$set(this, 'notices', null)
        let url = '/api/notice/read'
        window.axios.post(url, notice)
        .then( (response) => {
          this.$set(this, 'notices', response.data.notices)
        }).catch( (error) => {
          this.showAlert = true
        }).finally( () => {
          this.loading = false
        })
      },
      readContacts (contact) {
        this.loading = true
        this.showAlert = false
        this.$set(this, 'contacts', null)
        let url = '/api/contact/read'
        window.axios.post(url, contact)
        .then( (response) => {
          console.log(response.data)
          this.$set(this, 'contacts', response.data.contacts)
        }).catch( (error) => {
          this.showAlert = true
        }).finally( () => {
          this.loading = false
        })
      },
      isSelect (num) {
        this.isActive = num;
      },
    },
    mounted() {
      this.fetchNotice()
      this.fetchContact()
    },
    computed: {
      readLabel() {
        return (obj) => {
          if(obj.is_read === 1) {
            return '既読'
          } else {
            return '既読にする'
          }
        }
      },
    },
  }
</script>

<style lang="scss" scoped>
$green: #007db9;
$white: #fff;
#tab {
  width: 100%;
  margin: 40px auto;
  .tabMenu {
    padding-left: 0px;
    display: flex;
    margin-bottom: 0px;
    li {
      list-style-type: none;
      width: auto;
      padding: 10px 20px;
      color: $white;
      border-right: 1px solid $white;
      background-color: $green;
      cursor: pointer;
            
      &:last-child {
        border-right: none;
      }
    }
  }
  .tabContents {
    width: 100%;
    padding: 20px;
    border: 1px solid $green;
    h2 {
      margin: 0 0 10px 0;
      font-size: 20px;
      font-weight: bolder;
    }
  }
}
</style>