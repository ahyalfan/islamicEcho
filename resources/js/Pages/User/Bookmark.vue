
<script setup>
import { usePage } from '@inertiajs/vue3';
import { onMounted,ref } from "vue";
import Main from "./../Layouts/Main.vue"
import Footer from "../Layouts/Footer.vue"
import { Head, Link, router } from "@inertiajs/vue3";
import Axios from "axios";

const ayatBookmarks = usePage().props.ayatBookmarks
const doaBookmarks = usePage().props.doaBookmarks
const hadistBookmarks = usePage().props.hadistBookmarks
const surats = usePage().props.surat
const doas = usePage().props.doas
const user = usePage().props.auth.user;

// active
// active buton
const button = ref(true);
const button2 = ref(false);
const button3 = ref(false);
const suratU = ref("underline underline-offset-8");
const doaU = ref("");
const hadistU = ref("");

const suratClick = ()=> {
    suratU.value = "underline underline-offset-8";
    doaU.value = "";
    hadistU.value = "";
    button.value = true;
    button2.value = false;
    button3.value = false;
}
const doaClick = ()=> {
    suratU.value = "";
    doaU.value = "underline underline-offset-8";
    hadistU.value = "";
    button.value = false;
    button2.value = true;
    button3.value = false;
};
const hadistClick = ()=> {
    suratU.value = "";
    doaU.value = "";
    hadistU.value = "underline underline-offset-8";
    button.value = false;
    button2.value = false;
    button3.value = true;
};

// fitur bookmark
// ayat
// masih error belum sempurna
const dataBookmarkAyat2 = ref(ayatBookmarks)
const dataBookmarkDoa2 = ref(doaBookmarks)
const dataBookmarkHadist2 = ref(hadistBookmarks)
const deleteBookmark = async (index,user,itemId,type)=>{
     if(user == null){
        return router.get("/login")
     }
        try {
            const response = await Axios.post('/categories/delete-bookmark', {
                id: itemId,
                type: type,
            });
            if(type == 'ayat'){
                dataBookmarkAyat2.value[index] = false
            }
            if(type == 'doa'){
                dataBookmarkDoa2.value[index] = false
            }
            if(type == 'hadist'){
                dataBookmarkHadist2.value[index] = false
            }
            console.log(response.data.message);
        } catch (error) {
            console.error("Error deleting bookmark:", error);
        }
    };
</script>
<template>

<Head>
    <title>Bookmarks</title>
    <meta name="description" content="alquran,doa, yasin, tahlil, dan lain lain">
</Head>

<!-- section 1 history/bookmark -->
<section class="p-4 bg-slate-100 dark:bg-gray-800">
    <h1 class="text-2xl font-bold font-lalezar text-biru_font">My Bookmarks</h1>
</section>
<!-- end section 1 -->

<div class="">
<section class="bg-biru_background text-biru_bacground2 flex pt-3 px-4 mb-6 dark:text-white border-biru_bacground2 pb-3 transition-all duration-200 sticky top-0 z-10">
    <div class="flex mx-auto">
        <h6 :class="'cursor-pointer mr-8 '+suratU" @click="suratClick">Surat</h6>
        <h6 :class="'cursor-pointer '+doaU" @click="doaClick">Doa</h6>
        <h6 :class="'cursor-pointer ml-8 '+hadistU" @click="hadistClick">Hadist</h6>
    </div>
</section>

<section class="mx-2 mb-20 mt-10 dark:bg-black dark:text-white">
    <!-- ayat -->
    <ul v-if="button" class="mx-4" aria-label="box-bookmark">
        <div v-if="dataBookmarkAyat2 == ''" class="text-center">
        Your not have Bookmark for Surah
        </div>
        <div v-for="(item, index) in dataBookmarkAyat2" :key="index">
        <li class="flex justify-evenly min-h-24 mb-4 border-2" v-if="dataBookmarkAyat2[index] != false">
            <Link :href="'/categories/al-quran/'+surats[index].id+'#'+item.ayat.id" class="basis-1/3 flex justify-center items-center flex-col rounded-md bg-slate-200">
                <h1 class="text-2xl">{{ surats[index].arab }}</h1>
                <p class="text-xs">ayat {{ item.ayat.nomer_ayat }}</p>
            </Link>
            <Link :href="'/categories/al-quran/'+surats[index].id+'#'+item.ayat.id" class="bg-white basis-1/2 mx-4 flex items-start justify-around flex-col">
                <h1>surah {{ surats[index].indo }}</h1>
                <div class="">
                    <h4>{{ surats[index].arti }}</h4>
                    <div>
                        <p>{{surats[index].nomer_surah}} | {{surats[index].golongan}}</p>
                    </div>
                </div>
            </Link>
            <div class="bg-white basis-1/6 mt-1">
                <img class="w-5 h-5 pt-1" src="/img/logo/bookmark-biru.svg" alt="" @click="deleteBookmark(index,user,item.ayat_id,item.content_type)">
            </div>
        </li>
        </div>
    </ul>
    <!-- doa -->
    <ul v-if="button2" class="mx-4" aria-label="box-bookmark">
        <div v-if="dataBookmarkDoa2 == ''" class="text-center">
        Your not have Bookmark for Doa
        </div>
        <div v-for="(item, index) in dataBookmarkDoa2" :key="index">
        <li class="flex justify-evenly min-h-24 mb-4 border-2" v-if="dataBookmarkDoa2[index] != false">
            <div class="basis-1/3 flex justify-center items-center flex-col rounded-md bg-slate-200">
                <h1 class="text-xs">{{ item.doa.title }}</h1>
                <!-- <p class="text-xs">ayat {{ item.ayat.nomer_ayat }}</p> -->
            </div>
            <div class="bg-white basis-1/2 mx-4 flex items-start justify-around flex-col">
                <h1>{{ doas[index].slug }}</h1>
                <div class="">
                    <h4 v-if="item.doa.notes !== null">{{ item.doa.notes }}</h4>
                    <h4 v-else>Dibaca 1x</h4>
                    <div>
                        <p>{{doas[index].id}} | {{item.doa.src}}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white basis-1/6 mt-1">
                <img class="w-5 h-5 pt-1" src="/img/logo/bookmark-biru.svg" alt="" @click="deleteBookmark(index,user,item.doa_id,item.content_type)">
            </div>
        </li>
        </div>
    </ul>
    <!-- hadist ini belum-->
    <ul v-if="button3" class="mx-4" aria-label="box-bookmark">
        <div v-if="dataBookmarkHadist2 == ''" class="text-center">
        Your not have Bookmark for Hadist
        </div>
        <li v-for="(item, index) in hadistBookmarks" :key="index">
            {{ item.id }}
        </li>
    </ul>
</section>
</div>


<!-- main -->
<Main></Main>

<!-- footer -->
<Footer></Footer>

</template>