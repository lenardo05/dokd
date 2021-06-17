<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div v-if="errors_exist" class="alert alert-danger" role="alert">
                    <div v-for="(v, k) in errors" :key="k">
                        <p v-for="error in v" :key="error" class="text-sm">
                        {{ error }}
                        </p>
                    </div>
                </div>

                <div class="card mb-4 box-shadow">
                    <div class="card-header text-center">
                        <h4 class="my-0 font-weight-normal text-center">REGISTRAR</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Nome</label>
                                <div class="col-md-6">
                                    <input id="name" type="email" class="form-control" v-model="name" required
                                           autofocus autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required
                                           autofocus autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password"
                                           required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Registrar
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
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            errors_exist: null,
            errors: null
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()

                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('api/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password
                    })
                        .then(response => {
                            console.log(response);
                            if (response.data.success) {
                                window.location.href = "/login"
                            } else {
                                this.errors = response.data.message
                            }
                        })
                        .catch(error => {
                            this.errors_exist = true;
                            if(error.response.status === 422) {
                                this.errors = error.response.data.errors || {};
                            }
                        });
                })

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
