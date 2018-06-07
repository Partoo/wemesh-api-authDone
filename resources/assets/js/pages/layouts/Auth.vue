<template>
    <div class="overlay vcenter">
        <div class="overlay_mask"></div>
        <div class="overlay_content">
            <div class="card fluid">
                <div class="card-header section">
                    <logo class="center"></logo>
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Logo from '../../components/Logo'
    import {isMobile} from "../../plugins/helper"

    export default {
        components: {
            Logo
        }
    }
</script>