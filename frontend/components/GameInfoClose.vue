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
    <button
      @click="continueGame"
      class="absolute bottom-[10%] left-[35%] mb-1 ml-0.5 mr-0.5 mt-1 inline-block h-[12%] w-[30%] cursor-pointer rounded-[3rem] bg-[#846e82] p-1 text-center text-2xl text-white no-underline"
    >
      繼續遊戲
    </button>
    <audio ref="audioRefRestart" controls style="display: none">
      <source src="/mow.MP3" type="audio/mpeg" />
      Your browser does not support the audio element.
    </audio>
    <img src="/GameInfo(nobutton).png" alt="GameInfo" />
  </div>
</template>

<script setup>
const audioRefRestart = ref(null)
const volume = ref(1)

const props = defineProps({
  show: Boolean
})

const emits = defineEmits(['hide', 'continueGame'])

const hide = () => {
  emits('hide')
}

const continueGame = () => {
  emits('continueGame')
}
const testVolume = () => {
  audioRefRestart.value.volume = volume.value
  audioRefRestart.value.play()
}
</script>

<style scoped></style>
