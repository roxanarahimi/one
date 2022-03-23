<template>
    <div v-if = "this.$route.fullPath !== '/panel/login' && this.$route.fullPath !== '/panel/register' && this.$route.fullPath !== '/panel/reset/password' && this.$route.name !== 'Error404'" id = "page" class = "d-flex">

        <div id="sidebar-wrapper">
            <div id = "sidebar" class = "bg-dark text-light pt-2">
                <!--            <h4 class=" my-3 text-center ">پنل مدیریت</h4>-->
                <ul class = "nav nav-pills flex-column mb-auto mt-5">
                    <li class = "nav-item" id = "q12llkk">
                        <router-link to = "/panel" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel' }">
                            <i class = "bi bi-house-fill me-2"></i>
                            <span class = "sidebar_title">خانه</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/slides" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/slides'}">
                            <i class = "bi bi-image-fill me-2"></i>
                            <span class = "sidebar_title">اسلاید ها</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/orders" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/orders'}">
                            <svg xmlns = "http://www.w3.org/2000/svg" width = "23" height = "23" fill = "currentColor" class = "bi bi-box2-heart-fill me-2" viewBox = "0 0 16 16">
                                <path d = "M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4h-8.5ZM8.5 4h6l.5.667V5H1v-.333L1.5 4h6V1h1v3ZM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                            </svg>
                            <span class = "sidebar_title">سفارش ها</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/products" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/products'}">
                            <i class = "bi bi-grid-fill me-2"></i>
                            <span class = "sidebar_title">محصولات</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/categories/product" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/categories/product'}">
                            <i class = "bi bi-tags-fill me-2"></i>
                            <span class = "sidebar_title">دسته محصولات</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/articles" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/articles'}">
                            <i class = "bi bi-chat-left-text-fill me-2"></i>
                            <span class = "sidebar_title">مطالب</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/categories/article" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/categories/article'}">
                            <i class = "bi bi-tags-fill me-2"></i>
                            <span class = "sidebar_title">دسته مطالب</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/projects" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/projects'}">
                            <i class = "bi bi-journals me-2"></i>
                            <span class = "sidebar_title">پروژه ها</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/resumes" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/resumes'}">
                            <i class = "bi bi-person-lines-fill me-2"></i>
                            <span class = "sidebar_title">رزومه ها</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/users" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/users'}">
                            <i class = "bi bi-person-badge-fill me-2"></i>
                            <span class = "sidebar_title">کاربران</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to = "/panel/finance" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/finance'}">
                            <i class = "bi bi-currency-exchange me-2"></i>
                            <span class = "sidebar_title">مالی</span>
                        </router-link>
                    </li>
<!--                    <li>-->
<!--                        <router-link to = "/panel/reports" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/reports'}">-->
<!--                            <i class = "bi bi-bar-chart-line-fill me-2"></i>-->
<!--                            <span class = "sidebar_title">گزارش ها</span>-->
<!--                        </router-link>-->
<!--                    </li>-->
                    <li>
                        <router-link to = "/panel/admins" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/admins'}">
                            <i class = "bi bi-person-circle me-2"></i>
                            <span class = "sidebar_title">مدیران</span>
                        </router-link>
                    </li>
<!--                    <li>-->
<!--                        <router-link to = "/panel/settings" class = "nav-link text-white" :class = "{active: $route.fullPath ==='/panel/settings'}">-->
<!--                            <i class = "bi bi-gear-fill me-2"></i>-->
<!--                            <span class = "sidebar_title">تنضیمات</span>-->
<!--                        </router-link>-->
<!--                    </li>-->
                </ul>
            </div>

        </div>
        <main id = "main" class = "wrapper  bg-light">
            <nav class = "navbar navbar-expand  navbar-dark bg-dark text-light">
                <div class = "container-fluid">
                    <span id = "sidebar_toggle_btn" class = "fw-bold py-1 pe-2 mt-2" @click = "sideBarToggle" style = "font-size: 20px; line-height: 10px; cursor: pointer">
                        <i class = "bi bi-list "></i>
                    </span>
                    <nav class = " pe-3 bp-1 ms-auto">
                        <ul class = "navbar-nav  ">
                            <li class = "nav-item dropdown ">
                                <a class = "nav-link dropdown-toggle" href = "#" id = "navbarDropdownMenuLink" role = "button" data-bs-toggle = "dropdown" aria-expanded = "false">
                                    <span id = "admin_label"> {{ admin }}</span>
                                    <i class = "bi bi-person-circle mx-2 my-0"></i>
                                </a>
                                <ul class = "dropdown-menu " aria-labelledby = "navbarDropdownMenuLink">
                                    <li>
                                        <router-link class = "dropdown-item" to = "/panel/profile">پروفایل</router-link>
                                    </li>
                                    <li><a class = "dropdown-item" @click = "logout" href = "#">خروج</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>


            <!--                <transition name="route" mode="out-in" appear>-->
            <!--                  <router-view/>-->
            <!--                </transition>-->

            <!--                style="min-height: 346px !important"-->


            <section class = "page_content container-fluid p-4 p-md-5">
                <router-view/>
            </section>

            <!--                <router-view  v-slot="{ Component }">-->
            <!--                    <transition name="route" mode="out-in" appear>-->
            <!--                        <section class = "container-fluid p-5">-->
            <!--                           <component :is="Component"></component>-->
            <!--                       </section>-->
            <!--                    </transition>-->
            <!--                </router-view>-->


        </main>
    </div>
    <div v-else>
        <section class = "page_content container-fluid p-4 p-md-5 bg-light vh-100">
            <router-view/>
        </section>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                flag: 0,
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

        },
        mounted() {
            this.sideBarToggle();
            this.handleResize();

            if (!localStorage.getItem('admin_access_token')) {
                this.$router.push({name: 'PanelLogin'});
            }
            document.querySelectorAll('form').forEach((item) => {
                item.setAttribute('autocomplete', 'off');
            })
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
            }
        }
    }
</script>

<style scoped>
#sidebar-wrapper{
    /*height: 100vh;*/
    overflow-y: scroll;
    overflow-x: hidden;
    direction: ltr;
}
#sidebar{
    direction: rtl;
    min-height: 100vh;
}

</style>
