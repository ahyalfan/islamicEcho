<script setup>
import { ref,computed } from "vue";
import Category from "./../../Layouts/CategoriesLayout.vue";
import { usePage,Link } from "@inertiajs/vue3";

// active buton juz surah
const button = ref(false);
const surat = ref("underline underline-offset-8");
const juz = ref("");

const suratClick = ()=> {
    surat.value = "underline underline-offset-8";
    juz.value = "";
    button.value = false;
}
const juzClick = ()=> {
    juz.value = "underline underline-offset-8";
    surat.value = "";
    button.value = true;
};

// juzOption
const juzList = computed(()=>usePage().props.juz)

// show alquran is juz / surah
const qurans = computed(()=>usePage().props.surat); //jika data tidak berubah ubah maka bisa gunkan usepage() tetapi jika data suka berubah ubah bisa gunakan defineProps

</script>
<template>
    <Category>
        <template v-slot:control>
            <!-- cara untu membuat slot banyak kita harus implementasikanya nama slotny susai bisa gunakan v-slot atau slot -->
            <div class="flex">
                <h6 :class="'cursor-pointer mr-8 '+surat" @click="suratClick">Surat</h6>
                <h6 :class="'cursor-pointer '+juz" @click="juzClick">Juz</h6>
            </div>
        </template>

        <!-- jika yg tanpa name bisa langsung tanpa template -->
        <div class="mx-5">
            <ul v-if="button == false">
                <Link :href="route('categories.alquran.getdetail',item.id)" v-for="(item, index) in qurans" :key="index" class="mb-4 flex items-center border rounded-md bg-gray-100 md:grid md:grid-cols-3 md:gap-3 dark:bg-gray-800 dark:text-white hover:bg-biru_background focus:bg-biru_background">
                    <h4 class="basis-1/6 text-center font-semibold text-biru_font bg-biru_background py-3">{{ item.nomer_surah }}</h4>
                    <div class="basis-2/3 pl-2">
                        <h6 class="font-semibold text-biru_font">{{ item.indo }}</h6>
                        <p>{{ item.arti }}</p>
                    </div>
                    <div class="basis-1/6 text-center">
                        <h6>{{ item.arab }}</h6>
                        <p>{{ item.jum_ayat }}</p>
                    </div>
                </Link>
            </ul>
            <ul v-else>
                <li v-for="(Items, indexs) in juzList" :key="indexs" class="mb-4 border rounded-md bg-gray-100 dark:bg-gray-800 dark:text-white">
                    <div class="flex justify-between mx-4">
                        <h2>Juz {{ Items[0].juz }}</h2>
                        <Link :href="route('categories.alquran.getdetailjuz',indexs+1)">Read now</Link>
                    </div>
                    <Link :href="route('categories.alquran.getdetail',item.surat.nomer_surah)" v-for="(item, index) in Items" :key="index" class="flex border mb-2 bg-white mx-4 items-center rounded-md">
                        <h4 class="basis-1/6 text-center">{{ item.surat_id }}</h4>
                        <div class="basis-2/3 pl-2">
                            <h6>{{ item.surat.indo }}</h6>
                            <p>{{ item.surat.arti }}</p>
                        </div>
                        <div class="basis-1/6 text-center">
                            <h6>{{ item.surat.arab }}</h6>
                            <p>{{ item.surat.jum_ayat }}</p>
                        </div>
                    </Link>
                </li>
            </ul>
        </div>
    </Category>
</template>