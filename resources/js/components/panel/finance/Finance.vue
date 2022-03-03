<template>
    <transition name = "route" mode = "out-in" appear>
        <section>
            <h3 class = "mb-5">تراکنش ها
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
                                    <th scope = "col">کاربر</th>
                                    <th scope = "col">مبلغ</th>
                                    <th scope = "col">وضعیت</th>
                                    <th scope = "col">توضیحات</th>
                                    <th class = "d-none d-md-table-cell date_cell" scope = "col">تاریخ ثبت</th>
                                    <th scope = "col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr :id = "'row_'+data.id" v-for = "(data, index) in allData" :key = "data.id" :data-index = "index">
                                    <td class = "d-none d-md-table-cell" scope = "row">{{ index + 1 }}</td>
                                    <td>
                                        <router-link :to = "'/panel/user/'+data.order.user_id">{{ data.order.user.name }}
                                        </router-link>
                                    </td>
                                    <td>{{ data.amount }}</td>
                                    <td>
                                        {{ data.status }}
                                    </td>
                                    <td>
                                        {{ data.description }}
                                    </td>

                                    <td class = "d-none d-md-table-cell date_cell">{{ data.created_at }}</td>

                                    <td>
<!--                                        <span role = "button" data-bs-toggle = "dropdown" aria-expanded = "false"><i class = "bi bi-three-dots-vertical"></i></span>-->
<!--                                        <ul class = "dropdown-menu" aria-labelledby = "navbarScrollingDropdown">-->
<!--                                            &lt;!&ndash;                                            <li>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                                <a class = "dropdown-item" style = "text-align: right !important" href = "#">مشاهده</a>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                            </li>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                             <li>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                                <a class = "dropdown-item" style = "text-align: right !important" href = "#">ویرایش</a>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                            </li>&ndash;&gt;-->
<!--                                            <li>-->
<!--                                                <router-link :to = "'/panel/order/'+data.id" class = "dropdown-item" style = "text-align: right !important">-->
<!--                                                    مشاهده-->
<!--                                                </router-link>-->
<!--                                                &lt;!&ndash;                                                <router-link :to = "'/panel/edit/order/'+data.id" class = "dropdown-item" style = "text-align: right !important">&ndash;&gt;-->
<!--                                                &lt;!&ndash;                                                    ویرایش&ndash;&gt;-->
<!--                                                &lt;!&ndash;                                                </router-link>&ndash;&gt;-->
<!--                                                &lt;!&ndash;                                                <a class = "dropdown-item" @click = "showDeleteModal(data.id)" style = "text-align: right !important" data-bs-toggle = "modal" data-bs-target = "#exampleModal">حذف</a>&ndash;&gt;-->
<!--                                            </li>-->
<!--                                            &lt;!&ndash;                                <li><hr class="dropdown-divider"></li>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                <li><a class="dropdown-item" href="#">Something else here</a></li>&ndash;&gt;-->
<!--                                        </ul>-->
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-else><p class = "fw-bold">هیچ تراکنشی موجود نیست</p></div>
                </div>
            </div>
        </section>
    </transition>
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
                await App.methods.checkToken();
                await axios.get('/api/panel/finance').then((response) => {
                    this.allData = response.data;
                    console.log(this.allData);
                }).catch();
            },
            async showDeleteModal(id) {
                await App.methods.checkToken();
                document.getElementById('deleteId').value = id;
            },
            async deleteInfo() {
                await axios.post('/api/panel/delete/order/', {
                    id: document.getElementById('deleteId').value,
                })
                    .then((response) => {
                        console.log(response.data)
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                await this.loadProducts();
            },
            async pActiveToggle(id) {
                await App.methods.checkToken();
                await axios.get('/api/panel/active/order/' + id)
                    .then((response) => {
                        console.log(response.data)
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                await this.loadProducts();
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
