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

                <h4 class="text-center">EDITAR USUÁRIO</h4>

                    <form @submit.prevent="updateUser">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" v-model="user.name">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" class="form-control" v-model="user.email">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" class="form-control" v-model="user.password">
                        </div>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
            errors_exist: null,
            errors: null
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/user/edit/${this.$route.params.id}`)
                .then(response => {
                    this.user = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateUser() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/user/update/${this.$route.params.id}`, this.user)
                    .then(response => {
                        this.$router.push({name: 'users'});
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
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
