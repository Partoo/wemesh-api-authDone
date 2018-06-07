<template>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-box" v-slimscroll="slim">
            <div class="sidebar-container">
                <div class="nav-user-wrapper fadeInUp">
                    <div class="media btn-transparent">
                        <div class="media-left">
                            <a v-if="profile.avatar===null" class="profile-card-photo" href="#">
                                <img src="/img/default-avatar.jpg" alt="avatar">
                            </a>
                            <a v-else href="#">
                                <img :src="profile.avtar" alt="avatar">
                            </a>
                        </div>
                        <div class="media-body">
                            <span v-if="profile.name === null"
                                  class="media-heading text-white">{{profile.mobile}}</span>
                            <span v-else class="media-heading text-white">{{profile.name}}</span>
                            <div class="text-small text-white-transparent">
                                <a href="#" style="margin: 0;" class="button small">升级为专业版</a>
                            </div>
                        </div>
                        <div class="media-right media-middle">
                            <el-dropdown trigger="click">
                                <span class="btn-transparent">
                                    <i class="fa fa-caret-down"></i>
                                </span>

                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item command="profile"><a href=""><i class="fa fa-user-circle"></i>
                                        个人资料</a>
                                    </el-dropdown-item>
                                    <el-dropdown-item command="message"><a href=""><i class="fa fa-rss"></i> 消息中心</a>
                                    </el-dropdown-item>
                                    <el-dropdown-item command="security"><a href="#"><i class="fa fa-lock"></i> 安全设置</a>
                                    </el-dropdown-item>
                                    <el-dropdown-item command="logout"><a @click.prevent="onLogout"><i
                                            class="fa fa-sign-out"></i>
                                        退出系统</a>
                                    </el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
                        </div>
                    </div>

                </div>
                <!--WEATHER-->
                <div class="nav">
                    <div class="weather">
                        <p v-if="weatherLoaded" class="weather fadeInUp">
                            <a href="" class="btn btn-transparent" style="color: #ccc;">
                                {{weather.date}} {{weather.week}} {{weather.weather}}
                            </a>
                        </p>
                    </div>
                    <el-menu default-active="1-4-1"
                             @open="menuOpen"
                             background-color="#343F4D"
                             text-color="#fff"
                             @close="menuClose">
                        <el-submenu index="1">
                            <template slot="title">
                                <i class="el-icon-location"></i>
                                <span slot="title">导航一</span>
                            </template>
                            <el-menu-item-group>
                                <span slot="title">分组一</span>
                                <el-menu-item index="1-1">选项1</el-menu-item>
                                <el-menu-item index="1-2">选项2</el-menu-item>
                            </el-menu-item-group>
                            <el-menu-item-group title="分组2">
                                <el-menu-item index="1-3">选项3</el-menu-item>
                            </el-menu-item-group>
                            <el-submenu index="1-4">
                                <span slot="title">选项4</span>
                                <el-menu-item index="1-4-1">选项1</el-menu-item>
                            </el-submenu>
                        </el-submenu>
                        <el-menu-item index="2">
                            <i class="el-icon-menu"></i>
                            <span slot="title">导航二</span>
                        </el-menu-item>
                        <el-menu-item index="3" disabled>
                            <i class="el-icon-document"></i>
                            <span slot="title">导航三</span>
                        </el-menu-item>
                        <el-menu-item index="4">
                            <i class="el-icon-setting"></i>
                            <span slot="title">导航四</span>
                        </el-menu-item>
                    </el-menu>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                slim: {
                    height: '100%',
                    color: '#fff'
                },
                weatherLoaded: false,
            }
        },
        methods: {
            fetchWeather() {
                this.$http.get('weather')
                    .then((response) => {
                        this.$store.dispatch('getWeather', response.data.result);
                        this.weatherLoaded = true;
                    })
                    .catch((error) => {
                        this.$message({
                            showClose: true,
                            message: '暂时连接不上天气服务器:' + error
                        })
                    })
            },
            menuOpen(name, path) {
                console.log(name, path);
            },
            menuClose(name, path) {
                console.log(name, path);
            },
            onLogout() {
                this.$http.post('auth/logout')
                    .then(() => {
                        this.$store.dispatch('logout')
                    })
            }
        },
        mounted() {
            this.fetchWeather()
        },
        computed: {
            weather() {
                return this.$store.state.weather
            },
            profile() {
                return this.$store.state.myInfo
            }
        }
    }
</script>

<style lang="scss">

    /*侧边栏关闭*/
    .sidebar-closed #sidebar {
        width: 50px !important;
    }

    #sidebar {
        top: 0;
        left: 0;
        bottom: 0;
        background-color: #343F4E;
        overflow: visible;
        z-index: 1024;

        .sidebar-box {
            margin: 0;
            position: relative;
        }

        .nav-user-wrapper {
            padding: 30px 10px;
            position: relative;
            overflow: visible;
            z-index: 1;
            .media {
                overflow: visible;
                .media-left {
                    display: table-cell;
                    vertical-align: top;
                    padding-right: 10px;
                }
                .media-body {
                    display: table-cell;
                    white-space: nowrap;
                    width: 10000px;
                    overflow: hidden;
                    zoom: 1;
                    .media-heading {
                        color: #fff;
                        margin-top: 0;
                        margin-bottom: 5px;
                    }
                    .text-small {
                        color: #bbb;
                        font-size: 12px;
                    }
                }
                .media-right {
                    display: table-cell;
                    vertical-align: top;
                    padding-left: 10px;
                    .dropdown {
                        position: relative;
                    }
                }
            }
            .media:first-child {
                margin-top: 0;
            }
        }
        .nav-user-wrapper:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            pointer-events: none;
            background-image: url(/img/user-background.png);
        }

        .profile-card-photo {
            width: 38px;
            height: 38px;
            /*border-radius: 8px;*/
            display: inline-block;
            img {
                border-radius: 50%;
            }
        }

        .nav {
            width: auto;
            transition: all .5s;
            min-height: 100%;
            .weather {
                color: #bbb;
                text-align: center;
            }
        }

    }

    .el-menu {
        border-right: none !important;
        .el-menu-item-group {
            .is-active {
                border-left: 3px solid #3ed9e5;
            }
        }
        .el-submenu {
            .el-menu {
                ul {
                    .is-active {
                        border-left: 3px solid #3ed9e5;
                    }
                }
            }
        }
    }

    .el-menu-item-group {
        ul {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

    }

    .el-menu-item:hover, .el-menu-item:focus {
        outline: none;
    }

    /*非窄屏*/
    @media (min-width: 992px) {
        #sidebar {
            width: 220px;
            position: fixed;
            margin-top: 0;
            padding-top: 60px;
            transition: width 0.5s;
            .nav {
                padding-top: 20px;
                border-right: none;
                position: relative;
            }
        }
        .sidebar-closed #sidebar .nav-user-wrapper .media-body, .sidebar-closed #sidebar .nav-user-wrapper .media-right {
            display: none;
        }
    }

    /*窄屏*/
    @media (max-width: 991px) {
        #sidebar {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 260px;
            overflow: hidden;
            z-index: 0;
            float: none;
            transform: translate3d(-260px, 0, 0);
            transition: transform 300ms ease 0s;
        }
        .sidebar-off #sidebar {
            z-index: 1;
            transform: translate3d(0, 0, 0);
            transition: transform 300ms ease 0s;
        }
    }


</style>