<template>
    <div>
        <h1>hello</h1>
    </div>
  
</template>

<script>
export default {
    name: 'HelloWorld',
    data() {
        return {
            msg: 'Welcome to Your Vue.js App'
        }
    },
    mounted() {
        console.log(this.msg)
    }

}
</script>

<style>

</style>