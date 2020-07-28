<template>
<form class="app-search">
    <div class="app-search-box">
        <div class="input-group">
            <input type="text" v-model="searchTerm" class="form-control" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn" type="submit">
                    <i class="fe-search"></i>
                </button>
            </div>
        </div>
    </div>
</form>

</template>

<script>
    export default {
        data() {
            return {
                searchTerm: ''
            }
        },
        watch: {
            searchTerm(value) {
                window.eventBus.$emit('searchEvent', value);
            }
        }

    }

</script>

<style>

</style>
