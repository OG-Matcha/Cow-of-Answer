<template>
  <div class="fade-in h-screen w-full overflow-hidden bg-bg-color">
    <audio loop ref="audioElement" src="/Scenario-4.mp3" preload="auto"></audio>
    <div class="flex h-[20%] w-[90%] justify-end">
      <button @click="skip" class="flex w-8 items-center">
        <div class="flex items-center">
          <img src="/poly.png" alt="button" class="mr-3 w-[50%]" />
          <p class="font-neucha text-2xl">SKIP</p>
        </div>
      </button>
    </div>
    <div class="flex h-[40%] w-full items-start justify-around">
      <img class="jump w-[15%]" src="/wall.svg" alt="grass" />
      <img class="jump w-[15%]" src="/wall.svg" alt="grass" />
      <img class="jump w-[15%]" src="/wall.svg" alt="grass" />
      <img class="jump w-[15%]" src="/wall.svg" alt="grass" />
      <img class="jump w-[15%]" src="/wall.svg" alt="grass" />
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
  '他在我模糊的視線中轉進了一個小巷',
  '見到好久不見的兒子他應該要很開心吧，為甚麼這樣子對我呢? (我心想)',
  '追到了沒路的小巷，小聲的說了一聲：「對不起」',
  '他背靠著一堵矮牆迅速爬過逃走了'
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
      path: '/challenge'
    })
  }
}

const skip = async () => {
  const pageElement = document.querySelector('.fade-in')
  pageElement.classList.add('fade-out')

  await new Promise(requestAnimationFrame)
  await navigateTo({
    path: '/challenge'
  })
}

onMounted(async () => {
  nextText()
  audioElement.value.volume = 0.5
  audioElement.value.play()

  const token = useCookie('token')
  const skipScenario = useCookie('skipScenario')
  const openChallenge = useCookie('openChallenge')

  const { data, status, error } = await useFetch('http://localhost:8000/api/rank-list/rank/user', {
    method: 'GET',
    headers: {
      Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    }
  })

  if (status.value === 'success') {
    if (openChallenge.value == 3) {
      skipScenario.value = true
    } else {
      skipScenario.value = false
    }
  }
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
    transform: translate3d(0, 100%, 0) scale3d(1, 0.7, 1);
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
