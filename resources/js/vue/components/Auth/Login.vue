<template>
    <div class="w-50 m-auto">
       <div class="card card-body">
            <form>
            <div class="form-group mt-3 ">
                <label for="email"></label>
                <input type="text"
                    name="email"
                    placeholder="Enter your e-mail..."
                    class="form-control"
                    v-model="email">
            </div>
            <div class="form-group mt-3 ">
                <label for="password"></label>
                <input type="password"
                    name="password"
                    placeholder="Enter your password..."
                    class="form-control"
                    v-model="password">
            </div>
                <div class="card border-danger w-50 mt-3 mb-3" v-for="error in errors" :key="error">
                    {{ error }}
                </div>
            <button type="submit" class="btn btn-primary mt-3 btn-block" :disabled="loading" @click.prevent="login">Log-in</button>
        </form>

       </div>
    </div>
</template>
<script>
import { logIn } from "../../../shared/utils/auth";
export default{
    data() {
        return {
            email: null,
            password: null,
            loading:false,
            errors: []
        }
    },
    methods: {
        async login() {
            this.loading = true;
            this.errors = null;
            try {
                await axios.get('/sanctum/csrf-cookie');
                await axios.post("/login", {
                    email: this.email,
                    password: this.password
            });
            logIn();
            this.$store.dispatch("loadUser");
            this.$router.push({ name: "patients"});
            } catch (err) {
                this.errors = err.response.data.errors;
            }

            this.loading = false;
        }
    }

}
</script>
