<script setup>
import { ref } from "vue";
import CategoriesLayout from "../../Layouts/CategoriesLayout.vue"

import { usePage,Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import Axios from "axios";

const ayats = usePage().props.ayats;
const user = usePage().props.auth.user;

// Fungsi untuk mengonversi angka Latin menjadi teks Arab
const convertToArabic = (number) => {
      const arabicNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
      return number
        .toString() // Ubah angka Latin menjadi string
        .split('') // Pisahkan setiap digit angka
        .map(digit => arabicNumbers[digit]) // Ganti setiap digit dengan teks Arab yang sesuai
        .join(''); // Gabungkan kembali semua digit menjadi satu string
};

// kita akan coba tangkep emitnya
    const fontData = ref({
        fontSize: ""
    })
    const fontArab = ref({
        fontSize: ""
    })
    const latinData = ref(false)
    const terjemahanData = ref(false)
    const qoryData = ref("alafasy")
    const fontSizez = (nilai) => {
        fontData.value.fontSize = nilai+"rem"
        fontArab.value.fontSize = 1+nilai+"rem"
    };
    const latin = (nilai) => {
        latinData.value = nilai
    };
    const terjemahan = (nilai) => {
        terjemahanData.value = nilai
    };
    const qory = (nilai) => {
        qoryData.value = nilai
    };


// fitur bookmark
const dataBookmarkDoa = usePage().props.dataBookmarkDoa;
const dataBookmarkDoa2 = ref(dataBookmarkDoa)
    const deleteBookmark = async (index,user,itemId,type)=>{
     if(user == null){
        return router.get("/login")
     }
        try {
            const response = await Axios.post('/categories/delete-bookmark', {
                id: itemId,
                type: type,
            });
            dataBookmarkDoa2.value[index] = false
            console.log(response.data.message);
        } catch (error) {
            console.error("Error deleting bookmark:", error);
        }
    }
    const addBookmark = async (index,user,itemId,type)=>{
     if(user == null){
        return router.get("/login")
     }
        try {
            const response = await Axios.post('/categories/add-bookmark', {
                id: itemId,
                type: type,
            });
            dataBookmarkDoa2.value[index] = true
            console.log(response.data.message);
        } catch (error) {
            console.error("Error add bookmark:", error);
        }
    }

const goBack = ()=>{
    window.history.back();
}
;</script>
<template>
    <CategoriesLayout @font="fontSizez" @qory="qory" @terjemahan="terjemahan" @latin="latin">
        <template v-slot:control>
            <!-- cara untu membuat slot banyak kita harus implementasikanya nama slotny susai bisa gunakan v-slot -->
            <div class="flex">
                <svg @click="goBack" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
            </div>
        </template>

        <ul>
            <li v-if="fontData.fontSize !=''" v-for="(ayat, index) in ayats" :key="ayat.id" class="mt-6 mx-4" :style="fontData" :id="ayat.id">
                <div class="text-center mb-5 text-xl" v-if="ayat.nomer_ayat == 1">
                    <h5 class="font-lateef text-bold" style="font-size: 3rem;">{{ ayat.surat.arab }}</h5>
                    <h1 class="font-lalezar">{{ ayat.surat.indo }}</h1>
                    <p>{{ ayat.surat.golongan +' - '+ ayat.surat.jum_ayat}}</p>
                </div>
                <div>
                    <nav class="flex mb-5">
                        <div class="basis-1/3 flex justify-around items-center">
                            <p style="font-size: 1.3rem;">{{ ayat.surat.nomer_surah+':'+ayat.nomer_ayat }}</p>
                            <Link :href="route('categories.alquran.getdetailtafsir',[ayat.surat_id,ayat.nomer_ayat])">
                                <img class="w-5 h-6 focus:shadow-md hover:shadow-md shadow-black" src="/img/logo/book.svg" alt="">
                            </Link>
                            <img v-if="dataBookmarkDoa2[index]" class="w-5 h-5 pt-1" src="/img/logo/bookmark-biru.svg" alt="" @click="deleteBookmark(index,user,ayat.id,ayat.type)">
                            <img v-else @click="addBookmark(index,user,ayat.id,ayat.type)" class="w-5 h-5 pt-1" src="/img/logo/bookmark.svg" alt="">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>
                            </span>
                        </div>
                        <div class="basis-2/3 flex justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </div>
                    </nav>
                    <main>
                        <h6 class="flex justify-end mx-4" :style="fontArab ">
                            <!-- <div class="relative">
                                <div :style="{imgData}">
                                    <img src="/img/logo/ayat_icon.svg" alt="">
                                </div>
                                <p class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">{{ convertToArabic(ayat.nomer_ayat) }}</p>
                            </div>  -->
                            {{ ayat.arab }}
                        </h6>
                        <p v-show="latinData == false" class="text-biru_font tracking-wide" v-html="ayat.latin"></p>
                        <p v-show="terjemahanData == false" >{{ ayat.indo }}</p>
                    </main>
                </div>
            </li>
            <li v-else v-for="(ayat, index) in ayats" class="mt-6 mx-4" style="font-size:1rem;" :id="ayat.id">
                <div class="text-center mb-5 text-xl" v-if="ayat.nomer_ayat == 1">
                    <h5 class="font-lateef font-bold" style="font-size: 3rem;">{{ ayat.surat.arab }}</h5>
                    <h1 class="font-lalezar">{{ ayat.surat.indo }}</h1>
                    <p>{{ ayat.surat.golongan +' - '+ ayat.surat.jum_ayat}}</p>
                </div>
                <div>
                    <nav class="flex mb-5">
                        <div class="basis-1/3 flex justify-around items-center">
                            <p style="font-size: 1.3rem;">{{ ayat.surat.nomer_surah+':'+ayat.nomer_ayat }}</p>
                            <Link :href="route('categories.alquran.getdetailtafsir',[ayat.surat_id,ayat.nomer_ayat])">
                                <img class="w-5 h-6 focus:shadow-md hover:shadow-md shadow-black" src="/img/logo/book.svg" alt="">
                            </Link>
                            <img v-if="dataBookmarkDoa2[index]" class="w-5 h-5 pt-1" src="/img/logo/bookmark-biru.svg" alt="" @click="deleteBookmark(index,user,ayat.id,ayat.type)">
                            <img v-else @click="addBookmark(index,user,ayat.id,ayat.type)" class="w-5 h-5 pt-1" src="/img/logo/bookmark.svg" alt="">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>
                            </span>
                        </div>
                        <div class="basis-2/3 flex justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </div>
                    </nav>
                    <main>
                        <h6 class="flex justify-end" style="font-size: 2.5rem;">
                            <!-- <div class="relative">
                                <div style="width: 3rem; height: 3rem;">
                                    <img src="/img/logo/ayat_icon.svg" alt="">
                                </div>
                                <p class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">{{ convertToArabic(ayat.nomer_ayat) }}</p>
                            </div>  -->
                            {{ ayat.arab }}
                        </h6>
                        <p v-show="latinData == false" class="text-biru_font tracking-wide" v-html="ayat.latin"></p>
                        <p  v-show="terjemahanData == false">{{ ayat.indo }}</p>
                    </main>
                </div>
            </li>
        </ul>
    </CategoriesLayout>
</template>