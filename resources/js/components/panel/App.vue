<template>
    <!--    <suspense>-->
    <!--        <template #default>-->
    <!--            <h2>in app</h2>-->
    <!--            <test />-->
    <!--        </template>-->
    <!--        <template #fallback> <loader /></template>-->
    <!--    </suspense>-->

    <div v-if="this.$route.fullPath.includes('panel')">

    </div>
    <div v-else>

    </div>

    <div id="page" class="d-flex bg-dark"
         v-if="this.$route.fullPath !== '/' && this.$route.fullPath !== '/panel/login' && this.$route.fullPath !== '/panel/register' && this.$route.fullPath !== '/panel/reset/password' && this.$route.name !== 'Error404'">

        <div id="sidebar-wrapper" class=" bg-dark">
            <div id="sidebar" class="bg-dark text-light">
                <!--            <h4 class=" my-3 text-center ">پنل مدیریت</h4>-->
                <ul class="nav nav-pills flex-column mb-auto ">
                    <li class="nav-item" id="">
                        <router-link to="/panel" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel' }">
                            <!--                            <i title="خانه"  class = "bi bi-house-fill me-2"></i>-->
                            <!--                            <span class = "sidebar_title">خانه</span> -->
                            <i title="داشبورد" class="bi bi-speedometer2 me-2"></i>
                            <span class="sidebar_title">داشبورد</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/panel/orders" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/orders'}">
                            <i title="سفارش ها">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                     class="bi bi-box2-heart-fill me-2" viewBox="0 0 16 16">
                                    <path
                                        d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4h-8.5ZM8.5 4h6l.5.667V5H1v-.333L1.5 4h6V1h1v3ZM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                </svg>
                            </i>
                            <span class="sidebar_title">سفارش ها</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/panel/categories" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/categories'}">
                            <i title="دسته ها" class="bi bi-tags-fill me-2"></i>
                            <span class="sidebar_title">دسته ها</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/panel/products" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/products'}">
                            <i title="محصولات" class="bi bi-grid-fill me-2"></i>
                            <span class="sidebar_title">محصولات</span>
                        </router-link>
                    </li>
<!--                    <li>-->
<!--                        <router-link to="/panel/categories/product" class="nav-link text-white"-->
<!--                                     :class="{active: $route.fullPath ==='/panel/categories/product'}">-->
<!--                            <i title="دسته محصولات" class="bi bi-tags-fill me-2"></i>-->
<!--                            <span class="sidebar_title">دسته محصولات</span>-->
<!--                        </router-link>-->
<!--                    </li>-->

                    <li>
                        <router-link to="/panel/articles" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/articles'}">
                            <i title="مطالب" class="bi bi-chat-left-text-fill me-2"></i>
                            <span class="sidebar_title">مطالب</span>
                        </router-link>
                    </li>
<!--                    <li>-->
<!--                        <router-link to="/panel/categories/article" class="nav-link text-white"-->
<!--                                     :class="{active: $route.fullPath ==='/panel/categories/article'}">-->
<!--                            <i title="دسته مطالب" class="bi bi-tags-fill me-2"></i>-->
<!--                            <span class="sidebar_title">دسته مطالب</span>-->
<!--                        </router-link>-->
<!--                    </li>-->
                    <li>
                        <router-link to="/panel/projects" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/projects'}">
                            <!--                            <i class = "bi bi-journals me-2"></i>-->
                            <i title="پروژه ها" class="bi bi-stack me-2"></i>
                            <span class="sidebar_title">پروژه ها</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/panel/slides" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/slides'}">
                            <i title="اسلاید ها" class="bi bi-collection-fill me-2"></i>
                            <span class="sidebar_title">اسلاید ها</span>
                        </router-link>
                    </li>
<!--                    <li>-->
<!--                        <router-link to="/panel/icon" class="nav-link text-white"-->
<!--                                     :class="{active: $route.fullPath ==='/panel/icon'}">-->
<!--                            <i class="bi bi-heptagon-fill me-2"></i>-->
<!--                            <span class="sidebar_title">لوگو/ آیکون</span>-->
<!--                        </router-link>-->
<!--                    </li>-->

<!--                    <li>-->
<!--                        <router-link to="/panel/teachers" class="nav-link text-white"-->
<!--                                     :class="{active: $route.fullPath ==='/panel/teachers'}">-->
<!--                            <i class="me-2">-->
<!--                                <i title="آموزگاران">-->
<!--                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"-->
<!--                                         class="bi bi-person-video3" viewBox="0 0 16 16">-->
<!--                                        <path-->
<!--                                            d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2Z"/>-->
<!--                                        <path-->
<!--                                            d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783.059-.187.09-.386.09-.593V4a2 2 0 0 0-2-2H2Z"/>-->
<!--                                    </svg>-->
<!--                                </i>-->
<!--                            </i>-->
<!--                            <span class="sidebar_title">آموزگاران</span>-->
<!--                        </router-link>-->
<!--                    </li>-->
                    <li>
                        <router-link to="/panel/courses" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/courses'}">
                            <i title="دوره ها" class="bi bi-easel-fill me-2"></i>
                            <span class="sidebar_title">دوره ها</span>
                        </router-link>
                    </li>
