
<script setup>
import { onMounted } from "vue";
import UserLayout from "./Layouts/UserLayout.vue"
import { Head, Link, router } from "@inertiajs/vue3";

onMounted(()=>{

});
</script>

<template>

<Head>
    <title>Home</title>
    <meta name="description" content="alquran,doa, yasin, tahlil, dan lain lain">
</Head>

<UserLayout>
<div class="pt-24">
<!-- section 1 saran read propeth -->
<section class="mx-6 py-5 rounded-lg bg-biru_background">
    <div class="my-2 mx-4 flex">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-history mt-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 8l0 4l2 2" /><path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" /></svg>
        <div class="block mx-4 text-biru_font">
            <h2 class="text-xl font-bold">Belajar tentang Nabi</h2>
            <p>Baca tentang kehidupan dan ajaran Nabi</p>
        </div>
    </div>
    <div class="mx-20 mt-3 mb-2 p-1 bg-biru_bacground2 dark:bg-blue-700 rounded-xl border text-center text-xl font-bold text-white">
        <h4>Read Now</h4>
    </div>
</section>
<!-- end section 1 -->

<section class="mx-2 mt-10 dark:bg-black dark:text-white">
    <h1 class="m-4 text-xl font-bold">Categories</h1>
    <ul class="mx-4 grid grid-cols-2 gap-4" aria-label="box-categories">
        <Link :href="route('categories.alquran.get')" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/quran.svg" alt="" class="w-10 h-10">
            <p class="ml-4">Al-Quran</p>
        </Link>
        <Link :href="route('categories.tahlil.get')" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/prayer.svg" alt="" class="w-10 h-10">
            <p class="ml-4">Tahlil dan Yasin</p>
        </Link>
        <Link :href="route('categories.doa.get')" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/pray_4224334.svg" alt="" class="w-10 h-10">
            <p class="ml-4">Doa</p>
        </Link>
        <Link :href="route('categories.hadist.get')" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/hadist_collection3.svg" alt="" class="w-10 h-10">
            <p class="ml-4">Hadist</p>
        </Link>
        <Link :href="route('categories.story.nabi.get')" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/red-sea.svg" alt="" class="w-10 h-10">
            <p class="ml-4">Story Nabi</p>
        </Link>
        <Link href="#" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/murottal.svg" alt="" class="w-10 h-10">
            <p class="ml-4">Murottal</p>
        </Link>
        <Link href="#" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/find-fitur.svg" alt="" class="w-10 h-10">
            <p class="ml-4">On Going</p>
        </Link>
    </ul>
</section>

</div>
</UserLayout>

</template>