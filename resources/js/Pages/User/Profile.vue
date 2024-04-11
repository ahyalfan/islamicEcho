
<script setup>
import { ref } from "vue";
import ProfileLayout from "./../Layouts/ProfileLayout.vue"
import { Head, Link, router, usePage } from "@inertiajs/vue3";

const user = usePage().props.user;

const teksToCopy = ref(null);
const copyText = ()=>{
    const teks = 'https://islamicEcho.my.id';
      const tempInput = document.createElement('input');
      tempInput.value = teks;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand('copy');
      document.body.removeChild(tempInput);
      //alert('Link berhasil disalnin!');
};

const showPopupGoing = ref(false)
const showDonate = ()=>{
    showPopupGoing.value= true
};
const hidePopup = ()=>{
    showPopupGoing.value= false
};

</script>

<template>

<main class="bg-gray-700 bg-opacity-40 fixed top-0 bottom-0 right-0 left-0 z-10 flex justify-center items-center" @click.self="hidePopup" v-if="showPopupGoing">
   <div class="border-2 border-black w-1/2 h-auto px-5 py-2 text- bg-biru_background">
       <h1 class="text-xl font-bold text-biru_font">Donate to Bank</h1>
       <p class="font-semibold">Bank Mandiri</p>
        <p class="font-semibold text-sm">Name - <span class="font-medium">AHMAD YOGI AL FANDI</span></p>
        <p class="font-semibold">No. Rekening - <span class="font-medium">1780006518068</span></p>
<br>
        <h1 class="text-xl font-bold text-biru_font">Donate to OVO</h1>
        <p class="font-semibold text-sm">Name - <span class="font-medium">AHMAD YOGI AL FANDI</span></p>
        <p class="font-semibold">OVO Number - <span class="font-medium">083846451695</span></p>
   </div>
</main>

<Head>
    <title>Profile</title>
    <meta name="description" content="alquran,doa, yasin, tahlil, dan lain lain">
</Head>

<ProfileLayout>
<div class="pt-24">

<section class="mx-8 mt-5 dark:bg-black dark:text-white">
    <div class="flex justify-center my-2" >
        <div class="h-16 w-16 rounded-full flex justify-center items-center border-2 border-black">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg> -->
            <img class="rounded-full" src="https://source.unsplash.com/random/200x200?sig=1" />
        </div>
    </div>
    <h1 class="text-center font-semibold text-3xl">{{ user.name }}</h1>
    <h4 class="text-center text-sm">{{ user.email }}</h4>
    <div class="flex justify-center my-9">
        <Link class="flex bg-biru_background text-biru_font font-semibold py-2 px-3 rounded-xl" :href="route('profile.edit')" as="button" type="button">
            edit profile
        </Link>
    </div>
    <div class="my-10 font-semibold">
        <h1>Share WebApp Link</h1>
        <div class="flex justify-around bg-slate-200 my-1 py-5 px-1 rounded-xl">
            <h1>Share with friend</h1>
            <a href='whatsapp://send?text=https://islamicEcho.my.id' class="bg-biru_background text-biru_font font-semibold px-5 py-1 rounded-lg" @click="copyText">
                share
            </a>
        </div>
    </div>
    <div class="flex justify-center my-9">
        <button class="flex bg-biru_background text-biru_font font-semibold py-3 px-3 rounded-xl" @click="showDonate">
            donate for us
        </button>
    </div>
    <div class="flex justify-center my-10 font-semibold py-2 px-3 rounded-xl">
        <Link class="flex bg-red-800 text-white py-2 px-3 rounded-lg" :href="route('logout')" method="post" as="button" type="button">
            logout
        </Link>
    </div>

</section>
</div>
</ProfileLayout>


</template>