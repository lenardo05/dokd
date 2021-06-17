<template>
    <div class="container">
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <router-link to="/" class="nav-item nav-link"><img class="img_cad_users" src="/image/add-usuario.jpeg"></router-link>

            <div class="collapse navbar-collapse" v-if="isLoggedIn">
                <ul class="navbar-nav mr-auto">
                    <router-link to="/users" class="nav-item nav-link">Usuários</router-link>
                </ul>
                <ul class="navbar-nav">
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
                </ul>
            </div>
            <div class="collapse navbar-collapse" v-else>
                <ul class="navbar-nav mr-auto">

                </ul>
                <ul class="navbar-nav">
                    <router-link to="/login" class="nav-item nav-link">login</router-link>
                    <router-link to="/register" class="nav-item nav-link">Registrar</router-link>
                </ul>
            </div>

        </nav>
        <br/>
        <router-view/>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error)
                    });
            })
        }
    }
}
</script>
