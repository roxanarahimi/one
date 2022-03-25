<template>
   <h1> this is test</h1>
<div v-for="item in data" :key="item.id">
    {{ item.name}}
</div>
</template>

<script>
    import {ref} from 'vue';
    export default {
        name: "test",
        async setup(){
            const data = ref(null)
            await axios.get('http://127.0.0.1:8000/api/panel/users')
                .then((response)=>{
                  // setTimeout(()=>{
                      data.value =  response.data;
                  // },2000)
                })
                .catch((error)=>{
                    console.log(error)
                });
            return{
                data,
            }
        }


    }
</script>

<style scoped>

</style>
