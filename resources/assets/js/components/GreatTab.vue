<template>
    <div class="row mt-30">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <ul class="great-tab-list">
                <li v-for="(item, index) in items" :class="{active:index===currentIndex}">
                    <a href="#" @click.prevent="changeTab(index)"> <i :class="'fa fa-'+ item.icon"></i>
                        <br> {{item.title}} </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="great-tab-box">
                <div class="tab-panel">
                    <div class="tab-content">
                        <div class="single-tab">
                            <h3 class="sub-title">{{items[currentIndex]['slogan']}}</h3>
                            <div v-html="currentContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentIndex: 0,
                items: [
                    {
                        'title': '微网站系统',
                        'slogan': '高效强大还免费的微网站系统',
                        'icon': 'wechat',
                        'content': '<p>利用当前最为流行的前端技术打造的微网站系统已免费对外开放使用，您可以通过后台轻松进行管理，并生成速度快、流量省且美观优雅的微网站。</p>\n' +
                        '                            <div class="mt-30 mb-30">\n' +
                        '                                <p>系统同时支持与微信公众号的绑定，能够实现微网站与微信公众号图文的同步。</p>\n' +
                        '                            </div>\n' +
                        '                            <ul>\n' +
                        '                                <li> 权限细化功能，不同角色管理不同的功能</li>\n' +
                        '                                <li> 内置微信公众号图文样式，维护公众号更加便利</li>\n' +
                        '                                <li> ...</li>\n' +
                        '                            </ul>\n' +
                        '                            <a href="" class="button black">read more</a>'
                    },
                    {
                        'title': '电视直播系统',
                        'slogan': '整合医疗卫生数据资源，微信预约、查询更加轻松方便',
                        'icon': 'video-camera',
                        'content': '<p>利用当前最为流行的前端技术打造的微网站系统已免费对外开放使用，您可以通过后台轻松进行管理，并生成速度快、流量省且美观优雅的微网站。</p>\n' +
                        '                            <div class="mt-30 mb-30">\n' +
                        '                                <p>系统同时支持与微信公众号的绑定，能够实现微网站与微信公众号图文的同步。</p>\n' +
                        '                            </div>\n' +
                        '                            <ul>\n' +
                        '                                <li> 权限细化功能，不同角色管理不同的功能</li>\n' +
                        '                                <li> 内置微信公众号图文样式，维护公众号更加便利</li>\n' +
                        '                                <li> ...</li>\n' +
                        '                            </ul>\n' +
                        '                            <a href="" class="button black">read more</a>'
                    },
                    {
                        'title': '医疗卫生系统',
                        'slogan': '整合医疗卫生数据资源，微信预约、查询更加轻松方便',
                        'icon': 'hospital-o',
                        'content': '<p>利用当前最为流行的前端技术打造的微网站系统已免费对外开放使用，您可以通过后台轻松进行管理，并生成速度快、流量省且美观优雅的微网站。</p>\n' +
                        '                            <div class="mt-30 mb-30">\n' +
                        '                                <p>系统同时支持与微信公众号的绑定，能够实现微网站与微信公众号图文的同步。</p>\n' +
                        '                            </div>\n' +
                        '                            <ul>\n' +
                        '                                <li> 权限细化功能，不同角色管理不同的功能</li>\n' +
                        '                                <li> 内置微信公众号图文样式，维护公众号更加便利</li>\n' +
                        '                                <li> ...</li>\n' +
                        '                            </ul>\n' +
                        '                            <a href="" class="button black">read more</a>'
                    }
                ]
            }
        },
        methods: {
            changeTab(index) {
                this.currentIndex = index
            }
        },
        computed: {
            currentContent() {
                return this.items[this.currentIndex]['content']
            }
        }

    }
</script>

<style lang="scss">
    .great-tab-list {
        list-style: none;
        li {
            border: 1px solid #e1e1e1;
            text-align: center;
            position: relative;
            margin-top: 15px;

            &:first-child {
                margin-top: 0;
            }
            a {
                color: #333333;
                font-size: 18px;
                font-weight: bold;
                text-transform: uppercase;
                padding: 29px;
                display: block;
                i {
                    font-size: 30px;
                    color: #2ABFC3;
                }
            }
        }
        .active {
            background-color: #2ABFC3;
            a, a i {
                color: #fff;
            }
        }
    }

    .great-tab-list li.active::before {
        content: '';
        position: absolute;
        height: 30px;
        width: 30px;
        right: -8px;
        bottom: 50px;
        background-color: #2ABFC3;
        transform: rotate(45deg);
        margin-bottom: -8px;
    }

    .great-tab-box {
        .tab-content {
            background-color: #ccc;
            padding: 20px;
            position: relative;
            z-index: 0;
            overflow: hidden;
        }
        .tab-content::before {
            content: '';
            position: absolute;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
            background-color: #fff;
            opacity: 0.9;
            z-index: -1;
        }
    }

    .sub-title {
        font-size: 24px;
        font-weight: 500;
        text-transform: uppercase;
        color: #333333;
        line-height: 24px;
        span {
            color: #2ABFC3;
        }
    }

</style>