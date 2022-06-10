<template>



        <div v-if="allData.length" class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">عنوان</th>
                        <!--                            <th scope="col">زیر مجموعه</th>-->
                        <th scope="col">تاریخ ثبت</th>
                        <th scope="col" class="active_cell">وضعیت</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :id="'row_'+data.id" v-for="(data, index) in allData" :key="data.id" :data-index="index">
                        <td class="">{{ index + 1 }}</td>
                        <td class="">{{ data.title }}</td>
                        <!--                            <td class="">{{ data.subsets.length }}</td>-->
                        <td>{{ data.created_at }}</td>
                        <td class="active_cell">
                                <span @click="activeToggle(data.id)" v-if="data.active"
                                      class="badge bg-success text-light"><i class="bi bi-eye-fill"></i></span>
                            <span @click="activeToggle(data.id)" v-else class="badge bg-danger text-light"><i
                                class="bi bi-eye-slash-fill"></i></span>
                        </td>
                        <td :id="'form_'+data.id" class="d-none px-3 py-3 edit" colspan="5">
                            <form action="" class="">
                                <div class="row">
                                    <div class="col-xl-1 py-2">
                                        <label :for="'title_'+data.id">عنوان</label>
                                    </div>
                                    <div class="col-xl-7 col-xxl-8 mb-2">
                                        <input type="text" class="form-control border-0 col-auto" required
                                               :id="'title_'+data.id" :value="data.title">
                                    </div>
                                    <div class="col-xl-4 col-xxl-3  ">
                                        <button type="submit" class="btn btn-dark ms-auto mb-2"
                                                @click.prevent="updateInfo(data.id)" id="update">
                                            ویرایش
                                        </button>
                                        <button class="btn btn-secondary ms-1 mb-2"
                                                @click.prevent="hideUpdateForm(data.id)" id="cancelUpdate">
                                            انصراف
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </td>

                        <td class="">
                                        <span role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </span>

                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li>
                                    <a class="dropdown-item" style="text-align: right !important"
                                       @click="showUpdateForm(data.id)" href="#">ویرایش</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" style="text-align: right !important"
                                       @click="showDeleteModal(data.id)" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal">حذف</a>
                                </li>
                            </ul>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

 </template>

<script>
import App from './App';
import {onMounted, ref} from "vue";

export default {
    props: ['model', 'allData'],
    name: "categoriesTable",
    setup(props) {
        const i = ref(0);
        const errors = ref(0);

        const loadData = async () => {
            // await App.methods.checkToken();
            await axios.get('/api/panel/category/' + props.model).then((response) => {
                props.allData.value = response.data;
                console.log('loaded')
            }).catch();
        }
        const createInfo = async () => {
            this.errors = [];
            await App.methods.checkToken();
            await axios.post('/api/panel/category/product',
                {
                    title: document.getElementById('title').value,
                })
                .then((response) => {
                    loadData();
                    setTimeout(() => {
                        document.getElementById('title').value = "";
                    }, 200);

                })
                .catch((error) => {
                    if (error.status === 422) {
                        let errorList = Array(error.response.data);
                        document.getElementById('title').classList.add('hasError');
                        for (var i = 0; i < errorList.length; i++) {
                            for (var j = 0; j < Array(errorList[i]).length; j++) {
                                let err = Object.values(Array(errorList[i])[j]);
                                err.forEach((element) => {
                                    element.forEach((m) => {
                                        this.errors.push(m)
                                    })
                                });
                            }
                        }
                    } else if (error.status === 500) {
                        if (error.response.data.message.includes("SQLSTATE")) {
                            console.error('خطای پایگاه داده');
                        }
                        alert('در ذخیره اطلاعات مشکلی بوجود امده.');

                    } else {
                        console.error(error);
                    }


                })
        };
        const updateInfo = async (id) => {
            // await App.methods.checkToken();
            await axios.post('/api/panel/category/' + props.model + '/' + id,
                {
                    title: document.getElementById('title_' + id).value,
                })
                .then((response) => {
                    console.log(response.data);
                    loadData();

                })
                .catch((error) => {
                    if (error.status === 422) {
                        let errorList = Array(error.response.data);
                        for (var i = 0; i < errorList.length; i++) {
                            for (var j = 0; j < Array(errorList[i]).length; j++) {
                                let err = Object.values(Array(errorList[i])[j]);
                                err.forEach((element) => {
                                    element.forEach((m) => {
                                        //  this.errors.push(m)
                                        alert(m)
                                    })
                                });
                            }
                        }
                    } else if (error.status === 500) {
                        if (error.response.data.message.includes("SQLSTATE")) {
                            console.error('خطای پایگاه داده');
                        }
                        alert('در ذخیره اطلاعات مشکلی بوجود امده.');

                    } else {
                        console.error(error);
                    }
                });
            await hideUpdateForm(id);
        };
        const showUpdateForm = (id) => {

            let row = document.getElementById('row_' + id);
            row.childNodes.forEach((element) => {
                element.classList.add('d-none');
            });
            document.getElementById('form_' + id).classList.remove('d-none');

        };
        const hideUpdateForm = (id) => {
            loadData();
            let row = document.getElementById('row_' + id);
            row.childNodes.forEach((element) => {
                element.classList.remove('d-none');

            });
            document.getElementById('form_' + id).classList.add('d-none');
        };
        const activeToggle = async (id) => {
            // await App.methods.checkToken();
            await axios.get('/api/panel/active/category/' + props.model + '/' + id)
                .then((response) => {
                    console.log(response.data)
                })
                .catch((error) => {
                    console.error(error);
                });
            await loadData();

        };


        return {
            i,  errors,
            loadData, createInfo, updateInfo, showUpdateForm, hideUpdateForm, activeToggle
        }

    },


}

</script>
<style>
.edit {
    background: #d7d7d7 !important;
}
</style>
a
