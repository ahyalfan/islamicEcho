
<script setup>
import { onMounted,ref } from "vue";
import UserLayout from "./Layouts/UserLayout.vue"
import { Head, Link, router } from "@inertiajs/vue3";

defineProps({
    history:Array
})

const showPopupGoing = ref(false)
const onGoing = ()=>{
    showPopupGoing.value= true
};
const hidePopup = ()=>{
    showPopupGoing.value= false
};
const random = Math.floor((Math.random()*27)+1)

</script>

<template>
<main class="bg-gray-700 bg-opacity-40 fixed top-0 bottom-0 right-0 left-0 z-10 flex justify-center items-center" @click="hidePopup" v-if="showPopupGoing">
   <div class="border-2 border-black w-1/2 h-auto px-5 text-red-400 bg-slate-800">
        <h1 class="text-xl font-bold">Status On Going.</h1>
        <p class="font-semibold">Informasi terkait akan kita kirim melalui email, dan jika memiliki saran boleh dishare</p>

        <br>
        <p class="text-center">Ok!</p>
   </div>
</main>

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
        <Link :href="route('categories.story.nabi.getdetail',random)">Read Now</Link>
    </div>
</section>
<!-- end section 1 -->

<section v-if="history != 0" class="mx-2 mt-10 dark:bg-black dark:text-white">
    <h1 class="m-4 text-xl font-bold border-b border-black w-16 pb-1">History</h1>
    <div class="mx-6 overflow-x-auto">
        <div class="flex whitespace-nowrap mb-4">
            <div v-for="(item, index) in history" :key="index">
                <Link v-if="item.type == 'surat'" :href="route('categories.alquran.getdetail',item.id)" class="mr-2 rounded-full text-biru_font px-3 py-2 tracking-wide text-sm font-semibold hover:bg-blue-800 hover:text-white">{{ item.name }}</Link>
                <Link v-else :href="route('categories.story.nabi.getdetail',item.id)" class="mr-2 rounded-full text-biru_font px-3 py-2 tracking-wide text-sm font-semibold hover:bg-blue-800 hover:text-white">{{ item.name }}</Link>
            </div>
        </div>
    </div>
</section>

<section class="mx-2 mt-10 dark:bg-black dark:text-white">
    <h1 class="m-4 text-xl font-bold border-b border-black w-24 pb-1">Categories</h1>
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
        <li @click="onGoing" :href="route('categories.hadist.get')" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/hadist_collection3.svg" alt="" class="w-10 h-10">
            <p class="ml-4">Hadist</p>
        </li>
        <Link :href="route('categories.story.nabi.get')" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/red-sea.svg" alt="" class="w-10 h-10">
            <p class="ml-4">Story Nabi</p>
        </Link>
        <li @click="onGoing" as="button" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/murottal.svg" alt="" class="w-10 h-10">
            <p class="ml-4">Murottal</p>
        </li>
        <li @click="onGoing" class="border rounded-md flex p-4 dark:bg-biru_background dark:text-biru_font font-semibold">
            <img src="/img/find-fitur.svg" alt="" class="w-10 h-10">
            <p class="ml-4">On Going</p>
        </li>
    </ul>
</section>

</div>
</UserLayout>

</template>