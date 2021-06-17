<template>
    <div>
        <h4 class="text-center">USUÁRIOS</h4><br/>
        <button type="button" class="btn mb-3 btn-info" @click="this.$router.push('/user/add')">Cadastrar</button>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td width="60px" class="text-center">
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edituser', params: { id: user.id }}" class="btn btn-primary">Editar</router-link>
                        <button v-if="user.id == id" class="btn btn-secondary">Excluir</button>
                        <button v-else class="btn btn-danger" @click="deleteUser(user.id)">Excluir</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            id: null
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/user/users')
                .then(response => {
                    this.users = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        }),
        this.id = window.Laravel.user.id
    },
    methods: {
        deleteUser(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/user/delete/${id}`)
                    .then(response => {
                        let i = this.users.map(item => item.id).indexOf(id); // find index of your object
                        this.users.splice(i, 1)
                    })
                    .catch(function (error) {
                        console.error(error);
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
