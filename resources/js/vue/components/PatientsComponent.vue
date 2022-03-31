<template>
    <div>
        <div>
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>LastName</th>
                    <th>Pesel</th>
                    <th>Birthday</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tr v-for="patient in patients" :key="patient.id">
                    <td>{{ patient.name }}</td>
                    <td>{{ patient.lastname }}</td>
                    <td>{{ patient.pesel }}</td>
                    <td>{{ patient.birthday }}</td>
                    <td>edit</td>
                    <td>delete</td>

                </tr>
            </table>
        </div>
    </div>
</template>
<script>
    export default {
        components: {},
        data() {
            return {
                patients: []
            };
        },
        computed: {
        },
        methods: {
        },
        created() {
            const p = new Promise((resolve, reject) => {
                console.log(resolve);
                console.log(reject);
                setTimeout(() => resolve("hi"), 3000);
            })
            .then(result => "Again " + result)
            .then(result => console.log(`Success ${result}`))
            .catch(result =>console.log(`Error ${result}`));
            console.log(p);

            const request = axios
                .get("/api/patients")
                .then(response => (this.patients = response.data));
        },
        props: {},

                // filters: {
                //     properCase(string) {
                //         return string.charAt(0).toUpperCase() + string.slice(1);
                //     }
                // }
    };
</script>
<style scoped>
table {
    width: 800px;
    margin: 50px auto;
}
th, td {
    width: 150px;
    height: 50px;
    text-align: center;
}
</style>