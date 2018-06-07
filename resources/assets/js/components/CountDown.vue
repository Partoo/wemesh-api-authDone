<template>
    <button class="button green" :disabled="disabled" id="getAuthcode" @click.prevent="getAuthcode($event)">
        <slot>获取验证码</slot>
    </button>
</template>
<script>
    import {countdown} from '../plugins/helper'

    export default {
        props: {
            duration: {
                default: 60
            },
            color: {
                default: 'green'
            },
            type: {
                default: 'null'
            },
            mobile: {
                required: true
            }
        },
        data() {
            return {
                disabled: false,
            }
        },
        methods: {
            getAuthcode(e) {
                this.disabled = true;
                countdown(e.target, this.duration, '后重发');
                this.$http.get('getSms', {
                    params: {
                        mobile: this.mobile,
                        content: 'auth',
                        type: this.type
                    }
                })
                    .then((response) => {
                        this.$message({
                            message: response.data,
                            type: 'success'
                        })
                    })
                // axios.post('/getSmsCode', {mobile: this.mobile})
                //     .then((response) => {
                //         this.$message({
                //             message('短信已成功发送，请查收');
                //     })
                //     })
                //     .catch(() => {
                //         this.$message({
                //             message('error');
                //     })
                //     })
            }
        }
    }
</script>