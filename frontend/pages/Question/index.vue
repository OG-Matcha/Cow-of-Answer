<script setup>
import { ref, onMounted } from 'vue';
import List from '@/components/list.vue';

let userName = ref('User');
let originalText = `Hi, ${userName.value} ~ <br> 最近有什麼困擾著你? <br> 輸入你的問題 <br> 尋找封印在幕後的答案之牛！ <br> `;
let displayedText = ref('');
let currentIndex = ref(0);
let showSkipText = ref(false);

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

    setTimeout(() => {
        showSkipText.value = true;
    }, 5800);
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
    <div class="w-[100vw] h-[100vh] flex">
        <button @click="openModalL">
            <img src="/Setting.png" alt="setting" class="fixed top-3 left-3 w-[3%] h-auto">
        </button>
        <div class="w-[47%] h-auto bg-orange-50 flex justify-center items-center p-[2%]">
            <img src="/CowLOGO.png" alt="cows" class="w-[80%] h-[80%] justify-center animate-slide-in-from-left">
        </div>
        <div class="w-[53%] h-auto bg-orange-50 p-[2%]">
            <div class="w-auto h-[50%] flex items-end text-xl pl-[5%]">
                <div v-html="displayedText" class="text-textColor2 font-chen"></div>
            </div>
            <div v-if="showSkipText"
                class="w-auto h-[10%] flex text-sm pl-[5%] transition-transform duration-300 ease-in-out animate-fade-in text-textColor2 font-chen">
                (沒有問題可以按下SKIP直接進入關卡)
            </div>
            <div class="w-auto h-[20%] pl-[5%] flex">
                <div v-if="showSkipText"
                    class="w-[80%] h-auto transition-transform duration-300 ease-in-out animate-fade-in">
                    <input class=" border-b-2 border-textColor2 bg-transparent w-full h-auto font-chen" type="text"
                        placeholder="你想知道什麼?">
                </div>
                <div v-if="showSkipText"
                    class="w-[20%] h-auto pl-[1%] transition-transform duration-300 ease-in-out animate-fade-in">
                    <img src="/btnNext.png" alt="Next" class="w-[60%] h-auto">
                </div>
            </div>
            <div class="w-auto h-[20%] p-[5%]">
                <NuxtLink to="http://localhost:3000/Challenge"
                    class="text-center text-2xl flex justify-end items-center text-textColor2 hover:text-hovercolor transition-transform duration-300 ease-in-out animate-fade-in font-neucha"
                    v-if="showSkipText">
                    SKIP>>
                </NuxtLink>
            </div>
        </div>
    </div>
    <div v-if="showList" @click="closeModal"
        class="fixed inset-0 w-full h-full z-10 bg-black bg-opacity-50 flex items-center justify-center">
        <div @click.stop class="w-auto h-auto p-[2%] animate-fade-in scale-150">          
           <List />
        </div>
    </div>
</template>

<style scoped>
p {
    margin-bottom: 1em;
}

@keyframes slide-in-from-left {
    0% {
        transform: translateX(-100%);
    }

    100% {
        transform: translateX(0);
    }
}

.animate-slide-in-from-left {
    animation: slide-in-from-left 2s ease-out;
}

@keyframes fade-in {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

.animate-fade-in {
    animation-delay: 5s;
    animation: fade-in 2s ease-in-out;
}
</style>