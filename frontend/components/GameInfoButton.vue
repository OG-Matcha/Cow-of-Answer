<template>
  <div v-if="startGameInfo" class="absolute left-[30%] top-[20%] z-10 h-auto w-[45%]">
    <img src="/GameInfo(nobutton).png" alt="GameInfo" />
    <button
      @click="testVolume1"
      class="absolute bottom-[28%] left-[10%] h-auto w-[10%] rounded-[50%]"
    >
      <img src="/volume.svg" alt="Volume" />
    </button>
    <button
      @click="showStartGameInfo"
      class="absolute bottom-[10%] left-[35%] mb-1 ml-0.5 mr-0.5 mt-1 inline-block h-[12%] w-[30%] cursor-pointer rounded-[3rem] bg-[#846e82] p-1 text-center text-2xl text-white no-underline"
    >
      開始遊戲
    </button>
  </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue'

const startGameInfo = ref(true)

const showStartGameInfo = () => {
  startGameInfo.value = false
}

const emits = defineEmits(['close'])

const close = () => {
  emits('close')
}

const testVolume1 = () => {
  console.log('Volume')
}
</script>

<style scoped></style>
