<template>
    <transition name="fade" appear>
        <div class="card-box">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="header-title text-capitalize">{{ recipe.name }} by {{ recipe.user }}</h4>
                    <h5 class="text-success"><i class="far fa-clock mr-1 "></i>{{ recipe.cooking_time }}</h5>

                </div>
                <div>
                    <h4 class="header-title">Made on {{ moment(recipe.created_at).format('LL') }}</h4>
                </div>
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-sm-4">
                    <div class="card bg-dark text-white">
                        <img :src="currentUrlPathName + recipe.image_source" alt="Card image cap" class="card-img-top shadow-md img-fluid single-recipe-image">
                    </div>
                </div>
                <div class="col-sm-4">
                    <h4>Recipe Steps</h4>
                    <ol>
                        <li v-for="step in recipe.steps" v-bind:key="step.id">
                            {{ step.step }}
                        </li>
                    </ol>
                </div>
                <div class="col-sm-4">
                    <h4>Ingredients</h4>
                     <ul>
                        <li v-for="ingredient in recipe.ingredients" v-bind:key="ingredient.id">
                            {{ ingredient }}
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </transition>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        props: {
            recipe: {
                type: Object
            }
        },
        computed: {
            currentUrlPathName() {
                let pathName = window.location.pathname;
                return pathName.substring(1, pathName-1);
            }
        },
        methods: {
             moment(date) {
                if(date) {
                    return moment(date);
                }

                return moment();
            },
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
