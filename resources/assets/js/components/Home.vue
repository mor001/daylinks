<template>
    <div>
        <p v-show="loading" class="loader">Now loading...</p>
        <p v-show="isError">情報の取得に失敗しました。</p>
        <h1>ホーム</h1>
<p>year:{{y}}</p>
<p>month:{{m}}</p>
        <ul id="example-1">
          <li v-for="rec in mylist.data">
            {{ rec.date }} - {{ rec.title }}
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
            m: 0
          }
        },
        mounted() {
            const self = this;
            axios.get('/api/schedule/monthly/2019/01')
                .then( response => {
                    this.mylist = response.data;
                    this.y = response.data.y;
                    this.m = response.data.m;
                    this.loading = false;
                });
        }
    }
</script>