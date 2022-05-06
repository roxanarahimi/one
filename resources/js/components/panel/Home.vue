<template>
    <!--<h3>داشبورد</h3>-->
    <transition name="route" mode="out-in" appear>
        <section>
            <div class="row d-none">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 ">
                                    <div class="rounded bg-light text-primary text-center p-3"
                                         style="width: 50px; height: 50px">
                                        <i style="font-size: 20px" class="bi bi-eye-fill "></i>
                                    </div>
                                    <!--                                    <small class=" d-block">بازدید سایت</small>-->
                                </div>
                                <div class="col-6 ">
                                    <h1 class="mt-2 text-start">23659</h1>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 ">
                                    <div class="rounded bg-light text-primary text-center p-3"
                                         style="width: 50px; height: 50px">
                                        <i style="font-size: 20px" class="bi bi-eye-fill "></i>
                                    </div>
                                    <!--                                    <small class=" d-block">بازدید سایت</small>-->
                                </div>
                                <div class="col-6 ">
                                    <h1 class="mt-2 text-start">23659</h1>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 ">
                                    <div class="rounded bg-light text-primary text-center p-3"
                                         style="width: 50px; height: 50px">
                                        <i style="font-size: 20px" class="bi bi-eye-fill "></i>
                                    </div>
                                    <!--                                    <small class=" d-block">بازدید سایت</small>-->
                                </div>
                                <div class="col-6 ">
                                    <h1 class="mt-2 text-start">23659</h1>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 ">
                                    <div class="rounded bg-light text-primary text-center p-3"
                                         style="width: 50px; height: 50px">
                                        <i style="font-size: 20px" class="bi bi-eye-fill "></i>
                                    </div>
                                    <!--                                    <small class=" d-block">بازدید سایت</small>-->
                                </div>
                                <div class="col-6 ">
                                    <h1 class="mt-2 text-start">23659</h1>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div v-if="allData.length > 0">
                <!--                                <p>در حال بارگذاری...</p>-->

                <p class="h4 mb-5">جدیدترین محصولات</p>
                <div class="row mt-3">
                    <router-link :to="'/panel/product/'+ data.id" v-for="data in allData"
                                 class="col-md-8 col-xl-4 mb-3 blog">
                        <div class="card ">
                            <div class="blog-img rounded-top ">
                                <img v-if="data.images" :src="data.images[0]" class="card-img-top" alt="">
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

            </div>
            <loader v-else />


        </section>
    </transition>
</template>
<script>
import App from './App';
import Loader from "../site/components/Loader";

export default {
    components: {Loader},
    data: function () {
        return {
            allData: [],

        }
    },
    mounted() {
        document.querySelector('#admin_label').innerHTML = JSON.parse(localStorage.getItem('admin')).name;
        this.loadBlogs();

        console.log(localStorage)


    },
    methods: {
        async loadBlogs() {
            await App.methods.checkToken();
            await axios.get('/api/panel/latest/product')
                .then((response) => {
                    this.allData = response.data;
                })
                .then(() => {
                    console.log(this.allData);
                })
                .catch();
        }


    }
}

</script>
<style>
.blog-img {
    /*min-height: 200px;*/
    /*background: whitesmoke;*/
}

.blog, .blog:hover {
    color: black;
    text-decoration: none;
}

#spin {
    /*margin: 20px;*/
    /*width: 100px;*/
    /*height: 100px;*/
    /*background: #f00;*/
    -webkit-animation-name: spin;
    -webkit-animation-duration: 1500ms;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    -moz-animation-name: spin;
    -moz-animation-duration: 1500ms;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
    -ms-animation-name: spin;
    -ms-animation-duration: 1500ms;
    -ms-animation-iteration-count: infinite;
    -ms-animation-timing-function: linear;

    animation-name: spin;
    animation-duration: 1500ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@-moz-keyframes spin {
    from {
        -moz-transform: rotate(0deg);
    }
    to {
        -moz-transform: rotate(360deg);
    }
}

@-webkit-keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.pointer {
    cursor: pointer;
}
</style>
