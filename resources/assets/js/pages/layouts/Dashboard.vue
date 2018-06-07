<template>
    <div id="box" :class="{'sidebar-off': sidebarOff}">
        <sidebar></sidebar>
        <div class="app-content">
            <top-header></top-header>
            <div class="main-content">
                <!--BREADCRUMBS-->
                <div class="breadcrumb-wrapper">
                    <h4 class="title">首页</h4>
                    <el-breadcrumb separator="/" class="breadcrumb">
                        <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                        <el-breadcrumb-item>活动管理</el-breadcrumb-item>
                        <el-breadcrumb-item>活动列表</el-breadcrumb-item>
                        <el-breadcrumb-item>活动详情</el-breadcrumb-item>
                    </el-breadcrumb>
                </div>
                <!--CONTENT-->
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TopHeader from './partials/Header';
    import Sidebar from './partials/Sidebar';

    export default {
        data() {
            return {
                // user: User
            }
        },
        computed: {
            sidebarOff() {
                return this.$store.state.sidebarCollapsed
            }
        },
        mounted() {
            this.$http.post('/home/me')
                .then((response) => {
                    this.$store.dispatch('storeMe', response.data.data)
                })
        },
        components: {
            Sidebar,
            TopHeader
        }
    }
</script>

<style lang="scss">
    #box {
        height: auto;
        min-height: 100%;
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .app-content {
        height: 100%;
        .main-content {
            .breadcrumb-wrapper {
                background-color: #ffffff;
                border-bottom: 1px solid rgba(0, 0, 0, 0.07);
                position: relative;
                padding: 15px 35px;
                margin: 0 -15px;
                .breadcrumb {
                    background-color: transparent;
                    padding: 0;
                    display: inline-block;
                    position: absolute;
                    right: 35px;
                    top: 50%;
                    margin: -10px 0 0;
                    float: right;
                }
                h4 {
                    color: #888;
                }
            }
        }
    }

    @media (min-width: 992px) {
        #box {
            padding-top: 60px;
        }
        .main-content {
            margin-left: 220px;
            margin-top: 0;
            transition: margin-left .5s;
            min-height: 100%;
        }
        .main-content:before, .main-content:after {
            content: " ";
            display: table;
        }
    }

    @media (max-width: 991px) {
        .sidebar-off {
            position: fixed !important;
            height: 100%;
            .app-content {
                overflow: hidden;
                position: absolute;
                transform: translate3d(260px, 0, 0);
                transition: transform 300ms ease 0s;
            }
        }
        .app-content {
            transition: transform 300ms ease 0ms;
            height: 100%;
            width: 100%;
            position: relative;
            z-index: 2;
        }

    }
</style>