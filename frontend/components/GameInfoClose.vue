<template>
  <div v-if="show" class="absolute left-[30%] top-[20%] z-10 h-auto w-[45%]">
    <button @click="hide" class="absolute right-[1vw] top-[2vh] h-[3vh] w-[3vw] rounded-[50%]">
      <img src="/xx.svg" alt="x" />
    </button>
    <button
      @click="testVolume"
      class="absolute bottom-[28%] left-[10%] h-auto w-[10%] rounded-[50%]"
    >
      <img src="/volume.svg" alt="Volume" />
    </button>
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

<style scoped></style>
