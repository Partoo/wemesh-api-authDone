<template>
    <div>
        <h4 class="text-center" style="color:#828282;"><i class="fa fa-user-plus"></i> 用户注册</h4>
        <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label-width="100px"
                 style="margin-bottom: 0">

            <el-form-item label="手机号码" prop="mobile">
                <el-input placeholder="输入您的手机号码" v-model="ruleForm.mobile" requied>
                </el-input>
            </el-form-item>

            <el-form-item label="手机验证" prop="authcode">
                <el-col :span="13">
                    <el-input placeholder="输入收到的验证码" v-model="ruleForm.authcode">
                    </el-input>
                </el-col>
                <el-col :span="10" style="margin-left:10px;">
                    <count-down :mobile="ruleForm.mobile" :disabled="getSmsDisabled" type="register"></count-down>
                </el-col>
            </el-form-item>

            <el-form-item label="指定密码" prop="password">
                <el-input placeholder="指定您的登录密码" type="password" v-model="ruleForm.password" requied>
                </el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="password_confirmation">
                <el-input placeholder="再次输入上面的密码" type="password" v-model="ruleForm.password_confirmation" requied>
                </el-input>
            </el-form-item>
            <el-row>
                <el-col :span="24">
                    <button class="btn btn-block" @click.prevent="submitForm('ruleForm')"><i class="fa fa-sign-in"></i>
                        确认注册
                    </button>
                </el-col>
            </el-row>
            <el-row style="margin-top: 20px">
                <el-col :span="24">
                    <router-link to="login" class="align-right"><i class="fa fa-user-circle"></i>
                        已有账号登录
                    </router-link>
                </el-col>
            </el-row>
        </el-form>
    </div>
</template>

<script>
    import {isMobile} from '../../plugins/helper'
    import CountDown from '../../components/CountDown'

    export default {

        data() {
            let checkPassword = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入密码'));
                } else if (value !== this.ruleForm.password) {
                    callback(new Error('两次密码输入的不一致'))
                } else {
                    callback()
                }
            };
            let checkMobile = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入手机号码'));
                } else if (!isMobile(value)) {
                    callback(new Error('手机格式不正确'));
                    this.getSmsDisabled = true;
                } else {
                    this.getSmsDisabled = false;
                    callback()
                }
            };
            return {
                getSmsDisabled: true,
                ruleForm: {
                    mobile: '',
                    authcode: '',
                    password: '',
                    password_confirmation: ''
                },
                rules: {
                    mobile: {validator: checkMobile, trigger: 'change', required: true},
                    authcode: {required: true, message: '请输入短信验证码', trigger: 'change'},
                    password: {required: true, message: '请输入短信验证码', trigger: 'change'},
                    password_confirmation: {validator: checkPassword, trigger: 'change', required: true}
                }
            }
        },
        methods: {
            submitForm(form) {
                this.$refs[form].validate((valid) => {
                    if (valid) {
                        this.$http.post('/auth/register', this.ruleForm)
                            .then((response) => {
                                this.$alert(response.data.message, '注册成功', {
                                    confirmButtonText: '确定',
                                    type: 'success',
                                    callback: () => {
                                        this.$router.push('login')
                                    }
                                })
                            })
                    } else {
                        return false;
                    }
                })
            }
        },
        components: {
            CountDown
        }
    }
</script>