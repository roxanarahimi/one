<template>
    <transition name = "route" mode = "out-in" appear>
        <section>
            <h3 class = "mb-5">مدیران
                <!--                <router-link to = "/panel/new/client" class = "text-dark">-->
                <!--                    <span title = "ثبت مدیر جدید" class = "px-3 d-inline-block align-middle"><i class = "bi bi-plus-circle-fill p-0 mt-2 m-0" style = "font-size: 15px"></i></span>-->
                <!--                </router-link>-->
            </h3>
            <div class = "row mt-3">
                <div class = "col-12 mb-3">
                    <div v-if = "allData.length" class = "card">
                        <div class = "card-body">
                            <table class = "table">
                                <thead>
                                <tr>
                                    <th scope = "col"></th>
                                    <th scope = "col">نام</th>
                                    <th scope = "col">ایمیل</th>
                                    <th class = "d-none d-md-table-cell" scope = "col">تاریخ ثبت</th>
                                    <th scope = "col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr :id = "'row_'+data.id" v-for = "(data, index) in allData" :key = "data.id" :data-index = "index">
                                    <td scope = "row">{{ index + 1 }}</td>

                                    <td>{{ data.name }}</td>
                                    <td class = "ellipsis pe-md-5 en" :title = "data.email">{{ data.email }}</td>

                                    <td class = "d-none d-md-table-cell ">{{ data.created_at }}</td>
                                    <td>
                                        <span role = "button" data-bs-toggle = "dropdown" aria-expanded = "false"><i class = "bi bi-three-dots-vertical"></i></span>
                                        <!--                                        <ul class = "dropdown-menu" aria-labelledby = "navbarScrollingDropdown">-->
                                        <!--&lt;!&ndash;                                            <li>&ndash;&gt;-->
                                        <!--&lt;!&ndash;                                                &lt;!&ndash;                                                <router-link :to = "'/panel/data/'+data.id" class = "dropdown-item" style = "text-align: right !important">&ndash;&gt;&ndash;&gt;-->
                                        <!--&lt;!&ndash;                                                &lt;!&ndash;                                                    مشاهده&ndash;&gt;&ndash;&gt;-->
                                        <!--&lt;!&ndash;                                                &lt;!&ndash;                                                </router-link>&ndash;&gt;&ndash;&gt;-->
                                        <!--&lt;!&ndash;                                                &lt;!&ndash;                                                <router-link :to = "'/panel/edit/data/'+data.id" class = "dropdown-item" style = "text-align: right !important">&ndash;&gt;&ndash;&gt;-->
                                        <!--&lt;!&ndash;                                                &lt;!&ndash;                                                    ویرایش&ndash;&gt;&ndash;&gt;-->
                                        <!--&lt;!&ndash;                                                &lt;!&ndash;                                                </router-link>&ndash;&gt;&ndash;&gt;-->
                                        <!--&lt;!&ndash;&lt;!&ndash;                                                <a class = "dropdown-item" @click = "showDeleteModal(data.id)" style = "text-align: right !important" data-bs-toggle = "modal" data-bs-target = "#exampleModal">حذف</a>&ndash;&gt;&ndash;&gt;-->
                                        <!--&lt;!&ndash;                                            </li>&ndash;&gt;-->
                                        <!--                                            &lt;!&ndash;                                <li><hr class="dropdown-divider"></li>&ndash;&gt;-->
                                        <!--                                            &lt;!&ndash;                                <li><a class="dropdown-item" href="#">Something else here</a></li>&ndash;&gt;-->
                                        <!--                                        </ul>-->
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-else><p class = "fw-bold">هیچ مدیری موجود نیست</p></div>
                </div>
            </div>
        </section>
    </transition>
    <!-- Modal -->
    <div class = "modal fade" id = "exampleModal" tabindex = "-1" aria-labelledby = "exampleModalLabel" aria-hidden = "true">
        <div class = "modal-dialog modal-sm">
            <div class = "modal-content">
                <div class = "modal-header border-0">
                    <!--                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                    <button type = "button" class = "btn-close" data-bs-dismiss = "modal" aria-label = "Close"></button>
                </div>
                <div class = "modal-body">
                    آیا مدیر مورد نظر حذف شود؟

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
            this.loadAllData();
        },
        methods: {
            async loadAllData() {
                //    localStorage.setItem('state', '0');
                // App.methods.checkToken();
                // axios.post('/api/panel/check/user/token', {id: JSON.parse(localStorage.getItem('user')).id})
                //     .then((response) => {
                //         if (response.status === 200) {
                //             localStorage.setItem('expire', response.data.expire);
                //             console.log(localStorage);
                //         }
                //     })
                //     .then(() => {
                await App.methods.checkToken();
                await setTimeout(()=> {
                    axios.get('/api/panel/admins')
                        .then((response) => {
                            this.allData = response.data;
                        })
                        .catch();
                },1000)
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
    .ellipsis {

        direction: ltr !important;
        cursor: pointer;
    }

    @media only screen and (max-width: 768px) {

        .ellipsis {
            max-width: 120px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            text-align: left !important;
        }
    }

</style>
