<template>
    <div class="container mt-3">
        <div class="card-box">
            <h4 class="mt-0 mb-3 header-title">Add your favourite recipe</h4>

            <form role="form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="recipeName">Recipe Name</label>
                            <input type="text" class="form-control" v-model="recipe.name" id="recipeName" aria-describedby="recipeNameHelp" placeholder="E.g Spaghetti Corn Cheese">
                            <small id="recipeNameHelp" class="form-text text-muted">Try to use a creative name</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">List out the recipe ingredients separated by a comma</label>
                            <textarea-autosize id="recipeIngredients" class="form-control" aria-describedby="recipeIngredientsHelp" ref="headerTextArea"
                                v-model="recipe.ingredients" :min-height="10"/>
                        <small id="recipeIngredientsHelp" class="form-text text-muted">Please separate the ingredients by a comma</small>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="cookingTime">Cooking time</label>
                        <number-input id="cookingTime" v-model="recipe.cooking_time" :min="1" :max="10" controls></number-input>

                        <!-- <input type="number" v-model="recipe.cooking_time" value="0" min="0" id="preparationtime" class="form-control"> -->
                    </div>
                    <div class="col-sm-6">
                        <label for="cooking-time-format">Format</label>
                        <v-select id="cooking-time-format" :options="options" v-model="recipe.cooking_time_format"></v-select>
                        <!-- <select name="selecttime" v-model="recipe.cooking_time_format" class="form-control" id="preparation-time-format">
                            <option value="">--Please choose an option--</option>
                            <option value="minutes">minutes</option>
                            <option value="hours">hours</option>
                        </select> -->
                    </div>
                </div>

                <div class="row mt-4">
                     <div class="col-sm-6">
                         <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Step</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="step in recipe.steps" v-bind:key="step.id">
                                        <th scope="row">{{ step.id }}</th>
                                        <td>{{ step.step }}</td>
                                        <td>
                                            <button class="btn btn-icon btn-danger btn-xs" @click="removeStep(step.id)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6 row">
                            <div class="col-sm-11">
                                <!-- <label for="instruction">Instructions</label> -->
                                <textarea-autosize id="step" class="form-control" aria-describedby="stepHelp" ref="headerTextArea"
                                v-model.trim="recipeStep" :min-height="10"/>
                                <small id="stepHelp" class="form-text">Add steps for your recipe</small>
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-icon btn-success waves-effect waves-light" @click="addStep">
                                    <i class="fas fa-plus"></i></button>
                            </div>
                    </div>

                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success btn-rounded width-lg waves-effect waves-light"
                    @click="submitRecipe" :disabled="disableSubmitButton">
                        <i class="fas fa-scroll mr-1"></i>Submit Recipe</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                recipe: {
                    name: '',
                    cooking_time: null,
                    cooking_time_format: '',
                    ingredients: '',
                    steps: []
                },
                recipeStepId: 1,
                recipeStep: '',
                // disableSubmitButton: true,
                options: [
                    "Minutes",
                    "Hours"
                ]
            }
        },
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
            addStep(e) {
                e.preventDefault();

                this.recipe.steps.push({
                    id: this.recipeStepId,
                    step: this.recipeStep
                });

                this.recipeStep = '';
                this.recipeStepId++;
            },
            removeStep(id) {
                this.recipe.steps = this.recipe.steps.filter(step => {
                    return step.id != id;
                });

                this.recipeStepId--;
            },
            outputFeedBack(title, text, icon) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon
                });
            },
            clearFormElements() {
                this.recipe.name = '';
                this.recipe.cooking_time = null;
                this.recipe.cooking_time_format = '';
                this.recipe.ingredients = '';
                this.recipe.steps = [];
            },
            submitRecipe(e) {
                e.preventDefault();

                axios.post('/api/recipe', this.recipe).then(response => {
                    if(response.status === 200) {
                       this.outputFeedBack('Success', 'Yes! you have created your recipe', 'success');

                       this.clearFormElements();
                    }
                })
            }
        },
        computed: {
            disableSubmitButton() {
                if(this.recipe.name === '' || this.recipe.cooking_time_format === '' || this.recipe.ingredients === ''
                    || this.recipe.steps.length === 0) {
                        return true;
                }

                return false;
            }
        }
    }
</script>

<style>
</style>
