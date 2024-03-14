<template>
    <div class="p-2" style="width: 100%;">
        <div @click="$router.go(-1)" class="pt-2" style="width: 40px;height: 40px;float: left;cursor: pointer;">
            <i class="fa fa-chevron-left ml-2" aria-hidden="true"></i>
        </div>
        <div class="pt-1" style="width: calc(100% - 100px);height: 40px;float: left;">
            <p class="text-center mt-1 font-semibold">{{ currentTitlePage }}</p>
        </div>
        <div class="pt-1 text-center" style="width: 40px;height: 40px;float: right;font-size: 130%;" v-if="isForderPage">
            <router-link :to="{name: 'FileSearch'}">
                <i class="fa fa-search" aria-hidden="true"></i>
            </router-link>
        </div>
        <div class="pt-2 text-center" style="width: 40px;height: 40px;float: right;" v-if="!isForderPage">
            <router-link :to="{name: 'ForderEdit'}">
                <i class="fa fa-cog mt-1" aria-hidden="true" style="cursor: pointer;font-size: 120%;"></i>
            </router-link>
        </div>
        <div style="clear: both;">
        </div>
    </div>
    <router-view></router-view>
</template>
<script>
    export default {
        data() {
            return {
                title: ""
            }
        },
        created: function () {

        },
        computed: {
            currentTitlePage() {
                return this.$route?.meta?.title || '';
            },
            isForderPage(){
                return this.$route?.meta?.title == "File List" ? false : true;
            }
        },
        methods: {

        }
    }
</script>
