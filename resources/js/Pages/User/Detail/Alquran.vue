<script setup>
import { ref,watch } from "vue"; //ref bisa juga untuk menandai element
import CategoriesLayout from "../../Layouts/CategoriesLayout.vue"

import { usePage,Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import Axios from "axios";
import { onBeforeMount } from "vue";
import { onUnmounted } from "vue";

import store from "./store.js"
import { onMounted } from "vue";

const surat = usePage().props.surat[0];
const ayats = usePage().props.surat[0].ayat;
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
    const qoryData = ref("https://cdn.islamic.network/quran/audio/128/ar.alafasy/")
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
        ayats.forEach(ayat => {
            audioE[ayat.nomer_ayat -1] = new Audio();
            audioE[ayat.nomer_ayat - 1].src = nilai+ayat.id+".mp3"
        });
    };

// bookmark
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

// next and prev 
const prevSurah = surat.nomer_surah - 1;
const nextSurah = surat.nomer_surah + 1;

// nyalakan murothal berdarkan pilihan
const audioE = ref([])
const showAudioParent = ref(false)
const isPlay = ref(false)
const isPlayData = ref(Object)
let duration = 0
// ayats.forEach((ayat,index) => {
//     audioE[ayat.nomer_ayat -1] = new Audio();
//     audioE[ayat.nomer_ayat - 1].src = qoryData.value+ayat.id+".mp3"
//     audioE[ayat.nomer_ayat - 1].type = "audio/mpeg"
// });

// coba async 
async function asyncForEach(array, callback) {
  for (let index = 0; index < array.length; index++) {
    await callback(array[index], index, array);
  }
}
asyncForEach(ayats, async (ayat, index) => {
    console.log('Index:', index);
    audioE[ayat.nomer_ayat -1] = new Audio();
    audioE[ayat.nomer_ayat - 1].src = qoryData.value+ayat.id+".mp3"
    audioE[ayat.nomer_ayat - 1].type = "audio/mpeg"
});

const playAudio = (index) => {
    showAudioParent.value = true;
    localStorage.setItem('audioShow',true);

    if(isPlay.value){
        // stopAudio(index)
        isPlay.value = false
        isPlayData.value.pause();
        console.log('pause')
        isPlayData.value.currentTime = 0; // Kembalikan waktu pemutaran ke awal;
    }
    startAudio(index)
    // audioE[index].play();
    audioE[index].addEventListener('ended', function() {
        console.log('Audio selesai diputar');
        playAudio(index + 1);
        // isPlay.value = false
    });
    if(isPlay.value == false){
        isPlay.value = true
    }
    isPlayData.value = audioE[index];
    store.audio = isPlayData.value
    store.duration = isPlayData.value.duration
    console.log(isPlayData.value)
}
const startAudio = (index) => {
    audioE[index].play();
    console.log('test')
}
const stopAudio = (index) => {
    audioE[index].pause();
    // console.log(audioE)
}
const jedaData = ref(true)
const lanjutkan = (nilai)=>{
    if(nilai){
        isPlayData.value.play();
        jedaData.value = nilai
    }else{
        isPlayData.value.pause();
        jedaData.value = nilai
    }
}

const close1 = (nilai)=>{
    showAudioParent.value = nilai
    isPlayData.value.pause();
}

// disini kita pakai cara yg lumanyan ribet karena kita harus membuat file js untuk menyimpan data sementara object audio
onUnmounted(() => {
    console.log('unmount')
    if(store.audio){
        store.audio.pause();
    }
})


const goBack = ()=>{
        window.history.back();
    }
;</script>
<template>
    <CategoriesLayout :sendData="showAudioParent" :sendJudul="surat" @font="fontSizez" @qory="qory" @terjemahan="terjemahan" @latin="latin" @jeda="lanjutkan" @exit="close1">
        <template v-slot:control>
            <!-- cara untu membuat slot banyak kita harus implementasikanya nama slotny susai bisa gunakan v-slot -->
            <div class="flex">
                <svg @click="goBack" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <div class="mx-auto flex justify-center">
                    <Link :href="route('categories.alquran.getdetail', prevSurah)" v-if="prevSurah != 0" class="mx-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                        </svg>
                    </Link>

                    <Link :href="route('categories.alquran.getdetail', nextSurah)" v-if="nextSurah != 115">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </Link>
                </div>
            </div>
        </template>

        <ul>
            <li>
                <div class="text-center text-xl">
                    <h5 class="font-lateef text-bold my-3" style="font-size: 3rem;">{{ surat.arab }}</h5>
                    <h1 class="font-lalezar text-2xl font-semibold">{{ surat.indo }}</h1>
                    <p class="text-lg">{{ surat.golongan +' - '+ surat.jum_ayat}}</p>
                </div>
            </li>
            <li v-if="fontData.fontSize !=''" v-for="(ayat, index) in ayats" :key="ayat.id" class="mt-6 mx-4" :style="fontData" :id="ayat.id">
                <div>
                    <nav class="flex mb-5">
                        <div class="basis-1/3 flex justify-around items-center">
                            <p style="font-size: 1.3rem;" class="">{{ surat.nomer_surah+':'+ayat.nomer_ayat }}</p>
                            <Link :href="route('categories.alquran.getdetailtafsir',[ayat.surat_id,ayat.nomer_ayat])">
                                <img class="w-5 h-6 focus:shadow-md hover:shadow-md shadow-black" src="/img/logo/book.svg" alt="">
                            </Link>
                            <img v-if="dataBookmarkDoa2[index]" class="w-5 h-5 pt-1" src="/img/logo/bookmark-biru.svg" alt="" @click="deleteBookmark(index,user,ayat.id,ayat.type)">
                            <img v-else @click="addBookmark(index,user,ayat.id,ayat.type)" class="w-5 h-5 pt-1" src="/img/logo/bookmark.svg" alt="">
                            <span>
                                <svg @click="playAudio(ayat.nomer_ayat - 1)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1 ml-[2px]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
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
                        <p v-show="terjemahanData == false">{{ ayat.indo }}</p>
                    </main>
                </div>
            </li>
            <li v-else v-for="(ayat, index) in ayats" class="mt-6 mx-4" style="font-size:1rem;" :id="ayat.id">
                <div>
                    <nav class="flex mb-5">
                        <div class="basis-1/3 flex justify-around items-center">
                            <p style="font-size: 1.3rem;" class="mr-2">{{ surat.nomer_surah+':'+ayat.nomer_ayat }}</p>
                            <Link :href="route('categories.alquran.getdetailtafsir',[ayat.surat_id,ayat.nomer_ayat])">
                                <img class="w-5 h-6 focus:shadow-md hover:shadow-md shadow-black" src="/img/logo/book.svg" alt="">
                            </Link>
                            <img v-if="dataBookmarkDoa2[index]" class="w-5 h-5 pt-1" src="/img/logo/bookmark-biru.svg" alt="" @click="deleteBookmark(index,user,ayat.id,ayat.type)">
                            <img v-else @click="addBookmark(index,user,ayat.id,ayat.type)" class="w-5 h-5 pt-1" src="/img/logo/bookmark.svg" alt="">
                            <span>
                                <svg @click="playAudio(ayat.nomer_ayat - 1)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1 ml-[2px]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
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
                        <p v-show="terjemahanData == false">{{ ayat.indo }}</p>
                    </main>
                </div>
            </li>
        </ul>
    </CategoriesLayout>
</template>