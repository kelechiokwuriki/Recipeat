<template>
    <transition name="fade" appear>
        <div class="card shadow-lg" style="width: 18rem;">
            <img class="card-img-top shadow-md img-fluid recipe-image" :src="recipe.image_source" alt="Card image cap">
            <div class="card-img-overlay h-50">
                <h5 class="card-title bg-secondary text-white w-50 p-0 border border-secondary rounded text-center"><i class="far fa-clock mr-1"></i>{{ recipe.cooking_time }}</h5>
                <!-- <a href="#" class="btn width-xs btn-success">View</a> -->

            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ recipe.name }}</h4>
                    </div>
                    <div class="save-recipe" @click="toggleRecipeLike(recipe.id)">
                        <i class="fas fa-heart mr-1"></i><span v-if="recipeLikes > 0">{{ recipeLikes }}</span>
                    </div>
                </div>
                <p class="card-text" v-if="recipe.user">Recipe by {{ recipe.user.name }}</p>
                <div class="d-flex justify-content-between">
                    <div>
                        <a :href="'/recipe/' + recipe.slug" class="btn btn-success waves-effect waves-light">View Recipe</a>
                    </div>
                    <div>
                        <p class="card-text">
                            <small class="text-muted">{{ recipe.view_count }} views</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
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

                    this.$emit('recipe-liked', likedRecipe);
                }
            })
        }
    },
    props: {
        recipe: {
            type: Object
        }
    },
    computed: {
        recipeLikes() {
            return this.recipe.likes.length;
        }
    }
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
