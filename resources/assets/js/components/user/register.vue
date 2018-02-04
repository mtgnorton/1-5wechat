<template>
    <transition name="user">
        <div class="user-wrapper" :style="{width:rightWidth/2+'px',right:rightWidth/4+'px'}" v-if="showDialog">
            <el-row>
                <el-col :md="18" :offset="2">
                    <el-form :model="regsiterForm" status-icon :rules="rules2" ref="regsiterForm" label-width="100px" class="demo-ruleForm">
                        <el-form-item label="用户名" prop="name">
                            <el-input v-model="regsiterForm.name"></el-input>
                        </el-form-item>
                        <el-form-item prop="email" label="邮箱">
                            <el-input v-model="regsiterForm.email"></el-input>
                        </el-form-item>
                        <el-form-item label="密码" prop="pass">
                            <el-input type="password" v-model="regsiterForm.password" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="确认密码" prop="password_confirmation">
                            <el-input type="password" v-model="regsiterForm.password_confirmation" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item style="margin-top: 20px">
                            <el-button type="primary" @click="submitForm('regsiterForm')">提交</el-button>
                            <el-button @click="resetForm('regsiterForm')">重置</el-button>
                        </el-form-item>
                    </el-form>
                </el-col>
            </el-row>
        </div>
    </transition>
</template>
<script>
import Bus from '../../bus.js';
import { register } from '../../api'
export default {
    props: ['rightWidth'],
    data() {

        var validatePass = (rule, value, callback) => {
            if (value === '') {
                callback(new Error('请输入密码'));
            } else {
                if (this.regsiterForm.password_confirmation !== '') {
                    this.$refs.regsiterForm.validateField('password_confirmation');
                }
                callback();
            }
        };
        var validatePass2 = (rule, value, callback) => {
            if (value === '') {
                callback(new Error('请再次输入密码'));
            } else if (value !== this.regsiterForm.password) {
                callback(new Error('两次输入密码不一致!'));
            } else {
                callback();
            }
        };
        return {
            regsiterForm: {
                password: '123456',
                password_confirmation: '123456',
                email: '851426308@qq.com',
                name: '马廷广'
            },
            showDialog: true,
            rules2: {
                password: [
                    { required: true, message: '请输入密码', trigger: 'blur' },
                    { validator: validatePass, trigger: 'blur' }
                ],
                password_confirmation: [
                    { required: true, message: '请在此输入密码', trigger: 'blur' },
                    { validator: validatePass2, trigger: 'blur' }
                ],
                email: [
                    { required: true, message: '请输入邮箱地址', trigger: 'blur' },
                    { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur,change' }
                ],
                name: [
                    { required: true, message: '请输入用户名', trigger: 'blur' },
                ]
            }
        };

    },
    mounted() {
        this.eventListners();
    },
    methods: {
        eventListners() {
            Bus.$on(Bus.event.userShow, () => {
                this.showDialog = !this.showDialog;
            })
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    register(this.regsiterForm).then(res => {
                        console.log(res);
                    }).catch(error => {
                        let msg = this.$funs.getErrorMsg(error);
                        this.$notify.error({
                            title: '错误',
                            message: msg,
                            duration: 2000
                        });
                    })
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        resetForm(formName) {
            this.$refs[formName].resetFields();
        }
    }
}
</script>
<style scoped>
.user-wrapper {
    padding-top: 30px;
    height: 400px;
    box-shadow: 0 0 1px 0 rgba(0, 0, 0, .75);
    background: #fff;
    position: fixed;
    width: 600px;
    bottom: 80px;
    right: 0;
    z-index: 10;
}

.user-enter-active {
    transition: all 0.4s ease;
}

.user-leave-active {
    transition: all 0.4s ease;
}

.user-enter,
.user-leave-to {
    height: 0;
}

.user-enter-to,
.user-leave {
    height: 300px;
}
</style>
<style>
.user-wrapper .el-table__header-wrapper {
    display: none;
}
</style>