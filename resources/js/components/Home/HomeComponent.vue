<template>
    <div>
        <latest-recipes :latestthreerecipes="latestThreeRecipesToShow"></latest-recipes>
        <most-popular-recipes :threemostpopularrecipes="threeMostPopularRecipesToShow"></most-popular-recipes>
    </div>
</template>

<script>
export default {
    data() {
        return {
            latestThreeRecipes: [],
            threeMostPopularRecipes: [],
            searchTerm: ''
        }
    },
    created() {
        this.latestThreeRecipes = this.recipes.latestThreeRecipes;
        this.threeMostPopularRecipes = this.recipes.threeMostPopularRecipes;

        window.eventBus.$on('searchEvent', this.handleSearchEvent)

    },
    methods: {
        handleSearchEvent(value) {
            this.searchTerm = value;
        }
    },
    props: {
        recipes: {
            type: Object
        }
    },
    computed: {
        latestThreeRecipesToShow() {
            return this.latestThreeRecipes.filter(recipe => {
                return recipe.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    recipe.user.toLowerCase().includes(this.searchTerm.toLowerCase());
            })
        },
        threeMostPopularRecipesToShow() {
            return this.threeMostPopularRecipes.filter(recipe => {
                return recipe.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    recipe.user.toLowerCase().includes(this.searchTerm.toLowerCase());
            })
        }
    }


}
</script>
