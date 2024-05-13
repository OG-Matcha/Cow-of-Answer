<template>
  <div v-if="show" class="game-info z-10">
    <button @click="hide" class="infoButton"><img src="/xx.svg" alt="x" /></button>
    <button @click="testVolume" class="volumeButton"><img src="/volume.svg" alt="Volume" /></button>
    <img src="/GameInfo(nobutton).png" alt="GameInfo" />
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
  show: Boolean
})

const emits = defineEmits(['hide'])

const hide = () => {
  emits('hide')
}

const testVolume = () => {
  console.log('Volume')
}
</script>

<!-- 將遊戲說明相關的樣式複製到這裡 -->
<style scoped>
.game-info {
  position: absolute;
  top: 15%;
  left: 30%;
  width: 45%;
  height: auto;
}
.infoButton {
  position: absolute;
  top: 2vh;
  right: 1vw;
  width: 3vw;
  height: 3vh;
  border-radius: 50%;
}
.volumeButton {
  position: absolute;
  bottom: 28%;
  left: 10%;
  width: 10%;
  height: auto;
  border-radius: 50%;
}
</style>
