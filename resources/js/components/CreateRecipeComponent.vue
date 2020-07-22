<template>
    <div class="container-fluid">

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            moment(date) {
                if(date) {
                    return moment(date);
                }

                return moment();
             },
        }
    }
</script>

<style>
</style>
