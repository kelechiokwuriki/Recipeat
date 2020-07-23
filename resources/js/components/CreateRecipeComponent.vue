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
                                        <th>Instruction</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="instruction in recipe.instructions" v-bind:key="instruction.id">
                                        <th scope="row">{{ instruction.id }}</th>
                                        <td>{{ instruction.instruction }}</td>
                                        <td>
                                            <button class="btn btn-icon btn-danger btn-xs" @click="removeInstruction(instruction.id)">
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
                                <textarea-autosize id="instruction" class="form-control" aria-describedby="instructionHelp" ref="headerTextArea"
                                v-model.trim="recipeInstruction" :min-height="10"/>
                                <small id="instructionHelp" class="form-text">Add instructions for your recipe</small>
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-icon btn-success waves-effect waves-light" @click="addInstruction">
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
                    instructions: []
                },
                recipeInstructionId: 1,
                recipeInstruction: '',
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
            addInstruction(e) {
                e.preventDefault();

                this.recipe.instructions.push({
                    id: this.recipeInstructionId,
                    instruction: this.recipeInstruction
                });

                this.recipeInstruction = '';
                this.recipeInstructionId++;
            },
            removeInstruction(id) {
                this.recipe.instructions = this.recipe.instructions.filter(instruction => {
                    return instruction.id != id;
                });

                this.recipeInstructionId--;
            },
            submitRecipe(e) {
                e.preventDefault();

                axios.post('/api/recipe', this.recipe).then(response => {
                    console.log(response);
                })
            }
        },
        computed: {
            disableSubmitButton() {
                if(this.recipe.name === '' || this.recipe.cooking_time_format === '' || this.recipe.ingredients === ''
                    || this.recipe.instructions.length === 0) {
                        return true;
                }


                return false;


            }
        }
    }
</script>

<style>
</style>
