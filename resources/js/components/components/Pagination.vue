<template>
    <div v-if="pages>1" class="paginate text-center">
        <nav class="d-flex justify-content-center ">
            <span class="paginate-btn" @click="prevPage()" :class="{'text-muted': (currentPage <= 1 ),  'fw-bold pointer': currentPage > 1}">قبلی</span>
            <br class="d-md-none">
            <span :class="{'text-primary': item == currentPage}" :id="'page_'+item "
                  v-for="item in labels" :key="item" @click="goToPage(item)"
                  class="paginate-btn pointer fs-6 fw-bold page_number mx-3">{{ item }}</span>
            <br class="d-md-none">
            <span class="paginate-btn" @click="nextPage()" :class="{'text-muted': currentPage >= pages, 'fw-bold pointer': currentPage < pages}">بعدی</span>
        </nav>
<!--        <p class="text-black-50 mt-2">{{ 'page ' + currentPage+'of' + pages}}</p>-->
        <p class="text-black-50 mt-2">{{ 'صفحه ' + currentPage+' از ' + pages}}</p>

    </div>

</template>

<script>
import {onMounted, ref} from "vue";

export default {
    props: ['page','pages','total','labels','load'],
    name: "Pagination",
    setup(props){
        const currentPage = ref(1);
        const total_pages = ref(1);



        const goToPage = (i) => {
            if (0 < i <= total_pages.value) {
                currentPage.value = i;
                props.load(currentPage.value);
            }
        };
        const prevPage = () => {
            if (currentPage.value > 1) {
                currentPage.value -= 1;
                props.load(currentPage.value);


            }
        };
        const nextPage = () => {
            // console.log('props',props.pages);
            if (currentPage.value < props.pages) {
                currentPage.value += 1;
                props.load(currentPage.value);


            }
        };

        // onMounted(()=>{
        //     // currentPage.value = props.page;
        //     // total_pages.value = props.pages;
        //
        // })
        return{
            currentPage, total_pages, goToPage, prevPage, nextPage,
        }
    }
}
</script>

<style scoped>

</style>
