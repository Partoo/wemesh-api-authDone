<template>
    <div>
        <header class="row sticky" id="sticky">
            <div class="col-md-3 hidden-sm">
                <a href="#" class="logo">
                    <span class="header-logo">
                <img src="/img/logo.png" alt="">
            </span>
                </a>
                <!--<label for="drawer-checkbox" class="button drawer-toggle"></label>-->
            </div>
            <div class="col-md-5 col-md-offset-4 hidden-sm">
                <div class="logo-title" v-scroll-spy-active v-scroll-spy-link>
                    <a v-for="(item, index) in menus" href="#" class="button"
                       :class="{active: index===section}">{{item}}</a>
                </div>
            </div>
            <div class="col-sm-10 col-sm-offset-1 hidden-lg hidden-md">
                <div class="logo-title" v-scroll-spy-active v-scroll-spy-link>
                    <a v-for="(item, index) in menus" href="#" class="button"
                       :class="{active: index===section}">{{item}}</a>
                </div>
            </div>
        </header>
        <!--<input type="checkbox" id="drawer-checkbox">-->
        <!--<nav class="drawer hidden-md hidden-lg" v-scroll-spy-active v-scroll-spy-link>-->
        <!--<label for="drawer-checkbox" class="close"></label>-->
        <!--&lt;!&ndash;<a v-for="(item, index) in menus" href="#" class="button hidden-sm"&ndash;&gt;-->
        <!--&lt;!&ndash;:class="{active: index===section}">{{item}}</a>&ndash;&gt;-->
        <!--<h4 v-for="(item, index) in menus"><a href="#" :class="{active: index===section}">{{item}}</a></h4>-->
        <!--&lt;!&ndash;<h4><a href="#">Blog</a></h4>&ndash;&gt;-->
        <!--&lt;!&ndash;<h4><a href="#">Contact</a></h4>&ndash;&gt;-->
        <!--</nav>-->
        <div class="main" v-scroll-spy="{data: 'section', offset: 160, time: 300, steps: 30}">
            <div class="row mb-30">
                <carousel></carousel>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 section-title text-center mb-30">
                        <h2>{{menus[1]}}</h2>
                        <p><span>微脉事</span>是一个集成办公环境，除了更好地扩展了微信公众平台外，还可以深度定制并集成您所在行业的应用：</p>
                    </div>
                </div>
                <great-tab></great-tab>
            </div>
        </div>
    </div>
</template>

<script>
    import Carousel from '../components/Carousel'
    import GreatTab from '../components/GreatTab'

    export default {
        data() {
            return {
                section: 0,
                menus: [
                    '首页', '产品介绍', '应用市场', '联系我们'
                ]
            }
        },
        components: {
            Carousel,
            GreatTab
        }
    }
</script>

<style lang="scss">
    header {
        padding-top: 12px;
    }

    .sticky {
        background: #fff;
        box-shadow: 12px 5px 12px 3px rgba(0, 0, 0, 0.24);
        left: 0;
        right: 0;
        z-index: 999;
    }

    .logo img {
        height: 50px;
    }

    .img-hover-enlarge img {
        transition: all 2s;
    }

    .img-hover-enlarge:hover img {
        transform: scale(1.1);
    }

    .logo-title {
        float: right;
        margin-top: 4px;
        .active {
            background-color: #2ABFC3 !important;
            color: #fff !important;
        }
    }

    .section-title {
        text-transform: uppercase;
        max-width: 550px;
        margin: 0 auto;
        h2::before {
            display: inline-block;
            margin: 0 20px 8px 0;
            height: 2px;
            content: " ";
            text-shadow: none;
            background-color: #2ABFC3;
            width: 100px;

        }
        h2::after {
            display: inline-block;
            margin: 0 0 8px 20px;
            height: 2px;
            content: " ";
            text-shadow: none;
            background-color: #2ABFC3;
            width: 100px;
        }
    }

    .btn-transparent {
        background-color: transparent !important;
        border: 1px solid #fff !important;
        &:hover {
            background-color: #2ABFC3 !important;
            border: 1px solid #2ABFC3 !important;
        }
    }
</style>