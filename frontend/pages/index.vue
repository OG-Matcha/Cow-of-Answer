<template>
  <div class="flex h-screen flex-col items-center justify-center bg-bg-color">
    <div class="flex flex-col items-center rounded-3xl bg-overlay">
      <div class="mb-8 flex w-full items-center justify-between">
        <button></button>
        <button class="mr-3 mt-3 text-2xl text-overlay-text">X</button>
      </div>
      <div class="ml-2 mr-2 flex flex-row items-center">
        <h1 class="my-4 ml-2 mr-4 bg-overlay font-neucha text-2xl text-overlay-text">E-MAIL :</h1>
        <input
          type="email"
          class="mr-4 border-b-2 border-overlay-text bg-overlay text-2xl text-overlay-text outline-none"
          v-model="email"
        />
      </div>
      <div class="mb-12 mr-2 flex flex-row items-center">
        <h1 class="align-left mr-6 bg-overlay font-neucha text-2xl text-overlay-text">密碼 :</h1>
        <input
          type="password"
          class="border-b-2 border-overlay-text bg-overlay text-[1.6rem] text-overlay-text outline-none"
          v-model="password"
        />
      </div>
      <div class="mb-8 ml-2 mr-3 flex w-full items-center justify-between">
        <button></button>
        <button class="bg-butto n mr-4 rounded-3xl px-6 py-1 text-[1rem] text-overlay-text">
          登入
        </button>
      </div>
    </div>
    <p class="mt-4 font-neucha text-3xl">Test Neucha Font</p>
    <p class="mt-4 font-chen text-3xl">測試辰宇落雁體</p>
    <p class="mt-4 font-shu text-3xl">測試方正書體</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const email = ref('')
const password = ref('')
</script>
