<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default my-5">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="alert alert-danger mb-3" role="alert" v-if="error !== null">
                            {{ error }}
                        </div>

                        <form>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" :class="{ 'is-invalid': errors.get('email') }" v-model="email" required
                                           autofocus autocomplete="off">
                                    <span v-text="errors.get('email')" class="invalid-feedback d-block"></span> <!-- Handling validation messages -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" :class="{ 'is-invalid': errors.get('password') }" v-model="password"
                                           required autocomplete="off">
                                    <span v-text="errors.get('password')" class="invalid-feedback d-block"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // Handling validation messages
    class Errors {
        constructor(){
            this.errors = {};
        }
        get(field){
            if (this.errors[field]){
                return this.errors[field][0];
            }
        }
        record(errors){
            this.errors = errors;
        }
    }

export default {
    data() {
        return {
            email: "",
            password: "",
            error: null,
            errors: new Errors() // Handling validation messages
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                axios.get('/api/sanctum/csrf-cookie').then(response => {
                    console.log(response);
                    axios.post('/api/login', {
                        email: this.email,
                        password: this.password
                    })
                        .then(response => {
                            if (response.data.success) {
                                this.$router.go('/')
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch( error => this.errors.record(error.response.data.errors) ) // Handling validation messages
                })
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next('/');
        }
        next();
    }
}
</script>
