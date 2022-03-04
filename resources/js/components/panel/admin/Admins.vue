<template>
    <transition name = "route" mode = "out-in" appear>
        <section>
            <h3 class = "mb-5">مدیران
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
                    axios.get('/api/panel/admins')
                        .then((response) => {
                            this.allData = response.data;
                        })
                        .catch();
                }, 1000)
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
