<template>
    <transition name = "route" mode = "out-in" appear>
        <section>
            <h3 class = "mb-5">سفارش ها
                <!--                <router-link to = "/panel/new/product" class = "text-dark">-->
                <!--                    <span title = "ثبت محصول جدید" class = "px-3 d-inline-block align-middle"><i class = "bi bi-plus-circle-fill p-0 mt-2 m-0" style = "font-size: 15px"></i></span>-->
                <!--                </router-link>-->
            </h3>

            <div class = "row mt-3">
                <div class = "mb-3">
                    <div v-if = "allData.length" class = "card">
                        <div class = "card-body">
                            <table class = "table">
                                <thead>
                                <tr>
                                    <th class = "d-none d-md-table-cell" scope = "col"></th>
                                    <th scope = "col">کد سفارش</th>
                                    <th scope = "col">کاربر</th>
                                    <th scope = "col">مبلغ</th>
                                    <th scope = "col">پرداخت</th>
                                    <th scope = "col" class = "status_cell">وضعیت</th>
                                    <th class = "d-none d-md-table-cell date_cell" scope = "col">تاریخ ثبت</th>
                                    <th scope = "col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr :id = "'row_'+data.id" v-for = "(data, index) in allData" :key = "data.id" :data-index = "index">
                                    <td class = "d-none d-md-table-cell" scope = "row">{{ index + 1 }}</td>

                                    <td>
                                        <router-link :to = "'/panel/order/'+data.id">{{ data.code }}</router-link>
                                    </td>
                                    <td>
                                        <router-link :to = "'/panel/user/'+data.user.id">{{ data.user.name }}
                                        </router-link>
                                    </td>

                                    <td>{{ data.amount }}</td>
                                    <td>
                                        {{ data.payment }}
                                    </td>

                                    <td class = "pt-0 status_cell">
                                        <p class = "m-0 mb-1">{{ data.status}}</p>
                                        <div class = "progress w-100 order_status " style = "height: 5px; ">
                                            <div
                                                :class = "'progress-bar order_status rounded ' + data.color"
                                                role = "progressbar"
                                                :style = "'width: '+ data.percent+'%'"
                                                :aria-valuenow = "data.percent"
                                                aria-valuemin = "0"
                                                aria-valuemax = "100"></div>
                                        </div>
                                    </td>
                                    <td class = "d-none d-md-table-cell date_cell">{{ data.created_at }}</td>

                                    <td>
                                        <span role = "button" data-bs-toggle = "dropdown" aria-expanded = "false"><i class = "bi bi-three-dots-vertical"></i></span>
                                        <ul class = "dropdown-menu" aria-labelledby = "navbarScrollingDropdown">
                                            <!--                                            <li>-->
                                            <!--                                                <a class = "dropdown-item" style = "text-align: right !important" href = "#">مشاهده</a>-->
                                            <!--                                            </li>-->
                                            <!--                                             <li>-->
                                            <!--                                                <a class = "dropdown-item" style = "text-align: right !important" href = "#">ویرایش</a>-->
                                            <!--                                            </li>-->
                                            <li>
                                                <router-link :to = "'/panel/order/'+data.id" class = "dropdown-item" style = "text-align: right !important">
                                                    مشاهده
                                                </router-link>
                                                <!--                                                <router-link :to = "'/panel/edit/order/'+data.id" class = "dropdown-item" style = "text-align: right !important">-->
                                                <!--                                                    ویرایش-->
                                                <!--                                                </router-link>-->
                                                <!--                                                <a class = "dropdown-item" @click = "showDeleteModal(data.id)" style = "text-align: right !important" data-bs-toggle = "modal" data-bs-target = "#exampleModal">حذف</a>-->
                                            </li>
                                            <!--                                <li><hr class="dropdown-divider"></li>-->
                                            <!--                                <li><a class="dropdown-item" href="#">Something else here</a></li>-->
                                        </ul>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-else><p class = "fw-bold">هیچ سفارشی موجود نیست</p></div>
                </div>
            </div>
        </section>
    </transition>
    <!-- Modal -->
    <div class = "modal fade" id = "exampleModal" tabindex = "-1" aria-labelledby = "exampleModalLabel" aria-hidden = "true">
        <div class = "modal-dialog md">
            <div class = "modal-content">
                <div class = "modal-header border-0">
                    <!--                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                    <button type = "button" class = "btn-close" data-bs-dismiss = "modal" aria-label = "Close"></button>
                </div>
                <div class = "modal-body">
                    آیا محصول مورد نظر حذف شود؟

                </div>
                <div class = "modal-footer border-0">
                    <input type = "hidden" id = "deleteId">
                    <button type = "button" class = "btn btn-dark" data-bs-dismiss = "modal" @click = "deleteInfo">بله
                    </button>
                    <button type = "button" class = "btn btn-secondary" data-bs-dismiss = "modal">نه !</button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import App from '../App';

    export default {
        data: function () {
            return {
                allData: [],

            }
        },

        mounted() {
            this.loadProducts();
        },
        methods: {
            async loadProducts() {
                // App.methods.checkToken();

                // axios.post('/api/panel/check/user/token', {id: JSON.parse(localStorage.getItem('user')).id})
                //     .then((response) => {
                //         if (response.status === 200) {
                //             localStorage.setItem('expire', response.data.expire);
                //             console.log(localStorage);
                await App.methods.checkToken();

                await axios.get('/api/panel/order').then((response) => {
                    this.allData = response.data;
                    console.log(this.allData);
                }).catch();
                //     }
                // })
                // // .catch((error) => {
                //     if (error.status === 401) {
                //         window.location = '/panel/login'
                //         App.methods.logout();
                //     }
                // });
            },
            async showDeleteModal(id) {
                // axios.post('/api/panel/check/user/token', {id: JSON.parse(localStorage.getItem('user')).id})
                //     .then((response) => {
                // //         if (response.status === 200) {
                //             localStorage.setItem('expire', response.data.expire);
                //             console.log(localStorage);

                //     }
                // })
                // .then(() => {
                await App.methods.checkToken();
                document.getElementById('deleteId').value = id;
                // })
                // .catch((error) => {
                //     if (error.status === 401) {
                //         window.location = '/panel/login'
                //         App.methods.logout();
                //     }
                // });
            },
            async deleteInfo() {
                // axios.post('/api/panel/check/user/token', {id: JSON.parse(localStorage.getItem('user')).id})
                //     .then((response) => {
                //         if (response.status === 200) {
                //             localStorage.setItem('expire', response.data.expire);
                //             console.log(localStorage);
                //         }
                //     })
                //     .then(() => {

                await axios.post('/api/panel/delete/order/', {
                    id: document.getElementById('deleteId').value,
                })
                    .then((response) => {
                        console.log(response.data)
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                // })
                // .catch((error) => {
                //     if (error.status === 401) {
                //         window.location = '/panel/login'
                //         App.methods.logout();
                //     }
                // });

                await this.loadProducts();
            },
            async pActiveToggle(id) {
                // axios.post('/api/panel/check/user/token', {id: JSON.parse(localStorage.getItem('user')).id})
                //     .then((response) => {
                //         if (response.status === 200) {
                //             localStorage.setItem('expire', response.data.expire);
                //             console.log(localStorage);
                //         }
                //     })
                //     .then(() => {
                await App.methods.checkToken();
                await axios.get('/api/panel/active/order/' + id)
                    .then((response) => {
                        console.log(response.data)
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                await this.loadProducts();
                // })
                // .catch((error) => {
                //     if (error.status === 401) {
                //         window.location = '/panel/login'
                //         App.methods.logout();
                //     }
                // });

            }

        }
    }
</script>
<style>

    .date_cell {
        direction: ltr !important;
        text-align: right !important;
    }


    .text_cell {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 30ch;

    }

    .active_cell {
        width: 60px;
        text-align: center;
    }
</style>
