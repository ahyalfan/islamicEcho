<script setup>
import { ref,computed } from "vue";
import Category from "./../../Layouts/CategoriesLayout.vue";
import { usePage,Link } from "@inertiajs/vue3";

// show story
const stories = computed(()=>usePage().props.story); //jika data tidak berubah ubah maka bisa gunkan usepage() tetapi jika data suka berubah ubah bisa gunakan defineProps

const goBack = ()=>{    
        window.history.back();
    };
</script>
<template>
    <Category>
        <template v-slot:control>
            <div class="flex">
                <svg @click="goBack" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <!-- cara untu membuat slot banyak kita harus implementasikanya nama slotny susai bisa gunakan v-slot atau slot -->
            </div>
            
        </template>

        <div class="mx-4">
            <ul>
                <li>
                    <div class="text-center text-2xl">
                        <h1 class="font-lalezar font-semibold text-biru_font">Daftar Story</h1>
                    </div>
                </li>
                <Link :href="route('categories.story.nabi.getdetail',item.id)" v-for="(item, index) in stories" class="mt-6 mx-4" style="font-size:1rem;" :id="item.id">
                    <div>
                        <nav class="flex mb-5">
                            <div class="basis-2/3 flex justify-around items-center">
                                <p style="font-size: 1.3rem;" class="mr-1 basis-2/3">{{item.name}}</p>
                            </div>
                        </nav>
                        <main>
                            <!-- ini kita kosongkan terlebih dahulu jika ada ide bisa ditamabahkan -->
                        </main>
                    </div>
                </Link>
            </ul>
        </div>
    </Category>
</template>