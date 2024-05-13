<script setup>
import { ref, onMounted } from 'vue'
import List from '@/components/list.vue'

let userName = ref('User')
let originalText = `Hi, ${userName.value} ~ <br> 最近有什麼困擾著你? <br> 輸入你的問題 <br> 尋找封印在幕後的答案之牛！ <br> `
let displayedText = ref('')
let currentIndex = ref(0)
let showSkipText = ref(false)

onMounted(() => {
  const intervalId = setInterval(() => {
    if (currentIndex.value < originalText.length) {
      if (originalText.substr(currentIndex.value, 4) === '<br>') {
        displayedText.value += '<br>'
        currentIndex.value += 4
      } else {
        displayedText.value += originalText[currentIndex.value]
        currentIndex.value++
      }
    } else {
      clearInterval(intervalId)
    }
  }, 110) // 110 毫秒

  setTimeout(() => {
    showSkipText.value = true
  }, 5800)
})
const showList = ref(false)
const openModalL = () => {
  showList.value = true
}
const closeModal = () => {
  showList.value = false
}
</script>
<template>
  <div class="flex h-[100vh] w-[100vw]">
    <button @click="openModalL">
      <img src="/Setting.png" alt="setting" class="fixed left-3 top-3 h-auto w-[3%]" />
    </button>
    <div class="flex h-auto w-[47%] items-center justify-center bg-orange-50 p-[2%]">
      <img
        src="/CowLOGO.png"
        alt="cows"
        class="animate-slide-in-from-left h-[80%] w-[80%] justify-center"
      />
    </div>
    <div class="h-auto w-[53%] bg-orange-50 p-[2%]">
      <div class="flex h-[50%] w-auto items-end pb-[5%] pl-[5%] text-3xl">
        <div v-html="displayedText" class="font-chen text-textColor2"></div>
      </div>
      <div
        v-if="showSkipText"
        class="animate-fade-in flex h-[10%] w-auto items-start pl-[5%] font-chen text-xl text-textColor2 transition-transform duration-300 ease-in-out"
      >
        (沒有問題可以按下SKIP直接進入關卡)
      </div>
      <div class="flex h-[20%] w-auto pl-[5%]">
        <div
          v-if="showSkipText"
          class="animate-fade-in h-auto w-[80%] transition-transform duration-300 ease-in-out"
        >
          <input
            class="h-auto w-full border-b-2 border-textColor2 bg-transparent font-chen text-2xl outline-none"
            type="text"
            placeholder="你想知道什麼?"
          />
        </div>
        <div
          v-if="showSkipText"
          class="animate-fade-in h-auto w-[20%] pl-[1%] transition-transform duration-300 ease-in-out"
        >
          <NuxtLink to="http://localhost:3000/challenge">
            <img
              src="/btnNext.png"
              alt="Next"
              class="h-auto w-[60%] transition-transform duration-300 ease-in-out hover:scale-110"
            />
          </NuxtLink>
        </div>
      </div>
      <div class="h-[20%] w-auto p-[5%]" v-if="showSkipText">
        <div class="flex items-center justify-end text-center font-neucha text-2xl text-textColor2">
          <NuxtLink
            to="http://localhost:3000/challenge"
            class="animate-fade-in transition-transform duration-300 ease-in-out hover:scale-110 hover:text-hovercolor"
          >
            SKIP>>
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
  <div
    v-if="showList"
    @click="closeModal"
    class="fixed inset-0 z-10 flex h-auto w-full items-center justify-center bg-black bg-opacity-50"
  >
    <div @click.stop class="animate-fade-in h-auto w-auto">
      <List />
    </div>
  </div>
</template>

<style scoped>
p {
  margin-bottom: 1em;
}

@keyframes slide-in-from-left {
  0% {
    transform: translateX(-100%);
  }

  100% {
    transform: translateX(0);
  }
}

.animate-slide-in-from-left {
  animation: slide-in-from-left 2s ease-out;
}

@keyframes fade-in {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

.animate-fade-in {
  animation-delay: 5s;
  animation: fade-in 2s ease-in-out;
}
</style>
