<template>
    <transition name="fade" appear>
        <div class="card shadow-lg" style="width: 20rem;">
            <img class="card-img-top shadow-md img-fluid recipe-image" :src="recipe.image_source" alt="Card image cap">
            <div class="card-img-overlay h-50">
                <h5 class="card-title bg-white w-50 p-0 border rounded text-center"><i class="far fa-clock mr-1"></i>{{ recipe.cooking_time }}</h5>
                <!-- <a href="#" class="btn width-xs btn-success">View</a> -->

            </div>
            <div class="card-body">
                <h4 class="card-title">{{ recipe.name }}</h4>
                <p class="card-text">Recipe by {{ recipe.user.name }}</p>
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
    props: {
        recipe: {
            type: Object
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
