<script setup>
import { ref, onMounted } from 'vue';

const openModalL = () => {
    logIn.value = true;
};
const openModalS = () => {
    signIn.value = true;
};
const closeModal = () => {
    logIn.value = false;
    signIn.value = false;
};

const logIn = ref(false);
const signIn = ref(false);

let showButtons = ref(false);
let animationsEnded = ref(0);

const handleAnimationEnd = () => {
    animationsEnded.value++;
    if (animationsEnded.value >= 1) {
        showButtons.value = true;
    }
};
onMounted(() => {
    document.body.style.overflow = 'hidden';
});
</script>

<template>

    <div class="w-[100vw] h-[100vh] flex ">

        <div class="w-[47%] h-auto bg-orange-50 flex justify-center items-center p-[2%]">
            <img src="/CowLOGO.png" alt="cows" class="w-[80%] h-[80%] justify-center animate-slide-in-from-left"
                @animationend="handleAnimationEnd">
        </div>


        <div class="w-[53%] h-auto bg-orange-50 p-[2%]">
            <div class="w-auto h-[70%] flex justify-center items-end">
                <img src="/TitleFont.png" alt="Cow Of Answer" class="w-[65%] h-[65%] animate-slide-in-from-right"
                    @animationend="handleAnimationEnd">
            </div>
            <div class="w-auto h-[30%] flex">
                <div class="w-[50%] h-auto flex justify-center items-center">
                    <button @click="openModalL" class="text-center text-4xl flex justify-center items-center transition-transform duration-300 ease-in-out hover:scale-110">
                        <img v-show="showButtons" src="/LogIn.png" alt="登入" class="w-[55%] h-auto animate-fade-in">
                    </button>
                </div>
                <div class="w-[50%] h-auto flex justify-center items-center">
                    <button @click="openModalS" class="text-center text-4xl flex justify-center items-center transition-transform duration-300 ease-in-out hover:scale-110">
                        <img v-show="showButtons" src="/SignUp.png" alt="註冊" class="w-[55%] h-auto animate-fade-in">
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div v-if="logIn" @click="closeModal"
        class="fixed inset-0 w-full h-full z-10 bg-black bg-opacity-50 flex items-center justify-center">
        <div @click.stop class="w-[50%] h-[50%] bg-overlay p-[2%] rounded-3xl animate-fade-in">
            <div class="w-auto h-[25%] flex justify-end items-start">
                <button @click="closeModal" class="transition duration-200 ease-in-out hover:text-white text-xl">X</button>
            </div>
            <div class="w-auto h-[25%] flex p-[1%] text-xl">
                <p class="w-[30%] h-auto flex items-center text-textColor font-neucha text-xl">E-mail：</p>
                <input type="email" placeholder=" " class="border-b-2 border-textColor bg-transparent w-[70%] h-auto">
            </div>
            <div class="w-auto h-[25%] flex p-[1%] text-xl">
                <p class="w-[30%] h-auto flex items-center text-textColor font-neucha text-xl">密碼：</p>
                <input type="password" placeholder=" " class="border-b-2 border-textColor bg-transparent w-[70%] h-auto">
            </div>
            <div class="w-auto h-[25%] flex justify-end pr-[3%] pt-[2%]">
                <button class="w-[20%] h-auto flex justify-end items-center">
                    <img src="/LogIn.png" alt="登入">
                </button>
            </div>
        </div>
    </div>
    <div v-if="signIn" @click="closeModal"
        class="fixed inset-0 w-full h-full z-10 bg-black bg-opacity-50 flex items-center justify-center">
        <div @click.stop class="w-[50%] h-[50%] bg-overlay p-[2%] rounded-3xl animate-fade-in">
            <div class="w-auto h-[20%] flex justify-end items-start">
                <button @click="closeModal" class="transition duration-200 ease-in-out hover:text-white text-xl">X</button>
            </div>
            <div class="w-auto h-[20%] flex p-[1%] text-xl">
                <p class="w-[35%] h-auto flex items-center text-textColor font-neucha">使用者名稱：</p>
                <input type="text" placeholder="Linda67890"
                    class="border-b-2 border-textColor bg-transparent w-[65%] h-auto">
            </div>
            <div class="w-auto h-[20%] flex p-[1%] text-xl">
                <p class="w-[35%] h-auto flex items-center text-textColor font-neucha">E-mail：</p>
                <input type="email" placeholder=" " class="border-b-2 border-textColor bg-transparent w-[65%] h-auto">
            </div>
            <div class="w-auto h-[20%] flex p-[1%] text-xl">
                <p class="w-[35%] h-auto flex items-center text-textColor font-neucha">密碼：</p>
                <input type="password" placeholder="請輸入6~13含有英數字的密碼"
                    class="border-b-2 border-textColor bg-transparent w-[65%] h-auto">
            </div>
            <div class="w-auto h-[20%] flex justify-end pr-[3%] pt-[2%]">
                <button class="w-[20%] h-auto flex justify-end items-center">
                    <img src="/SignUp.png" alt="註冊">
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
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

@keyframes slide-in-from-right {
    0% {
        transform: translateX(100%);
    }

    100% {
        transform: translateX(0);
    }
}

.animate-slide-in-from-right {
    animation: slide-in-from-right 2s ease-out;
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
    animation: fade-in .5s ease-in-out;
}
</style>