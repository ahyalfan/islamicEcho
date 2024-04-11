<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed,ref,onMounted,Transition } from 'vue';

// paralax setup
const posisitionBefore = ref(50);
const navShow = ref("");
const toolsPosisition = ref("top-28");

// scroll
const onScroll = ()=>{
  let posisitionAfter = window.scrollY;
  posisitionAfter = Math.floor(posisitionAfter)
  if(posisitionAfter > 50){
    if(posisitionBefore.value < posisitionAfter){
    navShow.value = "";
    }else{
      navShow.value = "translatey(-4rem)";
    }
    toolsPosisition.value = "top-9"
    posisitionBefore.value = posisitionAfter;
  }else{
    navShow.value = "",
    toolsPosisition.value = "top-28"
  }
}
// end

// tools setup
const tools = ref(false)
const show = ()=> {
    tools.value = true
};
const hidden = ()=> {
    tools.value = false
};
const dataqori = [
    {
        "value":"https://cdn.islamic.network/quran/audio/128/ar.alafasy/",
        "label":"alafasy"
    },
    {
        "value":"https://cdn.islamic.network/quran/audio/128/ar.ahmedajamy/",
        "label":"ahmedajamy"
    },
    {
        "value":"https://cdn.islamic.network/quran/audio/128/ar.husarymujawwad/",
        "label":"husarymujawwad"
    },
    {
        "value":"https://cdn.islamic.network/quran/audio/128/ar.minshawi/",
        "label":"minshawi"
    },
    {
        "value":"https://cdn.islamic.network/quran/audio/128/ar.muhammadayyoub/",
        "label":"muhammadayyoub"
    },
    {
        "value":"https://cdn.islamic.network/quran/audio/128/ar.muhammadjibreel/",
        "label":"muhammadjibreel"
    },
]

// value pengaturan
const font = ref("");
const latin= ref(true);
const terjemahan= ref(true);
const qory = ref("");
// end tools

// coba emit
const emit = defineEmits(['font','latin','terjemahan','qory']);
const changeFont = (nilai)=>{
    emit('font',nilai)
};
const changeLatin = (nilai)=>{
    emit('latin',nilai)

};
const changeTerjemahan = (nilai)=>{
    emit('terjemahan',nilai)
};
const changeQory = (nilai)=>{
    emit('qory',nilai)
};

onMounted(() => {
    window.addEventListener('scroll',() => {
    requestAnimationFrame(onScroll);
  })
});
</script>

<template>

<div class="w-full h-[4.5rem] transition duration-1000"></div>

<section class="flex pt-3 px-3 mb-6 bg-white dark:bg-gray-800 dark:text-white border-b-2 border-biru_bacground2 pb-3 transition-all duration-200 sticky top-0 z-10" :style="'transform: '+navShow">
    <div class="basis-11/12">
        <slot></slot>
    </div>
    <div class="basis-1/12 dark:text-white mr-2">
            <svg @click="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
    </div>

</section>
<div v-show="tools" @click.self="hidden" class="fixed bottom-0 top-0 left-0 right-0 z-20 transition duration-500"></div>
<Transition name="fade" v-show="tools" :class="toolsPosisition + ' border z-30 rounded-md shadow-md fixed right-12 w-1/2 py-5 px-2 md:w-1/3 md:h-1/3 bg-slate-100'">
    <ul class="transition duration-200">
        <li class="text-xl font-semibold mb-3">
            <h4>Pengaturan</h4>
        </li>
        <li class="text-md">
            <label>Ukuran font</label>
            <el-input-number min="-2" placeholder="0" max="3" v-model="font" @input="changeFont(font)" size="small"/>
            <!-- <input v-model="font" @input="changeFont(font)" type="number" value="1"> -->
        </li>
        <li>
            <label>Transliterasi (Latin)</label>
            <input v-model="latin" type="checkbox" id="toogle" class="hidden">
            <label @click="changeLatin(latin)" for="toogle">
                <div class="w-10 h-5 bg-biru_bacground2 rounded-full flex items-center justify-end">
                    <span class="w-3 h-3 rounded-full bg-white mr-1 transition duration-200"></span>
                </div>
            </label>
        </li>
        <li>
            <label>Terjemahan Bahasa</label>
            <input v-model="terjemahan" type="checkbox" id="toogle2" class="hidden">
            <label @click="changeTerjemahan(terjemahan)" for="toogle2"> 
                <div class="w-10 h-5 bg-biru_bacground2 rounded-full flex items-center justify-end">
                    <span class="w-3 h-3 rounded-full bg-white mr-1 transition duration-200"></span>
                </div>
            </label>
        </li>
        <li class="px-2">
            <h4 class="">Pilih qori</h4>
            <el-select
                v-model="qory"
                class="text-black"
                placeholder="Select"
                size="small"
                style="width: "
                @change="changeQory(qory)"
            >
                <el-option
                v-for="item in dataqori"
                :key="item.value"
                :label="item.label"
                :value="item.value"
                class="text-black"
                />
            </el-select>
        </li>
    </ul>
</Transition>

</template>

<style scoped>
    #toogle:checked + label span{
        transform:translateX(-1.2rem) ;
    }
    #toogle2:checked + label span{
        transform:translateX(-1.2rem) ;
    }

    .fade-enter-active,
    .fade-leave-active {
    transition: all 0.2s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
    opacity: 0;
    transform:translateY(2.5rem);
    }
</style>