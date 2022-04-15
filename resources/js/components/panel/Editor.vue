<template>
   <div id="editor"></div>
</template>

<script>
export default {
    name: "Editor",
    // props: ['editorText'],
    data(){
        return{
            txt : "",
        }
    },
    mounted() {

        // this.txt = this.editorText;
        // document.querySelector('.tinymce-body').innerHTML = this.txt || "";
    }
}
</script>

<style scoped>

</style>

