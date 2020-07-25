<template>
    <div class="container-fluid">
        <div class="border-bottom mb-3 p-2">
            <h4>Most Popular Recipes</h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-3 mr-0" v-for="recipe in threemostpopularrecipes"
                v-bind:key="recipe.id">
                <!-- <transition name="fade" appear> -->
                    <recipe-component :recipe="recipe"></recipe-component>
                <!-- </transition> -->

            </div><!-- end col -->

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props:{
            threemostpopularrecipes:{
                type: Array
            }
        }
    }
</script>


<style scoped>

</style>
