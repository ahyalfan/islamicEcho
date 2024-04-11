<script setup>
import { ref,Transition } from "vue";
import Axios from "axios";
import UserLayout from "../Layouts/UserLayout.vue"
import { usePage,Link, router, Head } from "@inertiajs/vue3";
import { ElSwitch,ElNotification } from "element-plus";

const show = ref(true)
const citySearch = ref("Bojonegoro")

const dates = usePage().props.dates
const dates2 = ref([]);
dates.forEach((item,index) => {
    dates2.value[index] = item
    dates2.value[index] = {...item,kota:citySearch.value}
});

// test async buat jadwal
function getData(city) {
        const request = new Request(`https://api.aladhan.com/v1/calendarByCity/2024/4?city=${city}&country=indonesia`, {
            method: "GET"
        });

        const response = fetch(request);

        return response.then((response) => response.json());
    }
async function getDataAsync(city) {
        try {
            const date = await getData(city);
            return date.data;
        } catch (e) {
            return "Product Not Found";
        } finally {

        }
    }
const newLokasi = async (newCity)=>{
    console.log(newCity);
    open1();
    getDataAsync(newCity)
        .then((data) => {
            data.forEach((item,index) => {
                dates2.value[index] = item
                dates2.value[index] = {...item,kota:citySearch.value}
            });
        });

};

// notifikasi
const open1 = () => {
  ElNotification({
    title: 'Success',
    message: 'Data berhasil di dapatkan',
    type: 'success',
  })
};
</script>
<template>

<Head>
    <title>Date or Time</title>
    <meta name="description" content="alquran,doa, yasin, tahlil, dan lain lain">
</Head>
<UserLayout>
<div class="pt-24">
    <section>
        <h1 class="text-center">Waktu Sholat</h1>
        <div class="flex justify-around items-center mt-3">
            <input v-model="citySearch" type="search" placeholder="Nama Kota" class="h-5 py-3 rounded-sm" @keypress.enter="newLokasi(citySearch)">
            <el-switch v-model="show" active-text="Sees time"/>
        </div>
    </section>
    <Transition>
        <el-table v-if="show" :data="dates2" style="width: 100%">
            <el-table-column type="expand">
                <template #default="props">
                    <div m="4">
                    <!-- <p m="t-0 b-2">Subuh: {{ props.row.timings.Fajr }}</p>
                    <p m="t-0 b-2">Terbit: {{ props.row.timings.Sunrise }}</p>
                    <p m="t-0 b-2">Dhuhur: {{ props.row.timings.Dhuhr }}</p>
                    <p m="t-0 b-2">Ashar: {{ props.row.timings.Asr }}</p>
                    <p m="t-0 b-2">Maghrib: {{ props.row.timings.Maghrib }}</p>
                    <p m="t-0 b-2">Isya: {{ props.row.timings.Isha }}</p>-->
                    <table class="table-auto border mx-auto">
                        <thead>
                            <tr>
                            <th class="border p-2">Subuh</th>
                            <th class="border p-2">Terbit</th>
                            <th class="border p-2">Dhuhur</th>
                            <th class="border p-2">Ashar</th>
                            <th class="border p-2">Maghrib</th>
                            <th class="border p-2">Isya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td class="border p-2">{{ props.row.timings.Fajr }}</td>
                            <td class="border p-2">{{ props.row.timings.Sunrise }}</td>
                            <td class="border p-2">{{ props.row.timings.Dhuhr }}</td>
                            <td class="border p-2">{{ props.row.timings.Asr }}</td>
                            <td class="border p-2">{{ props.row.timings.Maghrib }}</td>
                            <td class="border p-2">{{ props.row.timings.Isha }}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </template>
            </el-table-column>
            <el-table-column label="Date" prop="date.readable" />
            <el-table-column label="City" prop="kota" />
        </el-table>
    </Transition>
</div>
</UserLayout>
</template>

<style scoped>
/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>