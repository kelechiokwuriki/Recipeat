<template>
    <div class="container-fluid">
        <div class="border-bottom mb-3 p-2">
            <h4>Most Popular Recipes</h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-3 mr-0" v-for="recipe in threemostpopularrecipes"
                v-bind:key="recipe.id">

                <!-- Simple card -->
                <recipe-component :recipe="recipe"></recipe-component>

            </div><!-- end col -->

        </div>
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
