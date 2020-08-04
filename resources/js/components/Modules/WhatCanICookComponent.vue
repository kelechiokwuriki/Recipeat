<template>
    <div>
        <div class="border-bottom mb-3 p-2">
            <h4>Got ingredients but don't know what to cook?</h4>
        </div>
        <transition name="fade" appear>
            <div class="container mt-3">
                <div class="card-box">
                    <h4 class="mt-0 mb-3 header-title">Add your recipes separated by a comma</h4>
                    <input-tag placeholder="Add Recipe Tag" v-model="recipeTags"></input-tag>


                </div>
        </div>
    </transition>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                recipeTags: [],
                result: []
            }
        },
        watch: {
            recipeTags: {
                deep: true,
                handler(value) {
                    console.log(value);
                }
            }
        }
    }
</script>
