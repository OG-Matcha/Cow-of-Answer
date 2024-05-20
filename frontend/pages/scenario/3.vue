<template>
  <div class="fade-in h-screen w-full overflow-hidden bg-bg-color">
    <audio loop ref="audioElement" src="/Scenario-3.mp3" preload="auto"></audio>
    <div class="flex h-[20%] w-[90%] justify-end">
      <button @click="skip" class="flex w-8 items-center">
        <div class="flex items-center">
          <img src="/poly.png" alt="button" class="mr-3 w-[50%]" />
          <p class="font-neucha text-2xl">SKIP</p>
        </div>
      </button>
    </div>
    <div class="flex h-[40%] w-full items-start justify-around">
      <img class="jump w-[8%]" src="/light.svg" alt="grass" />
      <img class="jump w-[8%]" src="/light.svg" alt="grass" />
      <img class="jump w-[8%]" src="/light.svg" alt="grass" />
      <img class="jump w-[8%]" src="/light.svg" alt="grass" />
      <img class="jump w-[8%]" src="/light.svg" alt="grass" />
    </div>
    <div class="flex h-[40%] items-center justify-center">
      <img class="fixed left-[6rem] top-[28rem] w-[15%]" src="/cow4.svg" alt="cow" />
      <div class="flex w-[75%] flex-col rounded-3xl bg-[blanchedalmond]">
        <div class="h-[80%]">
          <p class="h-full p-[3rem] font-chen text-4xl text-listfont">
            {{ currentText }}
          </p>
        </div>
        <div class="flex h-[20%] justify-end">
          <button @click="nextText" class="nextButton">
            <div class="mb-3 flex items-center">
              <img src="/Poly2.png" alt="button" class="mr-3 w-[30%]" />
              <p class="font-neucha text-2xl">NEXT</p>
            </div>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

let text = [
  '我翻看著筆記本',
  '裡頭寫著他去過的每個地方，和生活的大大小小日常',
  '奪門而出的我試圖追上他',
  '在夜晚的大街上，依靠路燈稀微的光尋找著'
]

const textIndex = ref(-1)
const currentText = ref('')
const audioElement = ref(null)

const nextText = async () => {
  if (textIndex.value < text.length - 1) {
    const button = document.querySelector('.nextButton')
    button.disabled = true
    textIndex.value++
    currentText.value = ''
    for (let char of text[textIndex.value]) {
      currentText.value += char
      await new Promise((resolve) => setTimeout(resolve, 90))
    }
    button.disabled = false
  } else {
    const pageElement = document.querySelector('.fade-in')
    pageElement.classList.add('fade-out')

    await new Promise(requestAnimationFrame)

    await navigateTo({
      path: '/game/2'
    })
  }
}

const skip = async () => {
  const pageElement = document.querySelector('.fade-in')
  pageElement.classList.add('fade-out')

  await new Promise(requestAnimationFrame)
  await navigateTo({
    path: '/game/2'
  })
}

onMounted(() => {
  nextText()
  audioElement.value.volume = 1
  audioElement.value.play()
})
</script>

<style scoped>
@keyframes jump {
  0% {
    transform: translate3d(0, 0, 0) scale3d(1, 1, 1);
  }
  50% {
    transform: translate3d(0, 30%, 0) scale3d(0.7, 1.5, 1);
  }
  100% {
    transform: translate3d(0, 70%, 0) scale3d(1, 0.7, 1);
  }
}
.jump {
  transform-origin: 50% 50%;
  animation: jump 1s linear alternate infinite;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.fade-in {
  animation: fadeIn 1s ease-in-out;
}

@keyframes fadeOut {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

.fade-out {
  animation: fadeOut 1s ease-in-out forwards;
}
</style>
