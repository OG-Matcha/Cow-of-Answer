<template>
  <div
    class="reel align-center absolute left-[38%] top-[20%] z-[5] flex h-[30vw] w-[25vw] flex-col justify-center bg-contain bg-no-repeat"
  >
    <div class="font space-y-19 r-50% flex flex-col items-center justify-center font-chen">
      <button @click="continueGame" class="font">繼續</button>
      <button @click="showGameInfo" class="font mt-[1.25vh]">遊戲說明</button>
      <NuxtLink to="/" class="font mt-[1.25vh]">退出</NuxtLink>
    </div>
  </div>
  <GameInfoClose :show="showInfo" @hide="hideGameInfo" />
</template>

<script setup>
import { ref, defineEmits } from 'vue'

const showInfo = ref(false)

const emits = defineEmits(['continue'])
const continueGame = () => {
  emits('continue')
  showInfo.value = false
}

const showGameInfo = () => {
  showInfo.value = true
}

const hideGameInfo = () => {
  showInfo.value = false
}
</script>

<style scoped>
.reel {
  background-image: url('/reel.png');
}
.font {
  font-size: clamp(0.125rem, 4vw, 5rem);
  text-shadow:
    1px 1px 4px rgba(219, 114, 73, 0.829),
    1px 1px 4px rgba(5, 5, 5, 0.829);
}
</style>
