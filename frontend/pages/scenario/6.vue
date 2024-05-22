<template>
  <div class="fade-in h-screen w-full overflow-hidden bg-bg-color">
    <audio loop ref="audioElement" src="/Scenario-6.mp3" preload="auto"></audio>
    <div class="flex h-[20%] w-[90%] justify-end">
      <button @click="skip" class="flex w-8 items-center">
        <div class="flex items-center">
          <img src="/poly.png" alt="button" class="mr-3 w-[50%]" />
          <p class="font-neucha text-2xl">SKIP</p>
        </div>
      </button>
    </div>
    <div class="flex h-[40%] w-full items-start justify-around">
      <img class="jump w-[10%]" src="/sunset.svg" alt="grass" />
      <img class="jump w-[10%]" src="/sunset.svg" alt="grass" />
      <img class="jump w-[10%]" src="/sunset.svg" alt="grass" />
      <img class="jump w-[10%]" src="/sunset.svg" alt="grass" />
      <img class="jump w-[10%]" src="/sunset.svg" alt="grass" />
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
  '「父親... 為甚麼你要一直躲著我 (我對海吶喊) 我是個壞小孩嗎? 想見很久沒見的父親難道是錯的嗎?」',
  '這時有個人影出現在我視線的左側，在夕陽的照射下，我終於看清他的臉了',
  '我一眼就認出了，是我的老爸，他蒼老了許多，臉上增添了幾分慈祥',
  '他開口說道:「我這幾十年來都相信著，能找到一片能讓大家無憂無慮生活的大草原」',
  '「當我走遍了好幾個地方，卻發現到處都是人類的城市、居住地」',
  '「根本就沒有我所想的地方，或許我們只能住在城市了吧，哈哈哈(苦笑)」',
  '我抱住了父親，說道:「這不是你的錯，你可以早點回來故鄉的，你的兒子、你的老朋友都在等著你分享旅途的點滴」',
  '就這樣我們一路聊到了傍晚，並在之後回到了故鄉，帶著村子的大家一起到了較偏僻的鄉村，過上了步調緩慢的生活'
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
      path: '/scenario/7'
    })
  }
}

const skip = async () => {
  const pageElement = document.querySelector('.fade-in')
  pageElement.classList.add('fade-out')

  await new Promise(requestAnimationFrame)
  await navigateTo({
    path: '/scenario/7'
  })
}

onMounted(async () => {
  nextText()
  audioElement.value.volume = 1
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
