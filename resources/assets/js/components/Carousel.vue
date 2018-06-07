<template>
    <section class="slider col-sm-12">
        <div class="slider-fade">
            <div class="slider-inner">
                <div class="slider-item slider1 table">
                    <div class="table-cell">
                        <div class="intro-text">
                            <div class="title">
                                <h1><span>WE MESH</span> WITH YOU <span>PERFECTLY</span></h1>
                                <p>德才兼备,让日常办公变得更加轻松与智慧</p>
                            </div>
                            <a href="/register" class="button wemesh">免费试用</a>
                            <a href="/login" class="button btn-transparent">登录平台</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>


<style lang="scss">
    .table {
        display: table;
        height: 100%;
        position: relative;
        z-index: 1;
    }

    .table-cell {
        display: table-cell;
        vertical-align: middle;
    }

    .slider-item {
        min-height: 960px;
        width: 100%;
    }

    .slider-item:before {
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #090215;
        opacity: .66;
        z-index: -1;
    }

    .slider1 {
        background-size: cover;
        background: url(/img/banner.jpg) no-repeat center center;
    }

    .intro-text {
        padding-left: 60px;
        text-align: left;
        margin-bottom: 40px;
        max-width: 570px;
        .title {
            margin-bottom: 38px;
        }
        .title h1 {
            color: #fff;
        }
        .title span {
            color: #40cbbf;
        }
        .title p {
            font-size: 24px;
            color: #fff;
            line-height: 36px;
        }
        .button {
            width: 180px;
            text-align: center;
        }
    }

</style>