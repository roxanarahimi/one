<template>
    <div class="w-100 text-center">
        <img src="loader.png" id="spin" width="40" height="40"/>
<!--        <p>درحال بارگذاری...</p>-->
    </div>
</template>

<script>
    export default {
        name: "Loader"
    }
</script>

<style scoped>
   div{
       z-index: 1000 !important;
   }
    #spin{
        /*margin: 20px;*/
        /*width: 100px;*/
        /*height: 100px;*/
        /*background: #f00;*/
        opacity: 0.65;
        -webkit-animation-name: spin;
        -webkit-animation-duration: 1000ms;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: linear;
        -moz-animation-name: spin;
        -moz-animation-duration:1000ms;
        -moz-animation-iteration-count: infinite;
        -moz-animation-timing-function: linear;
        -ms-animation-name: spin;
        -ms-animation-duration: 1000ms;
        -ms-animation-iteration-count: infinite;
        -ms-animation-timing-function: linear;

        animation-name: spin;
        animation-duration: 1000ms;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }
    @-moz-keyframes spin {
        from { -moz-transform: rotate(0deg); }
        to { -moz-transform: rotate(360deg); }
    }
    @-webkit-keyframes spin {
        from { -webkit-transform: rotate(0deg); }
        to { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
        from {transform:rotate(0deg);}
        to {transform:rotate(360deg);}
    }

</style>
