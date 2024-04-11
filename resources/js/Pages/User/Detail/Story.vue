<script setup>
import { ref,computed, onMounted } from "vue";
import Category from "./../../Layouts/CategoriesLayout.vue";
import { usePage,Link, router } from "@inertiajs/vue3";

// kita akan coba tangkep emitnya
const fontData = ref({
        fontSize: ""
    })
    const fontArab = ref({
        fontSize: ""
    })
    const latinData = ref(Boolean)
    const terjemahanData = ref(Boolean)
    const qoryData = ref("")
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

// show story
const story = computed(()=>usePage().props.story); //jika data tidak berubah ubah maka bisa gunkan usepage() tetapi jika data suka berubah ubah bisa gunakan defineProps

const prevStory = story.value.id - 1
const nextStory = story.value.id + 1

const goBack = ()=>{
    window.history.back()
};
</script>
<template>
    <Category @font="fontSizez" @qory="qory" @terjemahan="terjemahan" @latin="latin">
        <template v-slot:control>
            <div class="flex">
                <svg @click="goBack" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                
                <div class="mx-auto flex justify-center">
                    <Link :href="route('categories.story.nabi.getdetail', prevStory)" v-if="prevStory != 0" class="mx-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                        </svg>
                    </Link>

                    <Link :href="route('categories.story.nabi.getdetail', nextStory)" v-if="nextStory != 29">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </Link>
                </div>
                <!-- cara untu membuat slot banyak kita harus implementasikanya nama slotny susai bisa gunakan v-slot atau slot -->
            </div>
            
        </template>

        <div class="mx-4">
            <!-- tampilkan story -->
            <div>
                <ul>
                    <li>
                        <div class="text-center text-xl">
                            <h5 class="font-lateef text-bold" style="font-size: 3rem;">{{ story.name }}</h5>
                        </div>
                    </li>
                    <li v-if="fontData.fontSize !=''" class="mt-6 mx-4" :style="fontData" :id="story.id">
                        <div>
                            <nav class="flex mb-5">
                                <!-- <div class="basis-1/3 flex justify-around items-center">
                                    <p style="font-size: 1.3rem;" class="mr-2 basis-2/3">{{ story.name }}</p>
                                </div>
                                <div class="basis-2/3 flex justify-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </div> -->
                            </nav>
                            <main>
                                <h6 class="flex justify-end mx-4" :style="fontArab ">
                                    <!-- <div class="relative">
                                        <div :style="{imgData}">
                                            <img src="/img/logo/ayat_icon.svg" alt="">
                                        </div>
                                        <p class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">{{ convertToArabic(ayat.nomer_ayat) }}</p>
                                    </div>  -->
                                    {{ story.tanggal }}
                                </h6>
                                <!-- <p class="text-biru_font tracking-wide" v-html="item.latin"></p>
                                <p>{{ item.indo }}</p> -->
                                <p>{{ story.description }}</p>
                            </main>
                        </div>
                    </li>
                    <li v-else class="mt-6 mx-4" style="font-size:1rem;" :id="story.id">
                        <div>
                            <nav class="flex mb-5">
                                <!-- <div class="basis-2/3 flex justify-around">
                                    <p style="font-size: 1.3rem;" class="mr-2 basis-2/3">{{ story.name }}</p>
                                </div>
                                <div class="basis-1/3 flex justify-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </div> -->
                            </nav>
                            <main>
                                <h6 class="flex justify-end" style="font-size: 2.5rem;">
                                    <!-- <div class="relative">
                                        <div style="width: 3rem; height: 3rem;">
                                            <img src="/img/logo/ayat_icon.svg" alt="">
                                        </div>
                                        <p class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">{{ convertToArabic(ayat.nomer_ayat) }}</p>
                                    </div>  -->
                                    {{ story.tanggal}}
                                </h6>
                                <!-- <p class="text-biru_font tracking-wide" v-html="item.latin"></p> -->
                                <p>{{ story.description }}</p>
                            </main>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </Category>
</template>