<!--                    <li>-->
<!--                        <router-link to="/panel/categories/course" class="nav-link text-white"-->
<!--                                     :class="{active: $route.fullPath ==='/panel/categories/course'}">-->
<!--                            <i title="دسته دوره ها" class="bi bi-tags-fill me-2"></i>-->
<!--                            <span class="sidebar_title">دسته دوره ها</span>-->
<!--                        </router-link>-->
<!--                    </li>-->
                    <li>
                        <router-link to="/panel/resumes" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/resumes'}">
                            <i title="رزومه ها" class="bi bi-person-lines-fill me-2"></i>
                            <span class="sidebar_title">رزومه ها</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/panel/users" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/users'}">
                            <i title="کاربران" class="bi bi-people-fill me-2"></i>
                            <span class="sidebar_title">کاربران</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/panel/finance" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/finance'}">
                            <i title="مالی" class="bi bi-currency-exchange me-2"></i>
                            <span class="sidebar_title">مالی</span>
                        </router-link>
                    </li>
<!--                    <li>-->
<!--                        <router-link to="/panel/reports" class="nav-link text-white"-->
<!--                                     :class="{active: $route.fullPath ==='/panel/reports'}">-->
<!--                            <i title="گزارش ها" class="bi bi-bar-chart-line-fill me-2"></i>-->
<!--                            <span class="sidebar_title">گزارش ها</span>-->
<!--                        </router-link>-->
<!--                    </li>-->
                    <li>
                        <router-link to="/panel/admins" class="nav-link text-white"
                                     :class="{active: $route.fullPath ==='/panel/admins'}">
                            <i title="مدیران" class="bi bi-person-circle me-2"></i>
                            <span class="sidebar_title">مدیران</span>
                        </router-link>
                    </li>
<!--                    <li>-->
<!--                        <router-link to="/panel/settings" class="nav-link text-white"-->
<!--                                     :class="{active: $route.fullPath ==='/panel/settings'}">-->
<!--                            <i title="تنضیمات" class="bi bi-gear-fill me-2"></i>-->
<!--                            <span class="sidebar_title">تنضیمات</span>-->
<!--                        </router-link>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>
        <main id="main" class="wrapper  bg-light">
            <nav class="navbar navbar-expand  navbar-dark bg-dark text-light">
                <div class="container-fluid">
                    <span id="sidebar_toggle_btn" class="fw-bold py-1 pe-2 mt-2" @click="sideBarToggle"
                          style="font-size: 20px; line-height: 10px; cursor: pointer">
                        <i class="bi bi-list "></i>
                    </span>
                    <nav class=" pe-3 bp-1 ms-auto">
                        <ul class="navbar-nav  ">
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <span id="admin_label"> {{ admin }}</span>
                                    <i class="bi bi-person-circle mx-2 my-0"></i>
                                </a>
                                <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                                    <li>
                                        <router-link class="dropdown-item" to="/panel/profile">پروفایل</router-link>
                                    </li>
                                    <li><a class="dropdown-item" @click="logout" href="#">خروج</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>
            <!--                            <transition name="route" mode="out-in" appear>-->
            <!--                              <router-view/>-->
            <!--                            </transition>-->

            <!--                            style="min-height: 346px !important"-->

            <section class="page_content container-fluid p-4 p-md-5">
                <router-view/>
            </section>
        </main>
    </div>
    <div v-else>
        <!--        <RouterView v-slot="{ Component }">-->
        <!--            <template v-if="Component">-->
        <!--                <Transition mode="out-in">-->
        <!--                    <KeepAlive>-->
        <!--                        <Suspense>-->
        <!--                            &lt;!&ndash; main content &ndash;&gt;-->
        <!--                            <component :is="Component"></component>-->

        <!--                            &lt;!&ndash; loading state &ndash;&gt;-->
        <!--                            <template #fallback>-->
        <!--                                Loading...-->
        <!--                            </template>-->
        <!--                        </Suspense>-->
        <!--                    </KeepAlive>-->
        <!--                </Transition>-->
        <!--            </template>-->
        <!--        </RouterView>-->
        <section class="page_content container-fluid p-4 p-md-5 bg-light vh-100">
            <Suspense>
                <router-view/>

            </Suspense>
        </section>
    </div>
</template>

<script>
import Loader from "../site/components/Loader";

