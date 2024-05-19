<template>
  <div class="fade-in h-screen w-full overflow-hidden bg-bg-color">
    <div class="flex h-[20%] w-[90%] justify-end">
      <NuxtLink to="/mainPage" class="flex w-8 items-center">
        <div class="flex items-center">
          <img src="/poly.png" alt="button" class="mr-3 w-[50%]" />
          <p class="font-neucha text-2xl">SKIP</p>
        </div>
      </NuxtLink>
    </div>
    <div class="flex h-[40%] w-full items-start justify-around">
      <img class="jump w-[15%]" src="/gress.svg" alt="grass" />
      <img class="jump w-[15%]" src="/gress.svg" alt="grass" />
      <img class="jump w-[15%]" src="/gress.svg" alt="grass" />
      <img class="jump w-[15%]" src="/gress.svg" alt="grass" />
      <img class="jump w-[15%]" src="/gress.svg" alt="grass" />
    </div>
    <div class="flex h-[40%] items-center justify-center">
      <img class="fixed left-[6rem] top-[28rem] w-[15%]" src="/cow4.svg" alt="cow" />
      <div class="flex w-[75%] flex-col rounded-3xl bg-[blanchedalmond]">
        <div class="h-[80%]">
          <p class="p-[3rem] font-chen text-4xl text-listfont">
            {{ text_1_start[textIndex] }}
          </p>
        </div>
        <div class="flex h-[20%] justify-end">
          <button @click="nextText">
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

let text_1_start = [
  '因為人類的肆虐，我們能生活的土地越來越少了...',
  '我的爸爸為了尋找更廣闊的草原讓大家生活，離開了村子，丟下了年幼的我',
  '我並不怪他，我認為我的父親是英雄，只是過了那麼久，他怎麼還沒回來呢?',
  '現在我長大了，還是沒有老爸的消息，為了尋找他我踏上了旅程'
]

let textIndex = ref(0)

const nextText = async () => {
  if (textIndex.value < text_1_start.length - 1) {
    textIndex.value++
  } else {
    const pageElement = document.querySelector('.fade-in')
    pageElement.classList.add('fade-out')

    await new Promise(requestAnimationFrame)

    await navigateTo({
      path: '/Challenge'
    })
  }
}
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
