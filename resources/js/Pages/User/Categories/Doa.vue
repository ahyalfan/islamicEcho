<script setup>
import { ref,computed } from "vue";
import Category from "./../../Layouts/CategoriesLayout.vue";
import { usePage,Link } from "@inertiajs/vue3";

// show alquran is juz / surah
const listdoa = computed(()=>usePage().props.listDoa); //jika data tidak berubah ubah maka bisa gunkan usepage() tetapi jika data suka berubah ubah bisa gunakan defineProps
const goBack = ()=>{
        window.history.back();
};

</script>
<template>
    <Category>
        <template v-slot:control>
            <!-- cara untu membuat slot banyak kita harus implementasikanya nama slotny susai bisa gunakan v-slot atau slot -->
            <div class="flex">
                <svg @click="goBack" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
            </div>
        </template>

        <!-- jika yg tanpa name bisa langsung tanpa template -->
        <div class="mx-4">
            <ul class="grid grid-cols-2 gap-1 md:grid-cols-3 md:gap-3 ">
                <Link :href="route('categories.doa.getdetail',item.id)" v-for="(item, index) in listdoa" :key="index" class="mb-4 grid items-center rounded-md dark:bg-gray-800 dark:text-white ">
                    <img :src="'/img/doas/doa_categories'+item.id+'.jpg'" class="object-cover">
                    <h4 class="text-center">{{ item.category_name }}</h4>
                </Link>
            </ul>
        </div>
    </Category>
</template>