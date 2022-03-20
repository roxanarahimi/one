<template>
    <transition name = "route" mode = "out-in" appear>
        <section>
            <h3 class = "mb-5">رزومه ها
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
                                    <th scope = "col">موبایل</th>
                                    <th scope = "col">عنوان شغل</th>
                                    <th class = "d-none d-xl-table-cell" scope = "col">کد ملی</th>
                                    <th class = "d-none d-md-table-cell" scope = "col">تاریخ ثبت</th>
                                    <th scope = "col" class = "">وضعیت</th>
                                    <th scope = "col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr :id = "'row_'+data.id" v-for = "(data, index) in allData" :key = "data.id" :data-index = "index">
                                    <td scope = "row">{{ index + 1 }}</td>
                                    <td>
                                        <router-link :to = "'/panel/resume/'+data.id">{{ data.name }}</router-link>
                                    </td>
                                    <td>{{ data.email }}</td>
                                    <td>{{ data.mobile }}</td>

                                    <td class = "d-none d-xl-table-cell">{{ data.position }}</td>
                                    <td class = "d-none d-xl-table-cell text_cell">{{ data.national_code }}</td>
                                    <td class = "d-none d-md-table-cell date_cell">{{ data.created_at }}</td>
                                    <td class = "d-none d-md-table-cell date_cell">{{ data.status }}</td>
                                    <td>
                                        <span role = "button" data-bs-toggle = "dropdown" aria-expanded = "false"><i class = "bi bi-three-dots-vertical"></i></span>
                                        <ul class = "dropdown-menu" aria-labelledby = "navbarScrollingDropdown">
                                            <li>
                                                <router-link :to = "'/panel/resume/'+data.id" class = "dropdown-item" style = "text-align: right !important">
                                                    مشاهده
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
                    <div v-else><p class = "fw-bold">هیچ رزومه ای موجود نیست</p></div>
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
                    آیا رزومه مورد نظر حذف شود؟

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
                await setTimeout(() => {
                    axios.get('/api/panel/resume')
                        .then((response) => {
                            console.log(response)
                            this.allData = response.data;
                        })
                        .catch();
                }, 1000)
            },
            showDeleteModal(id) {
                App.methods.checkToken();
                document.getElementById('deleteId').value = id;

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
