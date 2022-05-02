<template>
    <p class="h4 mb-5">جدیدترین محصولات</p>

    <div class="row mt-3" v-if="allData.length">
        <router-link :to="'/panel/product/'+ data.id" v-for="data in allData" :key="data.id" class="col-md-8 col-xl-4 mb-3 blog">
            <div class="card ">
                <div class="blog-img rounded-top ">
                    <transition  name="zoom" mode="in-out" appear>
                        <img v-if="data.images" :src="data.images[0]"  class="card-img-top" alt="">
                    </transition>
                </div>
                <!--                        d-flex align-self-end-->
                <div class="card-body ">
                    <h5 class="card-title mt-4 mb-2 "> {{ data.title }} </h5>
                    <p class="card-text mb-4 d-inline-block align-bottom"><i class="bi bi-tag-fill"></i>
                        {{ data.category.title }} </p>
                    <p class="card-text mb-4 d-inline-block float-start align-bottom"> {{ data.added }} </p>
                </div>
            </div>
        </router-link>
    </div>

</template>

<script>
import {ref} from "vue";

export default {
    name: "ProductsLatest",
    async setup() {
        const allData = ref(null)
        await axios.get('http://127.0.0.1:8000/api/panel/latest/product')
            .then((response) => {
                // setTimeout(()=>{
                allData.value = response.data;
                // },2000)
            })
            .catch((error) => {
                console.log(error)
            });
        return {
            allData,
        }
    }
}

</script>

<style scoped>

</style>
