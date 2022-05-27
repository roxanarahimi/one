import {createRouter, createWebHistory} from 'vue-router'

//site
import Home from "./components/site/views/Home";
import About from "./components/site/views/About";

import Profile from "./components/site/views/client/Profile";
import Orders from "./components/site/views/client/OrderHistory";
import Order from "./components/site/views/client/Order";
import Login from "./components/site/views/client/Login";
import LoginOtp from "./components/site/views/client/LoginOtp";

import Contact from "./components/site/views/Contact";
import Product from "./components/site/views/Product";
import Products from "./components/site/views/Products";
import Cart from './components/site/views/Cart';
import ConfirmOrder from './components/site/views/ConfirmOrder';

import Register from "./components/site/views/client/Register";
import ResetPassword from "./components/site/views/client/ResetPassword";
import Email from "./components/site/views/client/Email";
// import error404 from "./components/site/views/error/Error404";

//panel
import PanelLogin from "./components/panel/admin/Login";
import PanelHome from "./components/panel/Home";
import PanelProducts from "./components/panel/product/Products";
import PanelProductCreate from "./components/panel/product/ProductCreate";
import PanelProductEdit from "./components/panel/product/ProductEdit";
import PanelProduct from "./components/panel/product/Product";
import PanelProductCategories from "./components/panel/product/ProductCategories";
import PanelArticles from "./components/panel/article/Articles";
import PanelArticleCreate from "./components/panel/article/ArticleCreate";
import PanelArticleEdit from "./components/panel/article/ArticleEdit";
import PanelArticle from "./components/panel/article/Article";
import PanelArticleCategories from "./components/panel/article/ArticleCategories";
import PanelUsers from "./components/panel/user/Users";
import PanelUserEdit from "./components/panel/user/UserEdit";
import PanelUser from "./components/panel/user/User";
import PanelSlides from "./components/panel/slide/Slides";
import PanelSlideCreate from "./components/panel/slide/SlideCreate";
import PanelSlideEdit from "./components/panel/slide/SlideEdit";
import PanelIcon from "./components/panel/icon/Icon";

import PanelResumes from "./components/panel/employ/Resumes";
import PanelResume from "./components/panel/employ/Resume";

import PanelTeachers from "./components/panel/teacher/Teachers";
import PanelTeacherCreate from "./components/panel/teacher/TeacherCreate";
import PanelTeacherEdit from "./components/panel/teacher/TeacherEdit";
import PanelTeacher from "./components/panel/teacher/Teacher";

// import PanelSlide from "./components/article/Slide";
// import PanelResumes from "./components/panel/employ/Resumes";
// import PanelResume from "./components/panel/employ/Resume";
import PanelProjects from "./components/panel/project/Projects";
import PanelProjectCreate from "./components/panel/project/ProjectCreate";
import PanelProjectEdit from "./components/panel/project/ProjectEdit";
import PanelProject from "./components/panel/project/Project";

import PanelOrders from "./components/panel/order/Orders";
import PanelOrderCreate from "./components/panel/order/OrderCreate";
import PanelOrderEdit from "./components/panel/order/OrderEdit";
import PanelOrder from "./components/panel/order/Order";

import PanelProfile from "./components/panel/admin/Profile";
import PanelAdmins from "./components/panel/admin/Admins";
import PanelFinance from "./components/panel/finance/Finance";
import PanelError404 from "./components/panel/error/Error404";

import PanelCourses from "./components/panel/course/Courses";
import PanelCourseCreate from "./components/panel/course/CourseCreate";
import PanelCourseEdit from "./components/panel/course/CourseEdit";
import PanelCourse from "./components/panel/course/Course";
import PanelCourseCategories from "./components/panel/course/CourseCategories";


