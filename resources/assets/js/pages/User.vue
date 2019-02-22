<template>
    <div>
        <p v-show="loading" class="loader">Now loading...</p>
        <p v-show="isError">情報の取得に失敗しました。</p>
        <h1>ユーザー情報</h1>
        <table>
            <tr>
                <th>ID</th>
                <td>{{ user.id }}</td>
            </tr>
            <tr>
                <th>ユーザーID</th>
                <td>{{ user.userid }}</td>
            </tr>
            <tr>
                <th>ユーザー名</th>
                <td>{{ user.name }}</td>
            </tr>
            <tr>
                <th>メール</th>
                <td>{{ user.email }}</td>
            </tr>
            <tr>
                <th>登録日</th>
                <td>{{ user.created_at }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    import { Common } from '../common/common'
    export default {
        mixins: [ Common ],
        data () {
            return {
                loading: true,
                isError: false,
                user: {}
            }
        },
        created() {
            axios.get('/api/me').then(res => {
                this.user = res.data;
            }).catch(error => {
                this.goError(error.response.status);
                this.isError = true;
            }).finally(() => this.loading = false) 
        }
    }
</script>