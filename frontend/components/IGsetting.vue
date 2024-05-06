<template>
  <div class="bg-table container h-[100%] w-[100%] items-center justify-center">
    <div v-if="!showInfo" class="reel move-left flex justify-center">
      <div class="font space-y-19 flex flex-col items-center justify-center">
        <button @click="continueGame" class="gap font">繼續</button>
        <button @click.stop="showGameInfo" class="gap font">遊戲說明</button>
        <NuxtLink to="/" class="gap font">退出</NuxtLink>
      </div>
    </div>
    <div v-if="showInfo" class="game-info">
      <button @click="hideGameInfo" class="infobutton">X</button>
      <img src="/GameInfo.png" alt="GameInfo" />
    </div>
  </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue'
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
</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.reel {
  position: fixed;
  background-image: url('/reel.png');
  background-size: contain;
  background-repeat: no-repeat;
  width: 60vw;
  height: 60vh;
  margin-left: 27vw;
  margin-bottom: 10vw;
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
.game-info {
  position: absolute;
  top: 70px;
  right: 0;
  bottom: 0;
  left: 430px;
  width: 700px;
  height: 490px;
}
.infobutton {
  position: absolute;
  top: 20px;
  right: 0;
  width: 35px;
  left: 642px;
  font-size: 20px;
  opacity: 0;
  border: none;
}
.move-right {
  margin-left: 10vw;
}
.move-left {
  margin-right: 30vw;
}
</style>
