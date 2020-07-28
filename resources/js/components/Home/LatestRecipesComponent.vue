<template>
    <div>
        <div class="border-bottom mb-3 p-2">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>Latest Recipes</h4>
                </div>
                <div>
                    <a href="/recipe/create" type="button" class="btn btn-success btn-rounded width-md waves-effect waves-light">Add a recipe</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-3 mr-0" v-for="recipe in latestthreerecipes" v-bind:key="recipe.id">
                <recipe-component :recipe="recipe"></recipe-component>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            latestthreerecipes: {
                type: Array
            }
        }
    }
</script>

<style>
</style>
