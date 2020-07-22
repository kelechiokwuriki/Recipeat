<template>
    <div class="container-fluid">
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

                <!-- Simple card -->
                <div class="card shadow-lg" style="width: 20rem;">
                    <img class="card-img-top shadow-md img-fluid recipe-image" :src="recipe.image_source" alt="Card image cap">
                    <div class="card-img-overlay h-50">
                        <h5 class="card-title bg-white w-50 p-0 border rounded text-center"><i class="far fa-clock mr-1"></i>25 minutes</h5>
                        <!-- <a href="#" class="btn width-xs btn-success">View</a> -->

                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ recipe.name }}</h4>
                        <p class="card-text">Recipe by {{ recipe.user.name }}</p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="#" class="btn btn-success waves-effect waves-light">View Recipe</a>
                            </div>
                            <div>
                                <p class="card-text">
                                    <small class="text-muted">{{ recipe.view_count }} views</small>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- end col -->

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
            latestthreerecipes:{
                type: Array
            }
        }
    }
</script>

<style>
</style>
