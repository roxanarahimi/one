<template>
    <outer>
        <h1> this is test</h1>
    </outer>

</template>

<script>
import {onMounted, ref} from 'vue';
import Outer from './Test1';
    export default {
        components: {Outer},
        name: "test",
        setup(){

            onMounted(()=>{
                console.log('xxx')
            })
        }


    }
</script>

<style scoped>

</style>
