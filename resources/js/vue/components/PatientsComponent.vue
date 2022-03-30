<template>
    <div>
        <div>
            <table>
                <tr>
                    <th>Name</th>
                    <th>LastName</th>
                    <th>Pesel</th>
                    <th>Birthday</th>
                </tr>
                <tr>
                    <td>{{ name }}</td>
                    <td>{{ lastName }}</td>
                    <td>{{ pesel }}</td>
                    <td>{{ birthday }}</td>

                </tr>
            </table>
        </div>
    </div>
</template>
<script>
// module.exports = {
//     data: function () {
//         return {
//             greeting: "Hello"
//         }
//     }
// }
    export default {
        computed: {

        },
        methods: {

        },  
        props: {
            'name': String,
            'lastName': String,
            'pesel': Number, 
            'birthday': Number,
        },
        mounted() {
        }

        // filters: {
        //     properCase(string) {
        //         return string.charAt(0).toUpperCase() + string.slice(1);
        //     }
        // }
    }
</script>
<style scoped>
th {
    width: 150px;
    text-align: center;
}
</style>