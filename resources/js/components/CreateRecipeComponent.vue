<template>
    <div class="container mt-3">
        <div class="card-box">
            <h4 class="mt-0 mb-3 header-title">Add your favourite recipe</h4>

            <form role="form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <input id="checkbox0" type="checkbox">
                        <label for="checkbox0">
                            Check me out
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            moment(date) {
                if(date) {
                    return moment(date);
                }

                return moment();
             },
        }
    }
</script>

<style>
</style>