export default {
    components: {Loader},
    // async setup() {
    //     const flag = await ref(1);
    //     const showPanel = await ref(false);
    //     const token = await ref('');
    //     const admin = await ref('');
    //     return {
    //         flag, showPanel, token, admin
    //     }
    // },
    data: function () {
        return {
            flag: 1,
            showPanel: false,
            token: '',
            admin: '',
        }
    },
    created() {
        window.addEventListener('resize', this.handleResize);
    },
    updated() {
        if (document.getElementById('sidebar')?.style.width !== '170px') {
            document.querySelectorAll('.sidebar_title').forEach((item) => {
                item.classList.add('d-none');
            });
        } else {
            document.querySelectorAll('.sidebar_title').forEach((item) => {
                item.classList.remove('d-none');
            });
        }
        // this.checkToken();
    },
    mounted() {
        this.sideBarToggle();
        this.handleResize();

        if (!localStorage.getItem('admin_access_token')) {
            this.$router.push({name: 'PanelLogin'});
        }
        document.querySelectorAll('form').forEach((item) => {
            item.setAttribute('autocomplete', 'off');
        });
        // this.persianDate();
    },
    methods: {
        handleResize() {
            if (window.innerWidth <= 768) {
                if (this.flag === 1) {
                    this.sideBarToggle();
                }
                setTimeout(() => {
                    document.querySelectorAll('.sidebar_title').forEach((item) => {
                        item.classList.add('d-none');
                    });

                }, 300);
            } else if (window.innerWidth > 768) {
                document.getElementById('sidebar_toggle_btn')?.classList.remove('d-none')

            }
        },
        sideBarToggle() {
            if (this.flag === 0) {
                document.getElementById('sidebar').style.width = '170px';
                document.getElementById('main').style.width = 'calc(100% - 170px)';
                let titles = document.querySelectorAll('.sidebar_title');
                setTimeout(() => {
                    titles.forEach((item) => {
                        item.classList.remove('d-none');
                    });
                }, 300)
                this.flag++;
            } else {
                let titles = document.querySelectorAll('.sidebar_title');
                titles.forEach((item) => {
                    item.classList.add('d-none');
                })
                document.getElementById('sidebar').style.width = '55px';
                document.getElementById('main').style.width = 'calc(100% - 55px)';

                this.flag--;

            }

        },
        logout() {
            axios.create({
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('admin_access_token'),
                }
            }).get('/api/panel/user/logout/' + JSON.parse(localStorage.getItem('admin'))?.id)
                .then((response) => {
                    console.log(response);
                    if (response.status === 200) {
                        localStorage.removeItem('admin_access_token');
                        localStorage.removeItem('admin');
                        localStorage.removeItem('admin_expire');
                        // this.$router.push({name: 'PanelLogin'});
                        window.location = '/panel/login'
                    }

                })
                .catch((error) => {
                    console.log(error);

                });
        },
        checkToken() {
            axios.post('/api/panel/check/admin/token',
                {
                    id: JSON.parse(localStorage.getItem('admin'))?.id,
                })
                .then((response) => {
                    if (response.status === 200) {
                        if (JSON.parse(localStorage.getItem('admin'))?.scope === 'user') {
                            this.logout();
                        } else if (JSON.parse(localStorage.getItem('admin'))?.scope === 'admin') {
                            this.admin = JSON.parse(localStorage.getItem('admin'))?.name;
                        }

                        localStorage.setItem('admin_expire', response.data.expire)
                        console.log('token checked');

                    }
                })
                .catch((error) => {
                    if (error.response.status === 401) {
                        window.location = '/panel/login'
                        this.logout();
                    }
                });
            console.log('done')
        },
        persianDate() {//date
            const date = new Date();
            const option = {
                //  weekday: "long",
                year: "numeric",
                month: "long",//numeric
                day: "numeric",
            }
            console.log(date.toLocaleDateString("fa-IR", option));
        }
    }
}
</script>

<style scoped>
#sidebar-wrapper {
    /*height: 100vh;*/
    overflow-y: scroll;
    overflow-x: hidden;
    direction: ltr;
    margin-top: 3.5rem;
}

#sidebar {
    direction: rtl;
    min-height: calc(100vh - 3.5rem);
}

/*.zoom-enter-from,*/
/*.zoom-leave-to {*/
/*    opacity: 0;*/
/*    transform: scale(0, 0);*/
/*}*/

/*.zoom-enter-to,*/
/*.zoom-leave-from {*/
/*    opacity: 1;*/
/*    transform: scale(1, 1);*/
/*}*/

/*.zoom-enter-active {*/
/*    transition: all 1s ease;*/
/*    animation-delay: 0.2s;*/
/*}*/

/*.zoom-leave-active {*/
/*    transition: all 0.5s ease;*/
/*    transform: scale(0, 0) !important;*/
/*    position: absolute;*/
/*    right: calc(50% - 155px);*/
/*}*/

/*.zoom-move {*/
/*    transition: all 1s ease;*/
/*}*/

tr:first-child td, tr:last-child td, tr:first-child th, tr:last-child th {
    width: 35px !important;
}

/*.date_cell {*/
/*    direction: ltr !important;*/
/*    text-align: right !important;*/
/*}*/

/*.text_cell {*/
/*    white-space: nowrap;*/
/*    overflow: hidden;*/
/*    text-overflow: ellipsis;*/
/*    max-width: 30ch;*/
/*}*/

/*.active_cell {*/
/*    width: 60px;*/
/*    text-align: center;*/
/*}*/
</style>
