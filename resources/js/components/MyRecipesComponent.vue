<template>
   <div>
        <div class="border-bottom mb-3 p-2">
            <h4>My Recipes</h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-3 mr-0" v-for="recipe in myrecipes"
                v-bind:key="recipe.id">
                    <recipe-component :recipe="recipe"></recipe-component>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        myrecipes: {
            type: Array
        }
    }
}
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 1s ease-out;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
