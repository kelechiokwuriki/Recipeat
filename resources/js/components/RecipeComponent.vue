<template>
    <transition name="fade" appear>
        <div class="card shadow-lg" style="width: 18rem;">
            <img class="card-img-top shadow-md img-fluid recipe-image" :src="recipeData.image_source" alt="Card image cap">
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
                    <div :class="{'save-recipe':recipeData.logged_in_user_liked_recipe}" @click="toggleRecipeLike(recipeData.id)">
                        <i class="fas fa-heart mr-1" :class="{'text-danger': recipeData.logged_in_user_liked_recipe}"></i>
                        <template v-if="recipeData.likes">
                            <span v-if="recipeData.likes > 0">{{ recipeData.likes }}</span>
                        </template>
                    </div>
                </div>
                <p class="card-text" v-if="recipeData.user">Recipe by {{ recipeData.user }}</p>
                <div class="d-flex justify-content-between">
                    <div>
                        <a :href="'/recipe/' + recipeData.slug" class="btn btn-success waves-effect waves-light">View Recipe</a>
                    </div>
                    <div>
                        <p class="card-text">
                            <small class="text-muted">{{ recipeData.view_count }} views</small>
                        </p>
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
            recipeData: {}
        }
    },
    mounted() {
        this.recipeData = this.recipe;
    },
    methods: {
        toggleRecipeLike(recipeId) {
            axios.post('/api/like', {'recipe_id': recipeId}).then(response => {
                if(response.status === 201) {

                      let likedRecipe = {
                        'recipe_id': response.data.recipe_id,
                        'user_id': response.data.user_id,
                        'created_at': response.data.created_at,
                        'id': response.data.id,
                        'updated_at': response.data.updated_at
                    };

                    this.recipeData.likes.push(likedRecipe);
                }
            })
        }
    },
    props: {
        recipe: {
            type: Object
        }
    },
    // computed() {
    //     userLiked
    // }
}
</script>

<style scoped>
    .save-recipe {
        cursor: pointer;
    }

    .save-recipe:hover{
        -webkit-transform: scale(1.2);

    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity 1s ease-out;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
