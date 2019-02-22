import * as CONSTS from './const';

export const Common = {
    methods: {
        goError(status) {
            if(status == CONSTS.INTERNAL_SERVER_ERROR) {
                this.$router.push({path: '/500'});
                return false;
            }
            if(status == CONSTS.UNAUTHENTICATED_ERROR) {
                this.$router.push({path: '/login'});
                return false;
            }
        }
    }
}
