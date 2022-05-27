<template>
    <div>
        <h1>this is container</h1>
        .
        .
        .
        .
        <slot/>
    </div>
</template>

<script>
import {ref} from "vue";

export default {
    setup() {

        const a = ref();
        a.value = 8;
        console.log('issss');
        console.log(a.value);
        return {
            a,
        }
    }
}
</script>

<style scoped>
</style>
