<template>
    <div class="w-100">
        <div class="col-12 row m-0">
            <img @click="open(0)" v-if="images && images[0]" class="img-fluid mb-2 col-12 p-0 pe-1" :src="images[0]" >
            <img @click="open(1)" v-if="images && images[1]"  class="img-fluid col-3 p-0 pe-1" :src="images[1]"/>
            <img @click="open(2)" v-if="images && images[2]"  class="img-fluid col-3 p-0 pe-1" :src="images[2]"/>
            <img @click="open(3)" v-if="images && images[3]"  class="img-fluid col-3 p-0 pe-1" :src="images[3]"/>
            <img @click="open(4)" v-if="images && images[4]"  class="img-fluid col-3 p-0 pe-1" :src="images[4]"/>
            <div id="frame-wrapper" class="d-none">
                <div id="frame" class="d-flex justify-content-between">
                    <span id="close" @click="close" class="text-light"><i class="bi bi-x-square-fill"></i></span>

                    <span @click="prevImage" class="text-light span"><i class="bi bi-caret-right-square-fill"></i></span>
                        <img id="maximized-img" class="rounded" :src="images[i]">
                    <span @click="nextImage" class="text-light span"><i class="bi bi-caret-left-square-fill"></i></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'images'
    ],
    name: "Images",
    data() {
        return {
            i: 0,
        }
    },
    mounted() {

    },
    methods:
        {
            nextImage() {

                let image = document.getElementById('maximized-img');
                image.style.opacity = '0';
                this.i += 1;
                if (!this.images[this.i]) {
                    this.i = 0;
                }
                image.style.opacity = '1';

            },
            prevImage() {
                let image = document.getElementById('maximized-img');

                image.style.opacity = '0';
                this.i -= 1;
                if (!this.images[this.i]) {
                    this.i = this.images.length - 1;
                }
                image.style.opacity = '1';
            },
            open(index) {
                this.i = index;
                document.getElementById('frame-wrapper').classList.remove('d-none');
            },
            close() {
                document.getElementById('frame-wrapper').classList.add('d-none');
            },
        }
}
</script>

<style scoped>
img{
    cursor: pointer;
}
#frame-wrapper {
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.75);
    text-align: center;
    vertical-align: middle;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 100;
    padding-top: 100px;
}

#frame {
    font-size: 30px !important;
    vertical-align: middle !important;
    width: 60%;
    min-height: 300px;
    margin: 0 auto;
    padding: 40px;

    /*background-color: rgba(0, 0, 0, 0.5);*/
}

#frame .span {
    margin-top: 20%;
}

#maximized-img {
    width: 70%;
    transition: 1s ease;
}
#close{
    position: relative;
    top:-4px;
    right: 20%;
    z-index: 100;

}
#close i{
    color: black !important;
    /*background-color: white !important;*/
    padding: 0px;
    margin: 0px;
}
</style>
