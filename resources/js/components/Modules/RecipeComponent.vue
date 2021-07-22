<template>
    <transition name="fade" appear>
        <div class="card shadow-lg" style="width: 18rem;">
            <img class="card-img-top shadow-md img-fluid recipe-image" :src="imageSource" alt="Card image cap">
            <div class="card-img-overlay h-50">
                <h5 class="card-title bg-secondary text-white w-50 p-0 border border-secondary rounded text-center">
                    <i class="far fa-clock mr-1"></i>{{ recipeData.cooking_time }}
                </h5>
                <!-- <a href="#" class="btn width-xs btn-success">View</a> -->

            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ recipeData.name }}</h4>
                    </div>
                    <div class="save-recipe" @click="toggleSaveRecipe(recipeData.id, recipeData.saved_recipe_id)">
                        <i class="mdi mdi-content-save" :class="{'text-success': recipeData.logged_in_user_saved_recipe}"></i>
                        <span v-if="recipeData.logged_in_user_saved_recipe">Saved</span>
                        <span v-else>Save</span>
                    </div>
                </div>
                <p class="card-text" v-if="recipeData.user">Recipe by {{ recipeData.user }}</p>
                <div class="d-flex justify-content-between">
                    <div>
                        <a :href="'/recipe/' + recipeData.slug" class="btn btn-success waves-effect waves-light"
                        @click="recordUserViewedRecipe(recipeData.id)">View</a>
                    </div>
                    <div>
                        <p class="card-text">
                            <small class="text-muted">{{ recipeData.views }}
                                <span v-if="recipeData.views > 1">views</span>
                                <span v-else>view</span>
                            </small>
                        </p>
                    </div>
                    <div class="like-recipe" @click="toggleRecipeLike(recipeData.id, recipeData.liked_recipe_id)">
                        <i class="fas fa-heart mr-1" :class="{'text-danger': recipeData.logged_in_user_liked_recipe}"></i>
                        <template v-if="recipeData.likes">
                            <span v-if="recipeData.likes > 0">{{ recipeData.likes }}</span>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            recipeData: {},
        }
    },
    mounted() {
        this.recipeData = this.recipe;
    },
    computed: {
        imageSource() {
            let pathName = window.location.pathname;
            if (this.recipeData.image_source) {
                return pathName.substring(1, pathName-1) + this.recipeData.image_source;
            }

            return pathName.substring(1, pathName-1) + 'uploads/1596166617food1.jpeg';
        }
    },
    methods: {
        recordUserViewedRecipe(recipeId) {
            if(this.recipeData.logged_in_user_viewed_recipe) { return; }

            axios.post('/api/view', {'recipe_id': recipeId}).then(response => {
                if(response.status === 201) {
                    this.recipeData.views++;
                }
                console.log(response);
            })
        },
        saveRecipe(recipeId) {
            axios.post('/api/save-recipe', {'recipe_id': recipeId}).then(response => {
                if(response.status === 201) {
                    this.recipeData.logged_in_user_saved_recipe = true;
                    this.recipeData.saved_recipe_id = response.data.id;
                }
            })
        },
        unSaveRecipe(savedRecipeId) {
            axios.delete('/api/save-recipe/' + savedRecipeId).then(response => {
                if(response.data === 1) {
                    this.recipeData.logged_in_user_saved_recipe = false;
                }
            })
        },
        toggleSaveRecipe(recipeId, savedRecipeId) {
            if(this.recipeData.logged_in_user_saved_recipe) {
                return this.unSaveRecipe(savedRecipeId);
            }
            return this.saveRecipe(recipeId);
        },
        unLikeRecipe(likedRecipeId) {
            axios.delete('/api/like/' + likedRecipeId).then(response => {
                console.log(response);
                if(response.data === 1) {
                    this.recipeData.likes--;
                    this.recipeData.logged_in_user_liked_recipe = false;
                }
            })
        },
        likeRecipe(recipeId){
            axios.post('/api/like', {'recipe_id': recipeId}).then(response => {
                if(response.status === 201) {
                    this.recipeData.likes++;
                    this.recipeData.logged_in_user_liked_recipe = true;
                    this.recipeData.liked_recipe_id = response.data.id;
                }
            })
        },
        toggleRecipeLike(recipeId, likedRecipeId) {
            if(this.recipeData.logged_in_user_liked_recipe) {
                return this.unLikeRecipe(likedRecipeId);
            }
            return this.likeRecipe(recipeId);
        }
    },
    props: {
        recipe: {
            type: Object
        }
    },
}
</script>

<style scoped>
    .like-recipe, .save-recipe {
        cursor: pointer;
    }

    .like-recipe:hover, .save-recipe:hover{
        -webkit-transform: scale(1.2);
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity 1s ease-out;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
