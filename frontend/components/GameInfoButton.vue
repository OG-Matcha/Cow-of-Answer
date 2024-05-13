<template>
  <div v-if="startGameInfo" class="game-info1 z-10">
    <img src="/GameInfo(nobutton).png" alt="GameInfo" />
    <button @click="testVolume1" class="volumeButton1">
      <img src="/volume.svg" alt="Volume" />
    </button>
    <button @click="showStartGameInfo" class="startGameButton1">開始遊戲</button>
  </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue'

const startGameInfo = ref(true)

const showStartGameInfo = () => {
  startGameInfo.value = false
}

const emits = defineEmits(['hide'])

const handleStartClick = () => {
  emits('hide')
}

const testVolume1 = () => {
  console.log('Volume')
}
</script>

<!-- 將遊戲說明相關的樣式複製到這裡 -->
<style scoped>
.game-info1 {
  position: absolute;
  top: 20%;
  left: 30%;
  width: 45%;
  height: auto;
}
.volumeButton1 {
  position: absolute;
  bottom: 28%;
  left: 10%;
  width: 10%;
  height: auto;
  border-radius: 50%;
}
.startGameButton1 {
  /* 新增的按鈕樣式 */
  position: absolute;
  bottom: 10%;
  left: 35%;
  width: 30%;
  height: 12%;
  border-radius: 3rem;
  background-color: #846e82; /* Green */
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 1.5rem;
  margin: 0.25rem 0.125rem;
  cursor: pointer;
  padding: 0.25rem;
}
</style>
