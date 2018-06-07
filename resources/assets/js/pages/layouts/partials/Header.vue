<template>
    <div class="top-nav">
        <div class="navbar-header">
            <button href="#" class="sidebar-mobile-toggler pull-left btn hidden-md hidden-lg"
                    @click="switchSidebar">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/"> <img
                    src="/img/logo_inverse.png"
                    alt="wemesh"> </a>
            <!--<a class="navbar-brand navbar-brand-collapsed" href="/"> <img-->
            <!--src="/img/logo_inverse.png"-->
            <!--alt="wemesh"> </a>-->
            <span class="version">版本:1.0</span>
        </div>
        <div class="navbar-collapse collapse  hidden-sm">
            <ul class="nav navbar-left">
                <ticker :lists="news" icon_class="fa fa-podcast"></ticker>
            </ul>
            <ul class="nav navbar-right">
                <li class="dropdown">
                    <el-dropdown>
                        <a href="" class="dropdown-toggle btn-transparent">
                            <span class="badge">3</span>
                            <i class="fa fa-envelope"></i>
                        </a>
                        <el-dropdown-menu slot="dropdown" style="margin-top: -10px">
                            <el-dropdown-item>黄金糕</el-dropdown-item>
                            <el-dropdown-item>狮子头</el-dropdown-item>
                            <el-dropdown-item>螺蛳粉</el-dropdown-item>
                            <el-dropdown-item disabled>双皮奶</el-dropdown-item>
                            <el-dropdown-item divided>蚵仔煎</el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                </li>
                <li class="dropdown">
                    <el-dropdown>
                        <a href="" class="dropdown-toggle btn-transparent">
                            <span class="badge">...</span>
                            <i class="fa fa-bell"></i>
                        </a>
                        <el-dropdown-menu slot="dropdown" style="margin-top: -10px">
                            <el-dropdown-item>黄金糕</el-dropdown-item>
                            <el-dropdown-item>狮子头</el-dropdown-item>
                            <el-dropdown-item>螺蛳粉</el-dropdown-item>
                            <el-dropdown-item disabled>双皮奶</el-dropdown-item>
                            <el-dropdown-item divided>蚵仔煎</el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                </li>
            </ul>
            <button class="settings btn-transparent"></button>
        </div>
    </div>
</template>

<script>
    import {mapActions} from 'vuex'
    import Ticker from '../../../components/NewsTicker';

    export default {
        data() {
            return {
                news: [
                    {link: 'aa', title: '韩国总统文在寅签署修宪案 内容包括总统4年连任制', date: '2017-11-11'},
                    {link: 'bb', title: '美财长努钦：有望与中国就贸易战签订"停战协议"', date: '2018-03-15'},
                    {link: 'cc', title: '在恶性通胀的委内瑞拉，比特币如何成了"硬通货"', date: '2008-03-15'},
                    {link: 'cc', title: '苹果公司CEO库克：拒绝开放拒绝贸易的国家会失败', date: '2008-03-15'},
                    {link: 'cc', title: '被捧上天的网红食物，可能还不如一桶泡面', date: '2008-03-15'}
                ]
            }
        },
        methods: {
            ...mapActions([
                'switchSidebar'
            ])
        },
        components: {
            Ticker
        }
    }
</script>

<style lang="scss">
    .nav {
        list-style: none;
    }

    .top-nav {
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 1080;
        border: none;
        margin-bottom: 0;
        height: 60px;
        color: #e2e2e2 !important;
        a {
            color: #e2e2e2;
        }
        .navbar-header {
            z-index: 10;
            background: #2d3642;
            position: relative;
            height: 60px;
            .sidebar-mobile-toggler {
                padding: 0 15px;
                line-height: 60px;
                height: 60px;
                border-radius: 0;
            }
            .navbar-brand {
                transition: all 0.5s;
                padding: 0 15px;
                float: left;
                line-height: 60px;
                height: 60px;
                img {
                    display: inline-block;
                    vertical-align: middle;
                    height: 40px;
                }
            }
            .version {
                position: absolute;
                bottom: 5px;
                font-size: smaller;
                color: #cbcbcb;
            }

            .navbar-brand-collapsed {
                display: none;
            }
            .menu-toggler {
                margin-right: 60px;
                padding: 0 15px;
                float: right;
                background: none;
                border: none;
                box-shadow: none;
            }
        }
        .navbar-collapse {
            background: #374a61;
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
        .navbar-left {
            width: 500px;
            margin-top: 0;
            li {
                display: block;
            }
        }
        .sidebar-toggler {
            box-shadow: none;
            float: left;
            margin-top: 12px;
            margin-right: 15px;
            /*border-radius: 0;*/
        }
        .navbar-right {
            margin-right: 20px;
            .dropdown-toggle {
                /*color: #737373 !important;*/
                font-weight: 600;
                letter-spacing: 0;
                line-height: 60px;
                padding: 0 15px;
                position: relative;
                text-align: center;
                display: block;
                i {
                    font-size: 18px;
                }
            }
            .badge {
                background-color: #e85a5a;
                color: #ffffff;
                padding: 0;
                position: absolute;
                top: 10px;
                right: -15px;
                font-size: 12px;
                left: auto;
                transform: translateX(-50%);
                height: 20px;
                min-width: 20px;
                line-height: 20px;
            }

        }

        .settings {
            position: fixed;
            top: -1px;
            right: 0;
            width: 30px;
            line-height: 59px;
        }
        .settings:after {
            position: absolute;
            font-size: 17px;
            padding: 0;
            margin: 0;
            font-family: 'FontAwesome';
            content: "\f085";
            left: 5px;
            top: 0;
        }
    }

    @media(min-width: 992px) {
        .navbar-header {
            width: 220px;
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            .navbar-brand {
                padding: 0 15px;
                float: left;

            }
            .navbar-brand-collapsed {
                padding: 0;
                width: 50px !important;
                display: inline-block;
                opacity: 0;
                left: -150%;
                text-align: center;
            }
        }

        .navbar-collapse {
            margin-left: 220px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }
        .navbar-left {
            margin-left: -15px;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }
        .navbar-right {
            position: relative;
            margin: 0 15px 0 0;
        }
    }

    @media (min-width: 768px) {
        .navbar-collapse {
            transition: margin .5s;
            height: 60px;
        }
        .navbar-left {
            float: left;
            li {
                padding: 0 10px;
                position: relative;
            }
        }
        .navbar-right {
            float: right;
            height: auto !important;
            li {
                float: left;
                position: relative;
                padding: 0 10px;
            }
            li:before {
                background: linear-gradient(to bottom, rgba(51, 51, 51, 0) 0%, rgba(51, 51, 51, 0.2) 50%, rgba(51, 51, 51, 0) 100%);
                content: "";
                position: absolute;
                width: 1px;
                right: 0;
                top: 5px;
                bottom: 5px;
            }
        }
    }

    @media (max-width: 991px) {
        .top-nav {
            /*position: absolute !important;*/

        }
    }
</style>