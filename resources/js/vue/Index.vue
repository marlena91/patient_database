<template>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link class="navbar-brand mr-auto" :to="{ name: 'patients' }"><h1>Etermed</h1></router-link>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'patients' }">Baza pacjentów</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'diseases' }">Baza chorób</router-link>
                    </li>
                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link class="nav-link" :to="{ name: 'login' }">Logowanie</router-link>
                    </li>
                    <li class="nav-item" v-else>
                        <a class="nav-link" href="#" @click.prevent="logout">Wyloguj</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>

    </div>
</template>
<script>
import {mapState} from 'vuex';

export default {
    data() {
        return {}
    },
    computed: {
        ...mapState({
            isLoggedIn: "isLoggedIn",
            user: "user",
        })
    },
    methods: {
        async logout() {
            try {
                axios.post("/logout");
                this.$store.dispatch("logout");
            } catch (error) {
                this.$store.dispatch("logout");
            }
        }
    }

}
</script>
