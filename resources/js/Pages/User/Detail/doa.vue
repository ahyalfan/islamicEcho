<script setup>
import { ref } from "vue";
import Axios from "axios";
import CategoriesLayout from "../../Layouts/CategoriesLayout.vue"

import { usePage,Link, router } from "@inertiajs/vue3";

const user = usePage().props.auth.user;

const doas = usePage().props.doas;
const jumDoa = doas.length;
const dataBookmarkDoa = usePage().props.dataBookmarkDoa;

// defineProps({
//     dataBookmarkDoa:Array
// });

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
    const dataBookmarkDoa2 = ref(dataBookmarkDoa)
    const deleteBookmark = async (index,user,itemId,doaId,type)=>{
     if(user == null){
        return router.get("/login")
     }
        try {
            const response = await Axios.post('/categories/delete-bookmark', {
                id: itemId,
                type: type,
                typeId: doaId
            });
            dataBookmarkDoa2.value[index] = false
            console.log(response.data.message);
        } catch (error) {
            console.error("Error deleting bookmark:", error);
        }
    }
    const addBookmark = async (index,user,itemId,doaId,type)=>{
     if(user == null){
        return router.get("/login")
     }
        try {
            const response = await Axios.post('/categories/add-bookmark', {
                id: itemId,
                type: type,
                typeId: doaId
            });
            dataBookmarkDoa2.value[index] = true
            console.log(response.data.message);
        } catch (error) {
            console.error("Error add bookmark:", error);
        }
    }

    const goBack = ()=>{
        window.history.back();
    };
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
            <li>
                <div class="text-center text-xl">
                    <h5 class="font-lateef text-bold" style="font-size: 3rem;">{{ doas[0].categori_doa.slug }}</h5>
                    <p class="text-slate-600">{{ jumDoa }} Bacaan</p>
                </div>
            </li>
            <li v-if="fontData.fontSize !=''" v-for="(item, index) in doas" :key="item.id" class="mt-6 mx-4" :style="fontData" :id="item.id">
                <div>
                    <nav class="flex mb-5">
                        <div class="basis-2/3 flex justify-around items-center">
                            <p style="font-size: 1.3rem;" class="mr-2 basis-2/3">{{ item.title }}</p>
                            <img v-if="dataBookmarkDoa2[index]" class="w-5 h-5 pt-1" src="/img/logo/bookmark-biru.svg" alt="" @click="deleteBookmark(index,user,item.id,item.category_id,item.type)">
                            <img v-else @click="addBookmark(index,user,item.id,item.category_id,item.type)" class="w-5 h-5 pt-1" src="/img/logo/bookmark.svg" alt="">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>
                            </span>
                        </div>
                        <div class="text-end basis-1/3 text-slate-600">
                            {{index + 1}}/{{ jumDoa }}
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
                            {{ item.arab }}
                        </h6>
                        <p v-show="latinData == false" class="text-biru_font tracking-wide" v-html="item.latin"></p>
                        <p v-show="terjemahanData == false">{{ item.indo }}</p>
                    </main>
                </div>
            </li>
            <li v-else v-for="(item, index) in doas" class="mt-6 mx-4" style="font-size:1rem;" :id="item.id">
                <div>
                    <nav class="flex mb-5">
                        <div class="basis-2/3 flex justify-around">
                            <p style="font-size: 1.3rem;" class="mr-2 basis-2/3">{{ item.title }}</p>
                            <img v-if="dataBookmarkDoa2[index]" class="w-5 h-5 pt-1" src="/img/logo/bookmark-biru.svg" alt="" @click="deleteBookmark(index,user,item.id,item.category_id,item.type)">
                            <img v-else @click="addBookmark(index,user,item.id,item.category_id,item.type)" class="w-5 h-5 pt-1" src="/img/logo/bookmark.svg" alt="">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>
                            </span>
                        </div>
                        <div class="text-end basis-1/3 text-slate-600">
                            {{index + 1}}/{{ jumDoa }}
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
                            {{ item.arab }}
                        </h6>
                        <p v-show="latinData == false" class="text-biru_font tracking-wide" v-html="item.latin"></p>
                        <p v-show="terjemahanData == false">{{ item.indo }}</p>
                    </main>
                </div>
            </li>
        </ul>
    </CategoriesLayout>
</template>