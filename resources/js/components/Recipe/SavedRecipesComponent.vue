<template>
  <div>
        <div class="border-bottom mb-3 p-2">
            <h4>Saved Recipes</h4>
        </div>
        <div class="row">
            <div class="col-sm-3" v-for="recipe in recipesToShow"
                v-bind:key="recipe.recipe.id">
                    <recipe-component :recipe="recipe.recipe"></recipe-component>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchTerm: '',
            recipes: []
        }
    },
    props: {
        savedrecipes: {
            type: Array
        }
    },
    created() {
        this.recipes = this.savedrecipes;

        window.eventBus.$on('searchEvent', this.handleSearchEvent);
    },
    methods: {
        handleSearchEvent(value) {
            this.searchTerm = value;
        }
    },
    computed: {
        recipesToShow() {
            return this.recipes.filter(recipe => {
                return recipe.recipe.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    recipe.recipe.user.toLowerCase().includes(this.searchTerm.toLowerCase());
            })
        }
    }
}
</script>
