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
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</template>
<script>
    export default {
        computed: {

        },
        methods: {

        }, 
        props: ['id', 'pesel', 'name', 'lastname', 'birthday'],
        filters: {
            properCase(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        }
    }
</script>