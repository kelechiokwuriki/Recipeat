<template>
    <div>
        <div class="border-bottom mb-3 p-2">
            <h4>Got ingredients but don't know what to cook?</h4>
        </div>
        <transition name="fade" appear>
            <div class="container mt-3">
                <div class="card-box">
                    <h4 class="mt-0 mb-3 header-title">Add your recipes separated by a comma</h4>
                    <div class="row">
                        <div class="col-sm-10">
                        <textarea-autosize id="recipes" class="form-control" ref="headerTextArea"
                                v-model="recipes" :min-height="10"/>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success btn-rounded width-lg waves-effect waves-light"
                            @click="searchRecipes">Search</button>
                        </div>
                    </div>
                </div>

                <template v-if="recipesResult.length > 0">
                    <div class="border-bottom mb-3 p-2">
                        <h4>Results</h4>
                    </div>
                    <div class="row">
                        <div class="col" v-for="recipe in recipesResult"
                            v-bind:key="recipe.name">
                                <recipe-component :recipe="recipe"></recipe-component>
                        </div>
                    </div>
                </template>
            </div>
        </transition>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                recipes: '',
                recipesResult: []
            }
        },
        methods: {
            searchRecipes() {
                let recipesSplit = this.recipes.toLowerCase().split(',');

                axios.post('/api/what-can-i-cook', recipesSplit).then(response => {
                    this.recipesResult = response.data;
                })
            }
        }

    }
</script>
