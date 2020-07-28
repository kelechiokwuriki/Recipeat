<template>
   <div>
        <div class="border-bottom mb-3 p-2">
            <h4>My Recipes</h4>
        </div>
        <div class="row">
            <div class="col-sm-3" v-for="recipe in recipesToShow"
                v-bind:key="recipe.id">
                    <recipe-component :recipe="recipe"></recipe-component>
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
        myrecipes: {
            type: Array
        }
    },
    created() {
        this.recipes = this.myrecipes;

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
                return recipe.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    recipe.user.toLowerCase().includes(this.searchTerm.toLowerCase());
            })
        }
    }
}
</script>


