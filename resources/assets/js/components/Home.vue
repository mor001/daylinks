<template>
    <div>
        <p v-show="loading" class="loader">Now loading...</p>
        <p v-show="isError">情報の取得に失敗しました。</p>
        <h1>ホーム</h1>
        <ul id="example-1">
          <li v-for="rec in mylist.data" :key = "rec.id">
            <a v-bind:href="detailUrl(rec.date)">{{ rec.date }}</a> - {{ rec.title }}
          </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
          return {
            loading: true,
            isError: false,
            mylist: {},
            y: 0,
            m: 0,
            d: 0
          }
        },
        mounted() {
            const self = this;
            axios.get('/api/schedule/monthly/2019/02')
                .then( response => {
                    this.mylist = response.data;
                    this.y = response.data.y;
                    this.m = response.data.m;
                    this.loading = false;
                });
        },
        computed : {
            detailUrl: function () {
                self = this;
                return function (date) {
                    var arr = date.split('-');
                    return '/detail/'+arr[0]+'/'+arr[1]+'/'+arr[2];
                };
            }
        },
    }
</script>