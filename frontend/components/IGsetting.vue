<template>
  <div v-if="!showInfo" class="reel flex justify-center">
    <div class="font space-y-19 r-50% flex flex-col items-center justify-center">
      <button @click="continueGame" class="gap font">繼續</button>
      <button @click.stop="showGameInfo" class="gap font">遊戲說明</button>
      <NuxtLink to="/" class="gap font">退出</NuxtLink>
    </div>
  </div>
  <GameInfo :show="showInfo" @hide="hideGameInfo" />
</template>

<script setup>
import { ref, defineEmits } from 'vue'
import GameInfo from './GameInfoClose.vue'

const showInfo = ref(false)

const emits = defineEmits(['toggle'])
const continueGame = () => {
  emits('toggle')
}
const showGameInfo = () => {
  showInfo.value = true
}

const hideGameInfo = () => {
  showInfo.value = false
}

const testVolume = () => {
  console.log('Volume')
}
</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.reel {
  position: absolute;
  top: 10%;
  left: 10%;
  background-image: url('/reel.png');
  background-size: contain;
  background-repeat: no-repeat;
  width: 25%;
  height: 60vh;
  margin-left: 27vw;
  margin-bottom: 10vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.font {
  font-family: 'ChenYuluoyan-Thin-Monospaced', ans-serif;

  font-size: calc(3.5vw + 1vh + 1vmin);
  text-shadow:
    1px 1px 4px rgba(219, 114, 73, 0.829),
    1px 1px 4px rgba(5, 5, 5, 0.829);
}
.gap {
  margin-top: 3vh;
}
</style>
