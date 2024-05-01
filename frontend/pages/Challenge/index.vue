<script setup>
import { ref, onMounted } from 'vue';
import List from '@/components/list.vue';

let userName = ref('User');
let originalText = `Hi, ${userName.value} ~ <br> 在尋找COW的過程中 <br> 尋找自己吧！ <br>`;
let displayedText = ref('');
let currentIndex = ref(0);

onMounted(() => {
    const intervalId = setInterval(() => {
        if (currentIndex.value < originalText.length) {
            if (originalText.substr(currentIndex.value, 4) === '<br>') {
                displayedText.value += '<br>';
                currentIndex.value += 4;
            } else {
                displayedText.value += originalText[currentIndex.value];
                currentIndex.value++;
            }
        } else {
            clearInterval(intervalId);
        }
    }, 110); // 110 毫秒
});

const showList = ref(false);
const openModalL = () => {
    showList.value = true;
};
const closeModal = () => {
    showList.value = false;
};
</script>

<template>
    <div class="w-[100vw] h-[100vh] flex bg-orange-50 p-[2%]">
        <button @click="openModalL">
            <img src="/Setting.png" alt="setting" class="fixed top-3 left-3 w-[3%] h-auto">
        </button>


        <div class="w-1/3 h-auto ">
            <div class="w-auto h-[60%] flex justify-center items-start">
                <NuxtLink to="/challenge1" class="animate-bounce1 flex justify-center relative w-[40%] h-auto">
                    <img src="/cow1.png" alt="Challenge1" class="absolute w-full h-auto">
                </NuxtLink>
                <img src="/grass.png" alt="Grass" class="absolute bottom-[42%] w-[15%] h-auto">
            </div>
            <div class=" w-auto h-[40%] flex items-center justify-center pt-[2%] text-lg">
                <div v-html="displayedText" class="text-textColor2 font-chen"></div>
            </div>

        </div>
        <div class="w-1/3 h-auto flex justify-center items-start">
            <NuxtLink to="/challenge1" class="animate-bounce2 flex justify-center relative w-[40%] h-auto">
                <img src="/cow2.png" alt="Challenge1" class="absolute w-full h-auto">
            </NuxtLink>
            <img src="/grass.png" alt="Grass" class="absolute bottom-[12%] w-[15%] h-auto">
        </div>
        <div class="w-1/3 h-auto flex justify-center items-start">
            <NuxtLink to="/challenge1" class="animate-bounce3 flex justify-center relative w-[40%] h-auto">
                <img src="/cow3.png" alt="Challenge1" class="absolute w-full h-auto">
            </NuxtLink>
            <img src="/grass.png" alt="Grass" class="absolute bottom-[23%] w-[15%] h-auto">
        </div>
    </div>
    <div v-if="showList" @click="closeModal"
        class="fixed inset-0 w-full h-full z-10 bg-black bg-opacity-50 flex items-center justify-center">
        <div @click.stop class="w-auto h-auto p-[2%] animate-fade-in scale-150">          
           <List />
        </div>
    </div>
</template>
<style>
@keyframes bounce1 {

    0%,
    100% {
        transform: translateY(30vh);
    }

    50% {
        transform: translateY(0vh);
    }
}

.animate-bounce1 {
    animation: bounce1 5s infinite;
}

@keyframes bounce2 {

    0%,
    100% {
        transform: translateY(60vh);
    }

    50% {
        transform: translateY(10vh);
    }
}

.animate-bounce2 {
    animation: bounce2 8s infinite;
}

@keyframes bounce3 {

    0%,
    100% {
        transform: translateY(50vh);
    }

    50% {
        transform: translateY(15vh);
    }
}

.animate-bounce3 {
    animation: bounce3 10s infinite;
}

/* .bg-scroll-list {
    background-image: url('/list.png');
    background-size: cover;
    background-position: center;
    transform: scale(2.5);
} */

@keyframes fade-in {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

.animate-fade-in {
    animation: fade-in .5s ease-in-out;
}

.scale-150 {
    transform: scale(5);
}

</style>