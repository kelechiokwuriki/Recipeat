<template>
    <div class="container mt-3">
        <div class="card-box">
            <h4 class="mt-0 mb-3 header-title text-capitalize">{{ recipe.name }}</h4>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            recipe: {
                type: Object
            }
        }
    }
</script>

<style>
</style>
