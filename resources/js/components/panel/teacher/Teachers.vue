<template>
    <transition name = "route" mode = "out-in" appear>
        <section>
            <h3 class = "mb-5">آموزگاران
                <router-link to = "/panel/new/teacher" class = "text-dark">
                    <span title = "ثبت آموزگار جدید" class = "px-3 d-inline-block align-middle"><i class = "bi bi-plus-circle-fill p-0 mt-2 m-0" style = "font-size: 15px"></i></span>
                </router-link>
            </h3>

            <div class = "row mt-3">
                <div class = "col-12 mb-3">
                    <div v-if = "allData.length" class = "card">
                        <div class = "card-body">
                            <table class = "table">
                                <thead>
                                <tr>
                                    <th scope = "col"></th>
<!--                                    <th class = "d-none d-md-table-cell" style = "width: 100px" scope = "col">تصویر</th>-->
                                    <th scope = "col">نام</th>
                                    <th scope = "col">جنسیت</th>
                                    <th scope = "col">دوره های فعلی</th>
                                    <th scope = "col">تولد</th>
                                    <th class = "d-none d-md-table-cell" scope = "col">تاریخ ثبت</th>
                                    <th scope = "col" class = "active_cell">وضعیت</th>
                                    <th scope = "col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr :id = "'row_'+data.id" v-for = "(data, index) in allData" :key = "data.id" :data-index = "index">
                                    <td>{{ index + 1 }}</td>
<!--                                    <td class = "d-none d-md-table-cell" style = "width: 100px">-->
<!--                                        <img v-if = "data.image" :src = "data.image" width = "80" alt = "">-->
<!--                                        &lt;!&ndash;       tumb&ndash;&gt;-->
<!--                                    </td>-->
                                    <td>
                                        <router-link :to = "'/panel/teacher/'+data.id">{{ data.name }}</router-link>
                                    </td>
                                    <td>{{ data.gender }}</td>
                                    <!--        <td>{{ data.cources.count }}</td>-->
                                    <td> x </td>
                                    <td>{{ data.birth }}</td>

                                    <td class = "d-none d-md-table-cell date_cell">{{ data.created_at }}</td>
                                    <td class = "active_cell">
                                        <span @click = "pActiveToggle(data.id)" v-if = "data.active" class = "badge bg-success text-light"><i class = "bi bi-eye-fill"></i></span>
                                        <span @click = "pActiveToggle(data.id)" v-else class = "badge bg-danger text-light"><i class = "bi bi-eye-slash-fill"></i></span>
                                    </td>
                                    <td>
                                        <span role = "button" data-bs-toggle = "dropdown" aria-expanded = "false"><i class = "bi bi-three-dots-vertical"></i></span>
                                        <ul class = "dropdown-menu" aria-labelledby = "navbarScrollingDropdown">
                                            <li>
                                                <router-link :to = "'/panel/teacher/'+data.id" class = "dropdown-item" style = "text-align: right !important">
                                                    مشاهده
                                                </router-link>
                                                <router-link :to = "'/panel/edit/teacher/'+data.id" class = "dropdown-item" style = "text-align: right !important">
                                                    ویرایش
                                                </router-link>
                                                <a class = "dropdown-item" @click = "showDeleteModal(data.id)" style = "text-align: right !important"
                                                   data-bs-toggle = "modal" data-bs-target = "#exampleModal">حذف</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-else><p class = "fw-bold">هیچ آموزگاری موجود نیست</p></div>
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
            this.loadAllData();
        },
        methods: {
            async loadAllData() {
                await App.methods.checkToken();
                await axios.get('/api/panel/teacher').then((response) => {
                    this.allData = response.data;
                }).catch();
            },
            showDeleteModal(id) {
                App.methods.checkToken();
                document.getElementById('deleteId').value = id;

            },
            deleteInfo() {
                App.methods.checkToken();

                let id = document.getElementById('deleteId').value;
                axios.post('/api/panel/delete/teacher/', {
                    id: id,
                })
                    .then((response) => {
                        console.log(response.data)
                    })
                    .catch((error) => {
                        console.error(error);
                    });


                this.loadAllData();
            },
            pActiveToggle(id) {
                App.methods.checkToken();

                axios.get('/api/panel/active/teacher/' + id)
                    .then((response) => {
                        console.log(response.data)
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                this.loadAllData();
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
