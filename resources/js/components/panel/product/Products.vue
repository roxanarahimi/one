<template>
    <transition name="route" mode="out-in" appear>
        <section>
            <h3 class="mb-5">محصولات
                <router-link to="/panel/new/product" class="text-dark">
                    <span title="ثبت محصول جدید" class="px-3 d-inline-block align-middle"><i
                        class="bi bi-plus-circle-fill p-0 mt-2 m-0" style="font-size: 15px"></i></span>
                </router-link>
            </h3>

            <div class="row mt-3">
                <div class="col-12 mb-3">
<!--                    <Suspense>-->
<!--                        <template #default>-->
                        <div v-if="allData.length" class="card">
                            <div class="card-body table-responsive">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th class="d-none d-md-table-cell" style="width: 100px" scope="col">تصویر</th>
                                        <th scope="col">عنوان</th>
                                        <th scope="col" class="d-none d-xl-table-cell text_cell">دسته</th>
                                        <th scope="col">قیمت</th>
                                        <th scope="col">%تخفیف</th>
                                        <th class="">موجودی</th>
                                        <th class="d-none d-xl-table-cell" scope="col">متن</th>
                                        <th class="d-none d-md-table-cell" scope="col">تاریخ ثبت</th>
                                        <th scope="col" class="active_cell">وضعیت</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr :id="'row_'+data.id" v-for="(data, index) in allData" :key="data.id"
                                        :data-index="index">
                                        <td scope="row">{{ index + 1 }}</td>
                                        <td class="d-none d-md-table-cell" style="width: 100px">
                                            <img v-if="data.images" :src="data.images[0]" width="80" alt="">
                                            <!--       tumb-->
                                        </td>
                                        <td>
                                            <router-link :to="'/panel/product/'+data.id">{{ data.title }}</router-link>
                                        </td>

                                        <td class="d-none d-xl-table-cell text_cell"
                                            :title="!data.category.active? 'دسته غیر فعال است': ''"
                                            :class="{'text-decoration-line-through text-muted ': !data.category.active}">
                                            {{ data.category.title }}
                                        </td>
                                        <td>{{ data.price }}</td>
                                        <td>{{ data.off }}</td>

                                        <td class="">{{ data.stock }}</td>
                                        <td class="d-none d-xl-table-cell text_cell">{{ data.text }}</td>
                                        <td class="d-none d-md-table-cell date_cell">{{ data.created_at }}</td>
                                        <td class="active_cell">
                                        <span @click="pActiveToggle(data.id)" v-if="data.active"
                                              class="badge bg-success text-light"><i class="bi bi-eye-fill"></i></span>
                                            <span @click="pActiveToggle(data.id)" v-else
                                                  class="badge bg-danger text-light"><i
                                                class="bi bi-eye-slash-fill"></i></span>
                                        </td>
                                        <td>
                                        <span role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bi bi-three-dots-vertical"></i></span>
                                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                                <li>
                                                    <router-link :to="'/panel/product/'+data.id" class="dropdown-item"
                                                                 style="text-align: right !important">
                                                        مشاهده
                                                    </router-link>
                                                    <router-link :to="'/panel/edit/product/'+data.id"
                                                                 class="dropdown-item"
                                                                 style="text-align: right !important">
                                                        ویرایش
                                                    </router-link>
                                                    <a class="dropdown-item" @click="showDeleteModal(data.id)"
                                                       style="text-align: right !important"
                                                       data-bs-toggle="modal" data-bs-target="#exampleModal">حذف</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
<!--                        </template>-->
<!--                        <template #fallback>-->
<!--                            <loader/>-->
<!--                        </template>-->
<!--                    </Suspense>-->

                    <!--                    <div v-else><p class="fw-bold">هیچ محصولی موجود نیست</p></div>-->
                </div>
            </div>
        </section>
    </transition>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog md">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <!--                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    آیا محصول مورد نظر حذف شود؟
                </div>
                <div class="modal-footer border-0">
                    <input type="hidden" id="deleteId">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal" @click="deleteInfo">بله
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">نه !</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import App from '../App';
import {ref, onMounted} from 'vue';
import Loader from "../../site/components/Loader";

export default {
    components: {Loader},
    props: [],
     setup() {
        const allData = ref([]);
        const showDeleteModal = (id) => {
            // App.methods.checkToken();
            document.getElementById('deleteId').value = id;
        };
        const deleteInfo = () => {
            //App.methods.checkToken();
            let id = document.getElementById('deleteId').value;
            axios.post('/api/panel/delete/product/', {
                id: id,
            })
                .then((response) => {
                    console.log(response.data)
                })
                .catch((error) => {
                    console.error(error);
                });
            loadData();
        };
        const pActiveToggle = (id) => {
            App.methods.checkToken();
            axios.get('/api/panel/active/product/' + id)
                .then((response) => {
                    console.log(response.data)
                })
                .catch((error) => {
                    console.error(error);
                });
            loadData();
        };
         const loadData = () => {
             axios.get('/api/panel/product')
                .then((response) => {
                      allData.value = response.data;
                }).catch();
        };
        // await loadData();

         onMounted(() => {
            loadData();
        });
        return {
            allData,
            loadData, showDeleteModal, deleteInfo, pActiveToggle
        };
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
