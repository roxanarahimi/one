<template>
    <transition name = "route" mode = "out-in" appear>
        <section class = "" v-if = "data" style = "text-align: justify">
            <div class = "row index_image">
                <div class = "col-xl-5 mb-3 h-100 index_image ">
                    <img class = "img-fluid mb-2" :src = "data.image" alt = "">
                    <div class = "label">
                       <span class = "badge bg-danger">
                           <i class = "bi bi-tags-fill ms-2"></i>
                           <b v-if = "data.category">  {{ data.category.title}}</b>
                       </span>
                    </div>


                    <div class = "d-inline-block">
                        <h3 class = "mb-2 fw-bold d-block">{{data.title}}</h3>
                        <p class = "mb-2 fw-bold d-block">{{data.subTitle}}</p>
                    </div>
                    <router-link :to = "'/panel/edit/product/'+data.id" class = "text-dark">
                <span title = "ویرایش محصول" class = "mx-3 p-2 d-inline-block align-middle bg-dark text-light rounded-circle">
                    <i class = "bi bi-pencil p-0 edit-pen"></i>
                </span>
                    </router-link>
                </div>
                <div class = "col-xl-7 mb-3 h-100">
                    <div class = "card ">
                        <div class = "card-body p-md-5">
                            <div class = "row">
                                <div class = "col-lg-12">
                                    <h5>سایز بندی</h5>
                                    <ul v-if = "data.sizes">
                                        <li style = "list-style: none" v-for = "item in data.sizes" :key = "item.id">
                                            <b>{{ item.size}}: </b>{{ item.dimensions }} , {{ item.color_name }}
                                            <span class = "me-2 color-span border d-inline-block"
                                                  :style = "'background-color:'+ item.color_code+';'"

                                            ></span>
                                            موجودی: {{ item.stock}} عدد
                                        </li>
                                    </ul>
                                </div>
                                <div class = "col-lg-12">
                                    <h5>ویژگی ها</h5>
                                    <ul v-if = "features">
                                        <li style = "list-style: none" v-for = "item in features" :key = "item">
                                            <b>{{ item.label}}: </b>{{ item.value }}
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class = "col-xl-12 mb-3 ">
                    <div class = "card ">
                        <div class = "card-body p-md-5">

                            <div id = "text" class = "mb-5"></div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <div v-else><p class = "fw-bold">این محصول موجود نیست</p></div>

    </transition>


</template>

<script>
    import App from '../App';

    export default {
        data: function () {
            return {
                data: {},
                id: this.$route.params.id,
                features: [],

            }
        },
        mounted() {
            this.loadProduct();
        },
        methods: {
          async loadProduct() {
                // axios.post('/api/panel/check/user/token', {id: JSON.parse(localStorage.getItem('user')).id})
                //     .then((response) => {
                //         if (response.status === 200) {
                //             localStorage.setItem('expire', response.data.expire);
                //             console.log(localStorage);
                //         }
                //     })
                //     .then(() => {
              await App.methods.checkToken();
              await axios.get('/api/panel/product/' + this.id)
                    .then((response) => {
                        this.data = response.data.product;
                        document.getElementById('text').innerText = this.data.text;
                        if (this.data.features) {
                            for (let i = 0; i < JSON.parse(this.data.features).length; i++) {
                                this.features.push(JSON.parse(this.data.features)[i]);
                            }
                        }
                    })
                //         .catch();
                // })
                // .catch((error) => {
                //     if (error.response.status === 401) {
                //         window.location = '/panel/login'
                //         App.methods.logout();
                //     }
                // });
            },

        }
    }
</script>
<style>
    .color-span {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-bottom: -5px;
    }

    #content p {
        text-align: justify !important;
        line-height: 30px !important;
        padding-left: 10px;

    }

    #content figure {
        text-align: center !important;
        display: block !important;
    }

    #content figure figcaption {
        text-align: center !important;
    }

    .index_image .label {
        display: block;
        font-size: 20px;
        margin: -50px 20px 50px 20px;
    }

    #content figure img {
        max-width: 100%;
    }

    /*.index_image span{*/
    /*    display: inline-block;*/
    /*    right:20px;*/
    /*    bottom: 20px;*/
    /*}*/
    .edit-pen {
        font-size: 12px;
        margin: 0 6px !important;
    }
</style>