const routes = [
    //site
    {
        path: "/",
        name: "home",
        component: Home,
    },


    {
        path: "/contact",
        name: "contact",
        component: Contact,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/otp/login",
        name: "loginOtp",
        component: LoginOtp,
    },
    {
        path: "/products",
        name: "products",
        component: Products,
        props: true,
    },
    {
        path: "/product/:id",
        name: "product",
        component: Product,
        props: true,
    },
    {
        path: "/cart",
        name: "cart",
        component: Cart,
    },
    {
        path: "/confirmOrder",
        name: "confirmOrder",
        component: ConfirmOrder,
    },
    {
        path: "/profile",
        name: "profile",
        component: Profile,
    },
    {
        path: "/orders",
        name: "orders",
        component: Orders,
    },
    {
        path: "/order/:id",
        name: "order",
        component: Order,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/reset/password",
        name: "ResetPassword",
        component: ResetPassword,
    },
    {
        path: "/reset/password/email",
        name: "Email",
        component: Email,
    },
    // {
    //     path: "/:catchAll(.*)",
    //     name: "error404",
    //     component: error404,
    // },


    //panel

    {
        path: "/panel",
        // name: "PanelHome",
        component: () => import(/* webpackChunkName: "home" */ '../js/components/panel/Home'),

    },
    {
        path: "/panel/test",
        component: () => import(/* webpackChunkName: "test" */ '../js/components/panel/product/ProductsT'),
        params: true
    },
    {
        path: "/panel/products",
        component: () => import(/* webpackChunkName: "products" */ '../js/components/panel/product/Products'),
        params: true,
        props: true,

        // component: PanelProducts,
    },
    {
        path: "/panel/new/product",
        name: "PanelProductCreate",
        component: () => import(/* webpackChunkName: "PanelProductCreate" */ '../js/components/panel/product/ProductCreate'),
        // component: PanelProductCreate,
        params: true
    },
    {
        path: "/panel/edit/product/:id",
        name: "PanelProductEdit",
        component: PanelProductEdit,
        params: true
    },
    {
        path: "/panel/product/:id",
        name: "PanelProduct",
        component: PanelProduct,
    },
    {
        path: "/panel/categories/product",
        name: "PanelProductCategories",
        component: PanelProductCategories,
    },

    {
        path: "/panel/orders",
        name: "PanelOrders",
        component: () => import(/* webpackChunkName: "PanelOrders" */ '../js/components/panel/order/Orders'),

        // component: PanelOrders,
    },
    {
        path: "/panel/new/order",
        name: "PanelOrderCreate",
        component: PanelOrderCreate,
        params: true
    },
    {
        path: "/panel/edit/order/:id",
        name: "PanelOrderEdit",
        component: PanelOrderEdit,
        params: true
    },
    {
        path: "/panel/order/:id",
        name: "PanelOrder",
        component: PanelOrder,
    },

    {
        path: "/panel/articles",
        name: "PanelArticles",
        component: () => import(/* webpackChunkName: "PanelArticles" */ '../js/components/panel/article/Articles'),

        // component: PanelArticles,
    },
    {
        path: "/panel/new/article",
        name: "PanelArticleCreate",
        component: PanelArticleCreate,
        params: true
    },
    {
        path: "/panel/edit/article/:id",
        name: "PanelArticleEdit",
        component: PanelArticleEdit,
        params: true
    },
    {
        path: "/panel/article/:id",
        name: "PanelArticle",
        component: PanelArticle,
    },
    {
        path: "/panel/categories/article",
        name: "PanelArticleCategories",
        component: PanelArticleCategories,
    },

    {
        path: "/panel/projects",
        name: "PanelProjects",
        component: () => import(/* webpackChunkName: "PanelProjects" */ '../js/components/panel/project/Projects'),

        // component: PanelProjects,
    },
    {
        path: "/panel/new/project",
        name: "PanelProjectCreate",
        component: PanelProjectCreate,
        params: true
    },
    {
        path: "/panel/edit/project/:id",
        name: "PanelProjectEdit",
        component: PanelProjectEdit,
        params: true
    },
    {
        path: "/panel/project/:id",
        name: "PanelProject",
        component: PanelProject,
    },

    {
        path: "/panel/courses",
        name: "PanelCourses",
        component: () => import(/* webpackChunkName: "PanelCourses" */ '../js/components/panel/course/Courses'),

        // component: PanelCourses,
    },
    {
        path: "/panel/new/course",
        name: "PanelCourseCreate",
        component: PanelCourseCreate,
        params: true
    },
    {
        path: "/panel/edit/course/:id",
        name: "PanelCourseEdit",
        component: PanelCourseEdit,
        params: true
    },
    {
        path: "/panel/course/:id",
        name: "PanelCourse",
        component: PanelCourse,
    },
    {
        path: "/panel/categories/course",
        name: "PanelCourseCategories",
        component: PanelCourseCategories,
    },

    {
        path: "/panel/slides",
        name: "PanelSlides",
        component: () => import(/* webpackChunkName: "PanelSlides" */ '../js/components/panel/slide/Slides'),

        // component: PanelSlides,
    },
    {
        path: "/panel/icon",
        name: "PanelIcon",
        component: () => import(/* webpackChunkName: "PanelIcon" */ '../js/components/panel/icon/Icon'),

        // component: PanelSlides,
    },
    {
        path: "/panel/new/slide",
        name: "PanelSlideCreate",
        component: PanelSlideCreate,
        params: true
    },
    {
        path: "/panel/edit/slide/:id",
        name: "PanelSlideEdit",
        component: PanelSlideEdit,
        params: true
    },

    {
        path: "/panel/user/:id",
        name: "PanelUser",
        component: () => import(/* webpackChunkName: "PanelUsers" */ '../js/components/panel/user/Users'),

        // component: PanelUser,
    },
    {
        path: "/panel/users",
        name: "PanelUsers",
        component: PanelUsers,
    },
    {
        path: "/panel/edit/user/:id",
        name: "PanelUserEdit",
        component: PanelUserEdit,
        params: true
    },
    {
        path: "/panel/login",
        name: "PanelLogin",
        component: PanelLogin,
    },
    {
        path: "/panel/profile",
        name: "PanelProfile",
        component: PanelProfile,
    },
    {
        path: "/panel/users",
        name: "PanelUsers",
        component: PanelUsers,
    },

    {
        path: "/panel/admins",
        name: "PanelAdmins",
        component: () => import(/* webpackChunkName: "PanelAdmins" */ '../js/components/panel/admin/Admins'),

        // component: PanelAdmins,
    },
    {
        path: "/panel/admins",
        name: "PanelAdmins",
        component: PanelAdmins,
    },
    {
        path: "/panel/admins",
        name: "PanelAdmins",
        component: PanelAdmins,
    },
    {
        path: "/panel/admins",
        name: "PanelAdmins",
        component: PanelAdmins,
    },
    {
        path: "/panel/admins",
        name: "PanelAdmins",
        component: PanelAdmins,
    },

    {
        path: "/panel/finance",
        name: "PanelFinance",
        component: () => import(/* webpackChunkName: "PanelFinances" */ '../js/components/panel/finance/Finance'),

        // component: PanelFinance,
    },

    {
        path: "/panel/resumes",
        name: "PanelResumes",
        component: () => import(/* webpackChunkName: "PanelResumes" */ '../js/components/panel/employ/Resumes'),

        // component: PanelResumes,
    },
    {
        path: "/panel/resume/:id",
        name: "PanelResume",
        component: PanelResume,
    },
    {
        path: "/panel/teachers",
        name: "PanelTeachers",
        component: () => import(/* webpackChunkName: "PanelTeachers" */ '../js/components/panel/teacher/Teachers'),

        // component: PanelTeachers,
    },
    {
        path: "/panel/new/teacher",
        name: "PanelTeacherCreate",
        component: PanelTeacherCreate,
        params: true
    },
    {
        path: "/panel/edit/teacher/:id",
        name: "PanelTeacherEdit",
        component: PanelTeacherEdit,
        params: true
    },
    {
        path: "/panel/teacher/:id",
        name: "PanelTeacher",
        component: PanelTeacher,
    },
    {
        path: "/:catchAll(.*)",
        name: "PanelError404",
        component: PanelError404,
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
