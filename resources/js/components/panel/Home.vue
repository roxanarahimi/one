<template>
    <!--<h3>داشبورد</h3>-->
    <transition name="route" mode="out-in" appear>
        <section>
            <div>
<!--                <Suspense>-->
<!--                    <template #default>-->
                        <latest-products/>
<!--                    </template>-->
<!--                    <template #fallback>-->
<!--                        <loader/>-->
<!--                    </template>-->
<!--                </Suspense>-->
                <!--                                <p id="msg"></p>-->
            </div>
        </section>
    </transition>


</template>
<script>
import App from './App';
import Loader from "../site/components/Loader";
import LatestProducts from "./LatestProducts";


export default {
    components: {Loader, LatestProducts, App},
    data() {
        return {
            // allData: [],
        }
    },
    mounted() {
        document.querySelector('#admin_label').innerHTML = JSON.parse(localStorage.getItem('admin')).name;
        // this.loadData();
    },
    methods: {
        async loadData() {
            await App.methods.checkToken();
            console.log('checked');
            // await axios.get('/api/panel/latest/product')
            //     .then(async (response) => {
            //         // setTimeout(async ()=>{
            //         if (response.data.length !== 0) {
            //             // await document.getElementById('loader').remove();
            //             this.allData = await response.data;
            //             // document.getElementById('loader').classList.add('d-none');
            //         } else {
            //             // await document.getElementById('loader').remove();
            //
            //             // document.getElementById('msg').innerText =await 'محصولی پیدا نشد';
            //         }
            //         // },3000)
            //
            //     })
            //     .catch();
        }


    }
}

</script>
<style>
.blog-img {
    /*min-height: 200px;*/
    /*background: whitesmoke;*/
}

.blog, .blog:hover {
    color: black;
    text-decoration: none;
}

#spin {
    /*margin: 20px;*/
    /*width: 100px;*/
    /*height: 100px;*/
    /*background: #f00;*/
    -webkit-animation-name: spin;
    -webkit-animation-duration: 1500ms;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    -moz-animation-name: spin;
    -moz-animation-duration: 1500ms;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
    -ms-animation-name: spin;
    -ms-animation-duration: 1500ms;
    -ms-animation-iteration-count: infinite;
    -ms-animation-timing-function: linear;

    animation-name: spin;
    animation-duration: 1500ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@-moz-keyframes spin {
    from {
        -moz-transform: rotate(0deg);
    }
    to {
        -moz-transform: rotate(360deg);
    }
}

@-webkit-keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.pointer {
    cursor: pointer;
}
</style>
