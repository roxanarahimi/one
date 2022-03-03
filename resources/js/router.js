import { createRouter, createWebHistory } from 'vue-router'

//site
import Home from "./components/site/views/Home.vue";
import About from "./components/site/views/About.vue";

import Profile from "./components/site/views/client/Profile.vue";
import Orders from "./components/site/views/client/OrderHistory.vue";
import Order from "./components/site/views/client/Order.vue";
import Login from "./components/site/views/client/Login.vue";
import LoginOtp from "./components/site/views/client/LoginOtp.vue";

import Contact from "./components/site/views/Contact.vue";
import Product from "./components/site/views/Product.vue";
import Products from "./components/site/views/Products.vue";
import Cart from './components/site/views/Cart.vue';
import ConfirmOrder from './components/site/views/ConfirmOrder.vue';

import Register from "./components/site/views/client/Register";
import ResetPassword from "./components/site/views/client/ResetPassword.vue";
import Email from "./components/site/views/client/Email.vue";
// import error404 from "./components/site/views/error/Error404.vue";

//panel
import PanelLogin from "./components/panel/admin/Login.vue";
import PanelHome from "./components/panel/Home.vue";
import PanelProducts from "./components/panel/product/Products.vue";
import PanelProductCreate from "./components/panel/product/ProductCreate.vue";
import PanelProductEdit from "./components/panel/product/ProductEdit.vue";
import PanelProduct from "./components/panel/product/Product.vue";
import PanelProductCategories from "./components/panel/product/ProductCategories.vue";
import PanelArticles from "./components/panel/article/Articles.vue";
import PanelArticleCreate from "./components/panel/article/ArticleCreate.vue";
import PanelArticleEdit from "./components/panel/article/ArticleEdit.vue";
import PanelArticle from "./components/panel/article/Article.vue";
import PanelArticleCategories from "./components/panel/article/ArticleCategories.vue";
import PanelUsers from "./components/panel/user/Users.vue";
import PanelUserEdit from "./components/panel/user/UserEdit.vue";
import PanelUser from "./components/panel/user/User.vue";
import PanelSlides from "./components/panel/slide/Slides.vue";
import PanelSlideCreate from "./components/panel/slide/SlideCreate.vue";
import PanelSlideEdit from "./components/panel/slide/SlideEdit.vue";
// import PanelSlide from "./components/article/Slide.vue";
import PanelOrders from "./components/panel/order/Orders.vue";
import PanelOrderCreate from "./components/panel/order/OrderCreate.vue";
import PanelOrderEdit from "./components/panel/order/OrderEdit.vue";
import PanelOrder from "./components/panel/order/Order.vue";

import PanelProfile from "./components/panel/admin/Profile.vue";
import PanelAdmins from "./components/panel/admin/Admins.vue";
import PanelFinance from "./components/panel/finance/Finance.vue";
import PanelError404 from "./components/panel/error/Error404.vue";


const routes = [
    //site
    {
        path: "/",
        name: "home",
        component: Home,
    },

    {
        path: "/about",
        name: "about",
        component: About,
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
        name: "PanelHome",
        component: PanelHome,
    },
    {
        path: "/panel/products",
        name: "PanelProducts",
        component: PanelProducts,
    },
    {
        path: "/panel/new/product",
        name: "PanelProductCreate",
        component: PanelProductCreate,
        params:true
    },
    {
        path: "/panel/edit/product/:id",
        name: "PanelProductEdit",
        component: PanelProductEdit,
        params:true
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
        component: PanelOrders,
    },
    {
        path: "/panel/new/order",
        name: "PanelOrderCreate",
        component: PanelOrderCreate,
        params:true
    },
    {
        path: "/panel/edit/order/:id",
        name: "PanelOrderEdit",
        component: PanelOrderEdit,
        params:true
    },
    {
        path: "/panel/order/:id",
        name: "PanelOrder",
        component: PanelOrder,
    },

    {
        path: "/panel/articles",
        name: "PanelArticles",
        component: PanelArticles,
    },
    {
        path: "/panel/new/article",
        name: "PanelArticleCreate",
        component: PanelArticleCreate,
        params:true
    },
    {
        path: "/panel/edit/article/:id",
        name: "PanelArticleEdit",
        component: PanelArticleEdit,
        params:true
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
        path: "/panel/slides",
        name: "PanelSlides",
        component: PanelSlides,
    },
    {
        path: "/panel/new/slide",
        name: "PanelSlideCreate",
        component: PanelSlideCreate,
        params:true
    },
    {
        path: "/panel/edit/slide/:id",
        name: "PanelSlideEdit",
        component: PanelSlideEdit,
        params:true
    },

    {
        path: "/panel/user/:id",
        name: "PanelUser",
        component: PanelUser,
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
        params:true
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
        path: "/panel/admins",
        name: "PanelAdmins",
        component: PanelAdmins,
    },
     {
        path: "/panel/finance",
        name: "PanelFinance",
        component: PanelFinance,
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
