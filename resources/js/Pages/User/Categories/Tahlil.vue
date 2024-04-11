<script setup>
import { ref,computed } from "vue";
import Category from "./../../Layouts/CategoriesLayout.vue";
import { usePage,Link, router } from "@inertiajs/vue3";
import Axios from "axios";

// active buton juz surah
const button = ref(false);
const tahlilU = ref("underline underline-offset-8");
const yasinU = ref("");

const tahlilClick = ()=> {
    tahlilU.value = "underline underline-offset-8";
    yasinU.value = "";
    button.value = false;
}
const yasinClick = ()=> {
    yasinU.value = "underline underline-offset-8";
    tahlilU.value = "";
    button.value = true;
};

// juzOption
const yasin = computed(()=>usePage().props.yasin)

// show alquran is juz / surah
const tahlils = computed(()=>usePage().props.tahlils); //jika data tidak berubah ubah maka bisa gunkan usepage() tetapi jika data suka berubah ubah bisa gunakan defineProps


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

const user = usePage().props.auth.user;
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

// back
const goBack = ()=>{
    window.history.back();
};
</script>
<template>
    <Category @font="fontSizez" @qory="qory" @terjemahan="terjemahan" @latin="latin">
        <template v-slot:control>
            <div class="flex">
                <svg @click="goBack" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <!-- cara untu membuat slot banyak kita harus implementasikanya nama slotny susai bisa gunakan v-slot atau slot -->
                <div class="flex mx-auto">
                    <h6 :class="'cursor-pointer mr-8 '+tahlilU" @click="tahlilClick">Tahlil</h6>
                    <h6 :class="'cursor-pointer '+yasinU" @click="yasinClick">Yasin</h6>
                </div>
            </div>
            
        </template>

        <div class="mx-4">
            <!-- tahlil -->
            <ul v-if="button == false">
                <li>
                    <div class="text-center text-2xl">
                        <h1 class="font-lalezar font-semibold text-biru_font">Bacaan Tahlil</h1>
                    </div>
                </li>
                <li v-if="fontData.fontSize !=''" v-for="(item, index) in tahlils" :key="item.id" class="mt-6 mx-4" :style="fontData" :id="item.no">
                    <div>
                        <nav class="flex mb-5">
                            <div class="basis-2/3 flex justify-start">
                                <p style="font-size: 1.3rem;" class="mr-1 text-biru_font">{{ item.judul }}</p>
                            </div>
                            <div class="basis-1/3 flex justify-end">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                            </div>
                        </nav>
                        <main>
                            <h6 class="flex justify-end mx-4" :style="fontArab ">
                                {{ item.arab }}
                            </h6>
                            <p>{{ item.indo }}</p>
                        </main>
                    </div>
                </li>
                <li v-else v-for="(item, index) in tahlils" class="mt-6 mx-4" style="font-size:1rem;" :id="item.no">
                    <div>
                        <nav class="flex mb-5">
                            <div class="basis-2/3 flex justify-start items-center">
                                <p style="font-size: 1.3rem;" class="mr-1 text-biru_font">{{item.judul}}</p>
                            </div>
                            <div class="basis-1/3 flex justify-end">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                            </div>
                        </nav>
                        <main>
                            <h6 class="flex justify-end" style="font-size: 2.5rem;">
                                {{ item.arab }}
                            </h6>
                            <p>{{ item.indo }}</p>
                        </main>
                    </div>
                </li>
            </ul>

            <!-- yasin -->
            <ul v-else>
                <li>
                    <div class="text-center text-xl">
                        <h5 class="font-lateef text-bold mb-2" style="font-size: 3rem;">{{ yasin[0].surat.arab }}</h5>
                        <h1 class="font-lalezar">{{ yasin[0].surat.indo }}</h1>
                        <p>{{ yasin[0].surat.golongan +' - '+ yasin[0].surat.jum_ayat}}</p>
                    </div>
                </li>
                <li v-if="fontData.fontSize !=''" v-for="(ayat, index) in yasin" :key="ayat.id" class="mt-6 mx-4" :style="fontData" :id="ayat.id">
                    <div>
                        <nav class="flex mb-5">
                            <div class="basis-1/3 flex justify-around items-center">
                                <p style="font-size: 1.3rem;" class="">{{ ayat.surat.nomer_surah+':'+ayat.nomer_ayat }}</p>
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
                            <p v-show="terjemahanData == false">{{ ayat.indo }}</p>
                        </main>
                    </div>
                </li>
                <li v-else v-for="(ayat, index) in yasin" class="mt-6 mx-4" style="font-size:1rem;" :id="ayat.id">
                    <div>
                        <nav class="flex mb-5">
                            <div class="basis-1/3 flex justify-around items-center">
                                <p style="font-size: 1.3rem;" class="mr-2">{{ ayat.surat.nomer_surah+':'+ayat.nomer_ayat }}</p>
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
                            <p v-show="terjemahanData == false">{{ ayat.indo }}</p>
                        </main>
                    </div>
                </li>
            </ul>
        </div>
    </Category>
</template>