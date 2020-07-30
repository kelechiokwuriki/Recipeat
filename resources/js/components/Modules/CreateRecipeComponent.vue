<template>
    <transition name="fade" appear>

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

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="recipePicture">Add a picure of your food</label>
                            <input type="file" accept=".png, .jpg" @change="handleRecipePicture" id="recipePicture">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="cookingTime">Cooking time</label>
                        <number-input id="cookingTime" v-model="recipe.cooking_time" :min="1" controls></number-input>

                        <!-- <input type="number" v-model="recipe.cooking_time" value="0" min="0" id="preparationtime" class="form-control"> -->
                    </div>
                    <div class="col-sm-6">
                        <label for="cooking-time-format">Format</label>
                        <v-select id="cooking-time-format" :options="options" v-model="recipe.cooking_time_format"></v-select>
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
    </transition>
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
                    recipePicture: null,
                    steps: []
                },
                recipeStepId: 1,
                recipeStep: '',
                options: [ "Minutes", "Hours"]
            }
        },
        methods:{
            getRecipeFormData() {
                const recipeData = new FormData();

                recipeData.append('name', this.recipe.name);
                recipeData.append('cooking_time', this.recipe.cooking_time);
                recipeData.append('cooking_time_format', this.recipe.cooking_time_format);
                recipeData.append('ingredients', this.recipe.ingredients);
                recipeData.append('recipePicture', this.recipe.recipePicture);

                const stepsToJson = JSON.stringify({
                    steps: this.recipe.steps,
                });

                recipeData.append('steps', stepsToJson);

                return recipeData;
            },
            handleRecipePicture(event) {
                this.recipe.recipePicture = event.target.files[0]
            },
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
            outputFeedBack(title, text, icon, footer) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    footer: footer
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

                let config = { headers: { 'Content-Type': 'multipart/form-data' } }

                axios.post('/api/recipe', this.getRecipeFormData(), config).then(response => {
                    if(response.status === 200) {
                       this.outputFeedBack('Success',
                       'Yes! you have created your recipe',
                       'success',
                       '<a href="/home">Take me to see the recipes</a>');

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

<style scoped>
   .fade-enter-active, .fade-leave-active {
        transition: opacity 1s ease-out;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
