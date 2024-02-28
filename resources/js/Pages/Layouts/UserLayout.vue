<script setup>
import Footer from "./Footer.vue";
import Header from './Header.vue';
import Main from "./Main.vue";


</script>

<template>

<div class="dark:bg-black">
    <!-- navbar -->
<Header></Header>
<!-- navbar end -->
    <slot></slot>

<!-- main -->
<Main></Main>
<!-- main end -->

<!-- footer -->
<Footer></Footer>
<!-- footer end -->
</div>


</template>