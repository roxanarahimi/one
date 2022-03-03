<template>
    <transition name = "route" mode = "out-in" appear>
        <section>
            <h3 class = "mb-5">ثبت اسلاید جدید</h3>

            <div class = "row mt-3">
                <div class = "col-12 mb-3">
                    <div class = "card">
                        <div class = "card-body">
                            <form id = "editForm">
                                <div class = "row">
                                    <div class = "col-12 mb-3">
                                        <label class = "form-label">تصویر</label><br/>
                                        <image-cropper name = "" caption = "" :hasCaption = "hasCaption" :isRequired = "imgRequired" :aspect = "aspect"/>
                                        <div id = "imageHelp" class = "form-text error"></div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-md-3 mb-3">
                                        <label for = "title" class = "form-label">عنوان</label>
                                        <input type = "text" :class = "{hasError: errors.title}" class = "form-control" id = "title" aria-describedby = "titleHelp" required>
                                        <div id = "titleHelp" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.title">{{ e }}</p>
                                    </div>
                                    <div class = "col-md-6 mb-3">
                                        <label for = "subTitle" class = "form-label">زیرنویس</label>
                                        <input type = "text" :class = "{hasError: errors.subTitle}" class = "form-control text-start" id = "subTitle" required>
                                        <div id = "subTitleHelp" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.subTitle">{{ e }}</p>

                                    </div>
                                    <div class = "col-md-3 mb-3">
                                        <label for = "link" class = "form-label">لینک</label>
                                        <input type = "text" :class = "{hasError: errors.link}" class = "form-control" id = "link" aria-describedby = "linkHelp" required>
                                        <div id = "linkHelp" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.link">{{ e }}</p>

                                    </div>

                                    <div class = "col-md-12 mb-3">
                                        <button class = "btn btn-primary" @click.prevent = "createInfo" type = "submit">
                                            <!--                                        <button class = "btn btn-primary" type = "submit">-->
                                            ثبت
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class = "progress_container d-none" dir = "ltr">
                <div class = "progress" style = "height: 20px;">
                    <div class = "progress-bar " role = "progressbar" :style = "'width:'+progress+'%'" :aria-valuenow = "progress" aria-valuemin = "0" aria-valuemax = "100"></div>
                </div>
            </div>

        </section>
    </transition>

</template>

<script>
    import ImageCropper from '../ImageCropper';
    import App from '../App';
    // import {toArray} from "../../../public/cropperjs/src/js/utilities";

    export default {
        components: {ImageCropper},
        //props:['type'],
        data: function () {
            return {
                id: '',
                blog: [],
                errors: [],
                image_codes: [],
                image_names: [],
                imgRequired: true,
                hasCaption: false,
                aspect: 16 / 9,
                progress: 0,
            }
        },
        mounted() {

        },
        methods: {
            async createInfo() {
                // axios.post('/api/panel/check/user/token', {id: JSON.parse(localStorage.getItem('user')).id})
                //     .then((response) => {
                //         console.log(response);
                //         if (response.status === 200) {
                //             localStorage.setItem('expire', response.data.expire);
                //             console.log(localStorage);
                //         }
                //     })
                //     .then(() => {
                await App.methods.checkToken();

                document.querySelector('.progress-bar').classList.remove('bg-danger');
                document.querySelector('.progress_container').classList.add('d-none');
                this.progress = 0;

                this.errors = [];
                let emptyFieldsCount = 0;
                let req = document.querySelectorAll('[required]');
                req.forEach((element) => {
                    if (element.value === "") {
                        element.classList.add('hasError');
                        element.nextSibling.innerHTML = "فیلد اجباری";
                        emptyFieldsCount++;
                    } else {
                        element.classList.remove('hasError');
                        element.nextSibling.innerHTML = "";
                    }
                });


                if (emptyFieldsCount === 0) {
                    let features = [];
                    for (let i = 0; i < document.getElementsByName('featureLabel').length; i++) {
                        features.push('{"label": "' + document.getElementsByName('featureLabel')[i].value + '", "value": "' + document.getElementsByName('featureValue')[i].value + '"}');
                    }
                    if (document.getElementsByName('featureLabel').length === 0) {
                        features = '[]';
                    } else {
                        features = '[' + features.toString() + ']';
                    }

                    document.querySelector('.progress_container').classList.remove('d-none');
                  await axios.post('/api/panel/slide', {
                            image: document.getElementById('Image__code').value,
                            title: document.getElementById('title').value,
                            subTitle: document.getElementById('subTitle').value,
                            link: document.getElementById('link').value,

                        }, {
                            onUploadProgress: e => {
                                if (e.lengthComputable) {
                                    this.progress = (e.loaded / e.total) * 100;
                                    console.log(e.loaded, e.total);
                                    document.querySelector('.progress-bar').innerHTML = parseInt(this.progress) + '%';
                                }
                            }
                        }
                    )
                        .then((response) => {
                            console.log(response.data)
                            if (response.status === 201 || response.status === 200) {
                                document.querySelector('.progress-bar').classList.remove('bg-danger');
                                document.querySelector('.progress-bar').classList.add('bg-success');
                                setTimeout(() => {
                                    this.$router.push({path: '/panel/slides'});
                                }, 1000);

                            }
                        })
                        .catch((error) => {
                            console.log(error);
                            console.log(error.message);
                            console.log(error.data);

                            if (error.status === 422) {

                                document.querySelector('.progress-bar').classList.add('bg-danger');
                                // setTimeout(()=>{
                                //     document.querySelector('.progress_container').classList.add('d-none');
                                // },1000);

                                let errorList = Array(error.data);
                                // console.log(error.response.data);
                                for (var i = 0; i < errorList.length; i++) {
                                    //  console.log('i',errorList[i]);
                                    this.errors = errorList[i];
                                }
                                console.log(this.errors.toString());
                                setTimeout(() => {
                                    document.querySelector('.progress_container').classList.add('d-none');
                                }, 1000);
                            } else if (error.status === 500) {
                                if (error.data.message.includes("SQLSTATE")) {
                                    console.error('خطای پایگاه داده');

                                    async function showAlertSql() {
                                        await document.querySelector('.progress-bar').classList.add('bg-danger');
                                        setTimeout(() => {
                                            alert(error.response.data.message);
                                        }, 200);
                                    }

                                    showAlertSql();
                                } else {
                                    async function showAlert500() {
                                        await document.querySelector('.progress-bar').classList.add('bg-danger');
                                        setTimeout(() => {
                                            alert(error.message + ' '
                                                + error.response.data.message);
                                        }, 200);
                                    }

                                    showAlert500();
                                }
                            } else {

                                async function showAlert() {
                                    await document.querySelector('.progress-bar').classList.add('bg-danger');
                                    setTimeout(() => {
                                        alert(error.message);
                                    }, 200);
                                }

                                showAlert();
                            }

                        })
                }
                // })
                // .catch((error) => {
                //     console.log(error);
                //
                //     if (error.response && error.response.status && error.response.status === 401) {
                //         window.location = '/panel/login'
                //         App.methods.logout();
                //     }
                // });


            },

        }
    }
</script>
<style>
    span i {
        cursor: pointer;
    }
</style>
