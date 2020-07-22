<template>
    <div class="container-fluid">
        <div class="border-bottom mb-3 p-2">
            <h4>Most Popular Recipes</h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-3 mr-0">

                <!-- Simple card -->
                <div class="card shadow-lg" style="width: 20rem;">
                    <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Card title</h4>
                        <p class="card-text"></p>
                        <a href="#" class="btn btn-primary">Button</a>
                    </div>
                </div>

            </div><!-- end col -->

            <div class="col-xl-3 mr-0">

                <!-- Simple card -->
                <div class="card shadow-lg" style="width: 20rem;">
                    <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Card title</h4>
                        <p class="card-text"></p>
                        <a href="#" class="btn btn-primary">Button</a>
                    </div>
                </div>

            </div><!-- end col -->

            <div class="col-xl-3">

                <!-- Simple card -->
                <div class="card shadow-lg" style="width: 20rem;">
                    <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Card title</h4>
                        <p class="card-text"></p>
                        <a href="#" class="btn btn-primary">Button</a>
                    </div>
                </div>

            </div><!-- end col -->
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
