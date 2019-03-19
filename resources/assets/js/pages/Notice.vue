<template>
  <div id="tab">
    <loading v-if="loading" class="loading"></loading>
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
        <template v-if="contacts">
          <ul v-for="(contact, index) in contacts" :key="index">
            <li>[{{contact.created_at}}] {{contact.contents}} <a href="#" @click="readNotice(contact)">{{ readLabel(contact) }}</a></li>
          </ul>
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
      fetch () {
        const self = this
        this.loading = true
        this.showAlert = false
        this.alertMessage = ''
        let url = '/api/notice'
        window.axios.get(url)
        .then(response => {
          if(response.data.notices.length <= 0) {
            //self.showAlert = true
            //self.alertMessage = 'データが存在しませんでした。'
          }
          self.$set(self, 'notices', response.data.notices)
          //self.$set(self, 'contacts', response.data.contacts)
        }).catch(error => {
          console.log(error.response)
          self.showAlert = true
          self.alertMessage = 'データ取得に失敗しました。'
        }).finally(() => {
          self.loading = false
        })

        url = '/api/contact/general'
        window.axios.get(url)
        .then(response => {
          console.log(response.data)
          self.$set(self, 'contacts', response.data.contacts)
        }).catch(error => {
          console.log(error.response)
          self.showAlert = true
          self.alertMessage = 'データ取得に失敗しました。'
        }).finally(() => {
          self.loading = false
        })
      },
      readNotice (notice) {
        const self = this
        this.loading = true
        this.showAlert = false
        self.$set(self, 'notices', null)
        let url = '/api/notice/read'
        window.axios.post(url, notice)
        .then(function (response) {
          console.log(response.data)
          self.$set(self, 'notices', response.data.notices)
        }).catch(function (error) {
          self.showAlert = true
        }).finally(() => {
          self.loading = false
        })
      },
      isSelect (num) {
        this.isActive = num;
      },
    },
    mounted() {
      this.fetch()
    },
    computed: {
      readLabel: function() {
        return function (obj) {
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