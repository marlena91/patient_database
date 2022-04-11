<template>
    <div>
        <div>
            <div class="card-body">
                <div class="card-title"> 
                    <p>{{ id }}. {{ name }} </p>
                </div> 
            </div>
        </div>
    </div>
</template>
<script>

export default{
    props: { id: Number, name: String }
}
</script>