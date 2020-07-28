<template>
    <div>
        <div class="border-bottom mb-3 p-2">
            <h4>Most Popular Recipes</h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-3 mr-0" v-for="recipe in threemostpopularrecipes"
                v-bind:key="recipe.id">
                    <recipe-component :recipe="recipe"></recipe-component>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props:{
            threemostpopularrecipes:{
                type: Array
            }
        }
    }
</script>


<style scoped>

</style>
