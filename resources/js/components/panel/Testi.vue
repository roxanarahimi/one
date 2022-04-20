<template>

    <div>
        <h1>portfolio</h1>
        <div class="rounded-circle border border-primary mx-auto" style="width: 300px;height: 300px;margin-top: 50px;">
            <div class="rounded-circle border border-primary mx-auto"
                 style="width: 200px;height: 200px;margin-top: 50px;">
                <div class="rounded-circle bg-primary text-light mx-auto " style="width: 100px;height: 100px;margin-top: 50px;">
                    <img src="/images/camera.png" draggable="true" width="100" style="width:100px !important">
                </div>
            </div>
        </div>

        <div id="sq1" @dragenter="drop(1)"  class="square bg-warning" data-info = "1" style="width: 200px; height: 200px; border-radius: 10px"></div>
        <div id="sq2" @dragenter="drop(2)" class="square bg-danger"  data-info = "2" style="width: 200px; height: 200px; border-radius: 10px"></div>
        <div id="sq3" @dragenter="drop(3)"  class="square bg-info" data-info = "3" style="width: 200px; height: 200px; border-radius: 10px"></div>
        <div id="sq4" @dragenter="drop(4)" class="square bg-success" data-info = "4" style="width: 200px; height: 200px; border-radius: 10px"></div>
    </div>

</template>

<script>
export default {

    name: "Testi",
    data() {
        return {}
    },
    methods:{
        drop(info){
            console.log(info);
        }
    }
}
</script>

<style scoped>
.square{

}
#sq1{
    position: absolute;
    top:100px;
    right:35%;
}
#sq2{
    position: absolute;
    bottom:200px;
    right:35%;
}
#sq3{
    position: absolute;
    top:100px;
    left:30%;
}
#sq4{
    position: absolute;
    bottom:200px;
    left: 30%;
}


</style>
