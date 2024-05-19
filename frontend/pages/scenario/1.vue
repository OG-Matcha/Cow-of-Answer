<template>
  <div class="flex h-screen flex-col items-center bg-bg-color">
    <div class="flex w-full justify-end">
      <button class="mr-2 inline-block w-8">
        <NuxtLink to="/mainPage"><img src="/poly.png" alt="button" /></NuxtLink>
      </button>
      <button class="mr-7 inline-block flex items-center font-neucha text-4xl">
        <NuxtLink to="/mainPage">SKIP</NuxtLink>
      </button>
    </div>
    <div class="flex w-full items-center justify-center overflow-hidden">
      <img class="jumping" src="/gress.svg" alt="grass" />
      <img class="jumping" src="/gress.svg" alt="grass" />
      <img class="jumping" src="/gress.svg" alt="grass" />
    </div>
    <div class="flex w-full items-center justify-center">
      <img class="fixed" src="/cow4.svg" alt="cow" />
      <div class="dialog">
        <div class="h-4/5">
          <p class="font-neucha text-4xl text-listfont">
            {{ text_1_start[textIndex] }}
          </p>
        </div>
        <div class="flex h-1/5 justify-end">
          <button @click="nextText">
            <img src="/poly2.png" alt="button" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

let text_1_start = [
  '因為人類的肆虐 我們能生活的土地越來越少了...',
  '我的爸爸為了尋找更廣闊的草原讓大家生活 離開了村子 丟下了年幼的我',
  '我並不怪他 我認為我的父親是英雄 只是過了那麼久 他怎麼還沒回來呢?',
  '現在我長大了 還是沒有老爸的消息 為了尋找他我踏上了旅程'
]

let textIndex = ref(0)

const nextText = () => {
  if (textIndex.value < text_1_start.length - 1) {
    textIndex.value++
  } else {
    navigateTo({
      path: '/Challenge'
    })
  }
}
</script>

<style scoped>
@keyframes jump {
  0% {
    transform: translateX(-200%) translateY(-10rem);
  }
  20% {
    transform: translateX(-120%) translateY(0); /* 頂點 */
  }
  40% {
    transform: translateX(-40%) translateY(-10rem);
  }
  60% {
    transform: translateX(40%) translateY(0); /* 頂點 */
  }
  80% {
    transform: translateX(120%) translateY(-10rem);
  }
  100% {
    transform: translateX(200%) translateY(0);
  }
}

.jumping {
  animation: jump 2s cubic-bezier(0.25, 0.1, 0.25, 1) infinite;
  position: relative;
  top: 0;
  margin: 90px;
  background-size: 200% 100%;
}
.dialog {
  background-color: blanchedalmond;
  border-radius: 5rem;
  width: 90rem;
  height: 25rem;
  margin-top: 1rem;
  padding: 4rem;
  padding-left: 7rem;
}
.fixed {
  position: fixed;
  top: 23rem;
  left: 8rem;
}
</style>
