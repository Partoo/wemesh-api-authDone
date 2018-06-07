<template>
    <div class="logo text-center">
        <img src="/img/logo.png">
        <h5>办公集成智慧平台</h5>
    </div>
</template>

<style lang="scss">
    .logo {
        padding: 15px;
        margin-bottom: 10px;
        img {
            height: 50px;
        }
        h5 {
            font-weight: 500 !important;
        }
        h5::before {
            display: inline-block;
            margin: 0 8px 2px 0;
            height: 2px;
            content: " ";
            text-shadow: none;
            background-color: #2ABFC3;
            width: 20%;

        }
        h5::after {
            display: inline-block;
            margin: 0 0 2px 8px;
            height: 2px;
            content: " ";
            text-shadow: none;
            background-color: #2ABFC3;
            width: 20%;

        }
    }

</style>