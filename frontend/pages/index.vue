<template>
  <div class="flex h-screen flex-col items-center justify-center bg-bg-color">
    <div class="bg-overlay flex flex-col items-center rounded-3xl">
      <div class="mb-8 flex w-full items-center justify-between">
        <button></button>
        <button class="text-overlay-text mr-3 mt-3 text-2xl">X</button>
      </div>
      <div class="ml-2 mr-2 flex flex-row items-center">
        <h1 class="font-neucha bg-overlay text-overlay-text my-4 ml-2 mr-4 text-2xl">E-MAIL :</h1>
        <input
          type="email"
          class="bg-overlay text-overlay-text border-overlay-text mr-4 border-b-2 text-2xl outline-none"
          v-model="email"
        />
      </div>
      <div class="mb-12 mr-2 flex flex-row items-center">
        <h1 class="font-neucha bg-overlay text-overlay-text align-left mr-6 text-2xl">密碼 :</h1>
        <input
          type="password"
          class="bg-overlay text-overlay-text border-overlay-text border-b-2 text-[1.6rem] outline-none"
          v-model="password"
        />
      </div>
      <div class="mb-8 ml-2 mr-3 flex w-full items-center justify-between">
        <button></button>
        <button class="text-overlay-text bg-button mr-4 rounded-3xl px-6 py-1 text-[1rem]">
          登入
        </button>
      </div>
    </div>
    <p class="font-neucha mt-4 text-3xl">Test Neucha Font</p>
    <p class="font-chen mt-4 text-3xl">測試辰宇落雁體</p>
    <p class="font-shu mt-4 text-3xl">測試方正書體</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const email = ref('')
const password = ref('')
</script>
