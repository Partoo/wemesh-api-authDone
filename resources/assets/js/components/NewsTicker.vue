<template>
    <div class="news-ticker">
        <span class="news-left"><i :class="icon_class"></i></span>
        <div class="news-body">
            <ul id="news">
                <li v-for="item in lists" class="slide" @mouseover="paused = true" @mouseleave="paused = false">
                    <a :href="item.link">{{item.title}}</a>
                    <span class="time">{{item.date}}</span>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            lists: {
                type: Array,
                required: true
            },
            icon_class: {
                type: String,
                default: 'el-icon-tickets'
            }
        },
        data() {
            return {
                paused: false
            }
        },
        mounted() {
            let current = 0;
            let items = document.querySelectorAll('#news li');
            setInterval(() => {
                if (!this.paused) {
                    items[current].className = 'slide';
                    current = (current + 1) % items.length;
                    for (let i = 0; i < items.length; i++) {
                        document.getElementById('news').style.marginTop = current * -60 + 'px';
                    }
                }
            }, 5000);
        }
    }
</script>
<style lang="scss">
    .news-ticker {
        /*margin-top: 10px;*/
        /*background-color: #fff;*/
        /*margin-left: 15px;*/
        height: 60px;
        overflow: hidden;
        width: 500px;
        display: flex;
        text-align: left;
        align-items: flex-start;
        /*border-radius: 2px;*/
        /*border: 1px solid #eaeaea;*/

        .news-left {
            height: 60px;
            line-height: 60px;
            width: 60px;
            background: #10bacb;
            text-align: center;
            color: #fff;
            font-size: 18px;
            flex-basis: auto;
            flex-grow: 0;
            flex-shrink: 0;
        }
        .news-body {
            text-align: left;
            flex-basis: auto;
            flex-grow: 1;
            flex-shrink: 1;
            ul {
                padding: 0 !important;
                transition: .5s all ease-in-out;
            }
            li {
                line-height: 60px;
                .time {
                    line-height: 60px;
                    float: right;
                }
            }
        }

    }
</style>