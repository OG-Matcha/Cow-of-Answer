<template>
  <div
    v-if="showIGsetting"
    class="reel align-center absolute left-[38%] top-[20%] z-[5] flex h-[30vw] w-[25vw] flex-col justify-center bg-contain bg-no-repeat"
  >
    <div class="font space-y-19 r-50% flex flex-col items-center justify-center font-chen">
      <button @click="continueGame" class="font">繼續</button>
      <button @click="showGameInfo" class="font mt-[1.25vh]">遊戲說明</button>
      <button @click="confirm" class="font mt-[1.25vh]">退出</button>
    </div>
  </div>
  <div class="absolute left-[45%] top-[50%] z-[10]" v-if="showConfirm">
    <div
      class="flex w-[8rem] scale-150 flex-col items-center justify-center rounded-xl bg-[#E3C0A7]"
    >
      <div class="mt-1 flex h-[20%] w-[85%] justify-end">
        <button class="w-[0.5rem]" @click="cancelConfirm">
          <img src="/xx.svg" alt="x" />
        </button>
      </div>
      <div class="flex">
        <p class="font-shu text-[0.6rem]">是否確定要離開</p>
      </div>
      <div class="flex w-full items-center justify-around">
        <button @click="cancelConfirm" class="m-2 w-[2rem]">
          <img src="/cancel.svg" alt="cancel" />
        </button>
        <button @click="confirmExit" class="m-2 w-[2rem]">
          <img src="/confirm.svg" alt="confirm" />
        </button>
      </div>
    </div>
  </div>

  <GameInfoClose :show="showInfo" @hide="hideGameInfo" @continueGame="hideGameInfoAndContinue" />
</template>

<script setup>
import { ref, defineEmits } from 'vue'

const showInfo = ref(false)
const showIGsetting = ref(true)
const showConfirm = ref(false)

const confirm = () => {
  showConfirm.value = true
  showIGsetting.value = false
}

const cancelConfirm = () => {
  showConfirm.value = false
  showIGsetting.value = true
}

const confirmExit = async () => {
  await navigateTo({ path: '/challenge' })
}

const emits = defineEmits(['continue'])
const continueGame = () => {
  emits('continue')
  showInfo.value = false
  showIGsetting.value = true
}

const showGameInfo = () => {
  showInfo.value = true
  showIGsetting.value = false
}

const hideGameInfo = () => {
  showInfo.value = false
  showIGsetting.value = true
}

const hideGameInfoAndContinue = () => {
  hideGameInfo()
  continueGame()
}
</script>

<style scoped>
.reel {
  background-image: url('/reel.png');
}

.scale-150 {
  transform: scale(4);
}

.font {
  font-size: clamp(0.125rem, 4vw, 5rem);
  text-shadow:
    1px 1px 4px rgba(219, 114, 73, 0.829),
    1px 1px 4px rgba(5, 5, 5, 0.829);
}
</style>
