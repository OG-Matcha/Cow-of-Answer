<script setup>
import { ref } from 'vue';
const ranks = ref(['4th', '5th', '6th', '7th', '8th', '9th', '10th']);
const names = ref(['sam', 'jim', 'tom', 'jerry', 'joe', 'jane', 'jill']);
const times = ref(['00:11:11', '00:22:22', '00:33:33', '00:44:44', '00:55:55', '00:66:66', '00:77:77']);
const Yrank = ref('99th');
const Yname = ref('linda');
const Ytime = ref('100:00:00');

</script>

<template>
    <div class="w-[100vw] h-[100vh] bg-table">
        <div class="w-full h-[35%] flex border-b-2 border-black bg-table">
            <div class="w-[20%] h-auto flex flex-col justify-center p-[3%] font-chen">
                <NuxtLink to="/Table"
                    class="flex justify-center border-2 m-[2%] duration-300 ease-in-out hover:scale-110 hover:border-textColor">
                    <span class="inline-block p-1 hover:text-textColor">關卡一</span>
                </NuxtLink>
                <NuxtLink to="/"
                    class="flex justify-center border-2 m-[2%] duration-300 ease-in-out hover:scale-110 hover:border-textColor">
                    <span class="inline-block p-1 hover:text-textColor">關卡二</span>
                </NuxtLink>
                <NuxtLink to="/"
                    class="flex justify-center border-2 m-[2%] duration-300 ease-in-out hover:scale-110 hover:border-textColor">
                    <span class="inline-block p-1 hover:text-textColor">關卡三</span>
                </NuxtLink>
                <NuxtLink to="/"
                    class="flex justify-center border-2 m-[2%] duration-300 ease-in-out hover:scale-110 hover:border-textColor">
                    <span class="inline-block p-1 hover:text-textColor">成就榜</span>
                </NuxtLink>
            </div>
            <div class="w-[60%] h-auto flex justify-center font-neucha">
                <div class="w-[35%] h-full">
                    <div class="w-auto h-[25%] flex items-end justify-center">11'11'11</div>
                    <div class="w-auto h-[65%] flex items-end justify-center">
                        <img src="/tableCow.png" alt="third" class="w-auto h-full">
                    </div>
                    <div class="w-auto h-[10%] flex items-end justify-center">
                        2ND JIJUJU
                    </div>
                </div>
                <div class="w-[50%] h-full">
                    <div class="w-auto h-[15%] flex justify-center items-end">00'11'11</div>
                    <div class="w-auto h-[75%] flex items-end justify-center">
                        <img src="/tableCow.png" alt="first" class="w-auto h-full">
                    </div>
                    <div class="w-auto h-[10%] flex items-end justify-center">
                        1ST JIJUJU
                    </div>
                </div>
                <div class="w-[15%] h-auto">
                    <div class="w-auto h-[30%] flex justify-center items-end">22'11'11</div>
                    <div class="w-auto h-[60%] flex items-end justify-center">
                        <img src="/tableCow.png" alt="third" class="w-full h-auto">
                    </div>
                    <div class="w-auto h-[10%] flex items-end justify-center">
                        3RD JIJUJU
                    </div>
                </div>
            </div>
            <div class="w-[20%] h-auto"></div>
        </div>
        <div class="w-auto h-[65%] flex justify-center font-neucha">
            <div class="w-1/3 h-auto flex flex-col items-center">
                <div v-for="(rank, index) in ranks" :key="index">
                    {{ rank }}
                </div>
                {{ Yrank }}
            </div>
            <div class="w-1/3 h-auto flex flex-col items-center">
                <div v-for="(name, index) in names" :key="index">
                    {{ name }}
                </div>
                {{ Yname }}
            </div>
            <div class="w-1/3 h-auto flex flex-col items-center">
                <div v-for="(time, index) in times" :key="index">
                    {{ time }}
                </div>
                {{ Ytime }}
            </div>
        </div>
    </div>
</template>