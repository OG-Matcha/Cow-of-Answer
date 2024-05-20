<template>
  <div class="h-[100vh] w-[100vw] bg-table">
    <div class="flex h-[40%] w-full border-b-2 border-black bg-table">
      <button @click="openModalL">
        <img src="/Setting.png" alt="setting" class="fixed left-3 top-3 h-auto w-[3%]" />
      </button>
      <div
        v-if="showList"
        @click="closeModal"
        class="fixed inset-0 z-10 flex h-auto w-full items-center justify-center bg-black bg-opacity-50"
      >
        <div @click.stop class="animate-fade-in h-auto w-auto">
          <List />
        </div>
      </div>
      <div class="h-auto w-[20%]"></div>
      <div class="flex h-auto w-[60%] justify-center font-neucha">
        <div class="h-full w-[35%]">
          <div class="flex h-[25%] w-auto items-end justify-center text-xl">{{ counts[1] }}</div>
          <div class="flex h-[65%] w-auto items-end justify-center">
            <img src="/tableCow.png" alt="third" class="h-full w-auto" />
          </div>
          <div class="flex h-[10%] w-auto items-end justify-center text-xl">2ND {{ names[1] }}</div>
        </div>
        <div class="h-full w-[50%]">
          <div class="flex h-[15%] w-auto items-end justify-center text-2xl">{{ counts[0] }}</div>
          <div class="flex h-[75%] w-auto items-end justify-center">
            <img src="/tableCow.png" alt="first" class="h-full w-auto" />
          </div>
          <div class="flex h-[10%] w-auto items-end justify-center text-2xl">
            1ST {{ names[0] }}
          </div>
        </div>
        <div class="h-auto w-[15%]">
          <div class="flex h-[40%] w-auto items-end justify-center text-lg">{{ counts[2] }}</div>
          <div class="flex h-[50%] w-auto items-end justify-center">
            <img src="/tableCow.png" alt="third" class="h-auto w-full" />
          </div>
          <div class="flex h-[10%] w-auto items-end justify-center text-lg">3RD {{ names[2] }}</div>
        </div>
      </div>

      <div class="flex h-auto w-[20%] flex-col justify-center p-[3%] font-chen">
        <NuxtLink
          to="http://localhost:3000/Table"
          class="m-[2%] flex justify-center border-2 duration-300 ease-in-out hover:scale-110 hover:border-textColor"
        >
          <span class="inline-block p-1 text-2xl hover:text-textColor">關卡一</span>
        </NuxtLink>
        <NuxtLink
          to="/"
          class="m-[2%] flex justify-center border-2 duration-300 ease-in-out hover:scale-110 hover:border-textColor"
        >
          <span class="inline-block p-1 text-2xl hover:text-textColor">關卡二</span>
        </NuxtLink>
        <NuxtLink
          to="/"
          class="m-[2%] flex justify-center border-2 duration-300 ease-in-out hover:scale-110 hover:border-textColor"
        >
          <span class="inline-block p-1 text-2xl hover:text-textColor">關卡三</span>
        </NuxtLink>
        <NuxtLink
          to="http://localhost:3000/Table/achievement"
          class="m-[2%] flex justify-center border-2 duration-300 ease-in-out hover:scale-110 hover:border-textColor"
        >
          <span class="inline-block p-1 text-2xl hover:text-textColor">成就榜</span>
        </NuxtLink>
      </div>
    </div>
    <div class="flex h-[60%] w-auto justify-center font-neucha text-xl">
      <div class="flex h-auto w-1/3 flex-col items-center">
        <div v-for="(rank, index) in ranks" :key="index" class="m-[2%] text-xl">
          {{ rank }}
        </div>
        {{ Yrank }}
      </div>
      <div class="flex h-auto w-1/3 flex-col items-center text-lg">
        <div v-for="(name, index) in names.slice(-7)" :key="index" class="m-[2%] text-xl">
          {{ name }}
        </div>
        {{ Yname }}
      </div>
      <div class="flex h-auto w-1/3 flex-col items-center text-lg">
        <div v-for="(count, index) in counts.slice(-7)" :key="index" class="m-[2%] text-xl">
          {{ count }}
        </div>
        {{ Ycount }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
const ranks = ref(['4th', '5th', '6th', '7th', '8th', '9th', '10th'])
const names = ref(['kitty', 'uuu', 'ooo', 'sam', 'jim', 'tom', 'jerry', 'joe', 'jane', 'jill'])
const counts = ref(['100', '90', '80', '1', '2', '3', '4', '5', '6', '7'])
const Yrank = ref('99th')
const Yname = ref('linda')
const Ycount = ref('0')
const showList = ref(false)
const openModalL = () => {
  showList.value = true
}
const closeModal = () => {
  showList.value = false
}
</script>
