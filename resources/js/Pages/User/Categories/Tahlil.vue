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
</script>
<template>
    <Category>
        <template v-slot:control>
            <!-- cara untu membuat slot banyak kita harus implementasikanya nama slotny susai bisa gunakan v-slot atau slot -->
            <div class="flex">
                <h6 :class="'cursor-pointer mr-8 '+surat" @click="suratClick">Tahlil</h6>
                <h6 :class="'cursor-pointer '+juz" @click="juzClick">Yasin</h6>
            </div>
        </template>

        <div class="mx-4">
            <ul v-if="button == false">
                
            </ul>
            <ul v-else>
                
            </ul>
        </div>
    </Category>
</template>