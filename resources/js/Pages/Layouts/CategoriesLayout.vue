<script setup>
    import Header from './Header.vue';
    import Main from './Main.vue';
    import Footer from './Footer.vue';
    import Control from '../Components/Control.vue';
    import { ref } from 'vue';
import { onMounted } from 'vue';

    // data dari childern
    // disini kita akan kirim dari childern ke parent, jadi kita akan emit sekali lagi
    const emit = defineEmits(['font','latin','terjemahan','qory']);
    const fontSize = (nilai) => {
        switch(nilai) {
            case -2:
                nilai = 0.5
                break;
            case -1:
                nilai = 0.8
                break;
            case 1:
                nilai = 1.5
                break;
            case 2:
                nilai = 2
                break;
            case 3:
                nilai = 3
                break;
            default:
                nilai = 1
        }
        // fontData.value = nilai;
        emit('font',nilai)
    };
    const latin = (nilai) => {
        emit('latin',nilai)
    };
    const terjemahan = (nilai) => {
        emit('terjemahan',nilai)
    };
    const qory = (nilai) => {
        emit('qory',nilai)
    };
    
onMounted(()=>{
});
</script>
<template>

<div class="dark:bg-black">
<!-- header -->
<Header></Header>
<!-- header end -->

<!-- Control -->
<Control @font="fontSize" @qory="qory" @terjemahan="terjemahan" @latin="latin">
    <slot name="control"></slot>
</Control>
<!-- Control end-->
    <slot></slot> <!-- slot default -->
<!-- main -->
<Main></Main>
<!-- mainend -->

<!-- Footer -->
<Footer></Footer>
<!-- Footer end -->
</div>

</template>