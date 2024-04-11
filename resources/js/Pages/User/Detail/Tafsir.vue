<script setup>
import { ref } from "vue";
import CategoriesLayout from "../../Layouts/CategoriesLayout.vue"

import { usePage,Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import Axios from "axios";

const surat = usePage().props.ayats[0].surat;
const dataprevsurat = usePage().props.dataprevsurat;
const ayats = usePage().props.ayats;
const tafsirs = usePage().props.ayats[0].tafsir;
const user = usePage().props.auth.user;

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
let prevSurah = (1 == ayats[0].nomer_ayat) ? (surat.nomer_surah - 1) : (surat.nomer_surah);
const nextSurah = (surat.jum_ayat == ayats[0].nomer_ayat) ? (surat.nomer_surah + 1) : (surat.nomer_surah);

if(surat.nomer_surah == 1 && ayats[0].nomer_ayat == 1){
    prevSurah = 1
}
const prevAyat = (surat.nomer_surah != prevSurah) ? dataprevsurat.jum_ayat : ayats[0].nomer_ayat - 1;
// const prevAyat1 = ayats[0].nomer_ayat - 1;
const nextAyat = (surat.nomer_surah != nextSurah)? 1 :ayats[0].nomer_ayat + 1;


// tafsir
const tafsirShowNow = ref(true);
const wajiz = ref(" bg-biru_background text-biru_font");
const tahlili = ref("");
const tafsirShowTahlili = ()=>{
    tafsirShowNow.value = false;
    tahlili.value = " bg-biru_background text-biru_font"
    wajiz.value = ""
}
const tafsirShowWajiz = ()=>{
    tafsirShowNow.value = true;
    tahlili.value = ""
    wajiz.value = " bg-biru_background text-biru_font"
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
                <div class="mx-auto flex justify-center">
                    <Link :href="route('categories.alquran.getdetailtafsir',[prevSurah,prevAyat])" v-if="prevSurah != 0 && prevAyat != 0" class="mx-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                        </svg>
                    </Link>

                    <Link :href="route('categories.alquran.getdetailtafsir',[ nextSurah,nextAyat])" v-if="nextSurah != 115">
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
                            <img @click="tafsirShow()" class="w-5 h-6" src="/img/logo/book.svg" alt="">
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
                        <p v-show="latinData ==false" class="text-biru_font tracking-wide" v-html="ayat.latin"></p>
                        <p v-show="terjemahanData == false">{{ ayat.indo }}</p>
                    </main>
                    <main class="flex mt-8 mb-4" style="font-size: 16px !important;">
                        <button @click="tafsirShowWajiz" :class="'basis-1/3 p-1 rounded-xl'+wajiz">Tafsir Wajiz</button>
                        <button @click="tafsirShowTahlili" :class="'basis-1/3 p-1 rounded-xl'+tahlili">Tafsir Tahlili</button>
                    </main>
                    <section>
                        <ul class="border p-4 tracking-wide">
                            <li v-if="tafsirShowNow">
                                {{ tafsirs[0].description }}
                            </li>
                            <li v-else>
                                {{ tafsirs[1].description }}
                            </li>
                        </ul>
                    </section>
                </div>
            </li>
            <li v-else v-for="(ayat, index) in ayats" class="mt-6 mx-4" style="font-size:1rem;" :id="ayat.id">
                <div>
                    <nav class="flex mb-5">
                        <div class="basis-1/3 flex justify-around items-center">
                            <p style="font-size: 1.3rem;" class="mr-2">{{ surat.nomer_surah+':'+ayat.nomer_ayat }}</p>
                            <img @click="tafsirShow" class="w-5 h-6" src="/img/logo/book.svg" alt="">
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
                    <main class="border-b border-slate-200 pb-5">
                        <h6 class="flex justify-end" style="font-size: 2.5rem;">
                            {{ ayat.arab }}
                        </h6>
                        <p v-show="latinData == false" class="text-biru_font tracking-wide" v-html="ayat.latin"></p>
                        <p v-show="terjemahanData ==  false">{{ ayat.indo }}</p>
                    </main>
                    <main class="flex mt-8 mb-4">
                        <button @click="tafsirShowWajiz" :class="'basis-1/3 p-1 rounded-xl'+wajiz">Tafsir Wajiz</button>
                        <button @click="tafsirShowTahlili" :class="'basis-1/3 p-1 rounded-xl'+tahlili">Tafsir Tahlili</button>
                    </main>
                    <section>
                        <ul class="border p-4 tracking-wide">
                            <li v-if="tafsirShowNow">
                                {{ tafsirs[0].description }}
                            </li>
                            <li v-else>
                                {{ tafsirs[1].description }}
                            </li>
                        </ul>
                    </section>
                </div>
            </li>
        </ul>
    </CategoriesLayout>
</template>