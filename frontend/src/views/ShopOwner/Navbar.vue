
<template>
    <h1>dddd</h1>
</template>

<script>
export default {
    name: 'HelloWorld',
    props: {
        msg: {
            type: String,
            required: true
        }
    },
    mounted() {
        console.log(this.msg)
    }

}
</script>

<style>

</style>