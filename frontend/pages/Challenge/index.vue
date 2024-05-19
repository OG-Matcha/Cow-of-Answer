<template>
  <div>
    <div class="flex h-[100vh] w-[100vw] bg-orange-50 p-[2%]">
      <button @click="openModelSetting">
        <img src="/Setting.png" alt="setting" class="fixed left-3 top-3 h-auto w-[3%]" />
      </button>

      <div class="h-auto w-1/3">
        <div class="flex h-[60%] w-auto items-start justify-center">
          <NuxtLink
            :to="openChallenge >= 0 ? '/scenario/1' : null"
            :class="{ 'animate-bounce1': openChallenge >= 0 }"
            class="relative flex h-auto w-[40%] justify-center"
          >
            <img
              src="/cow1.png"
              :style="{ filter: openChallenge >= 0 ? 'none' : 'brightness(50%)' }"
              alt="Challenge1"
              class="absolute h-auto w-full"
            />
          </NuxtLink>
          <img
            src="/grass.png"
            :style="{ filter: openChallenge >= 0 ? 'none' : 'brightness(50%)' }"
            alt="Grass"
            class="absolute bottom-[42%] h-auto w-[15%]"
          />
        </div>
        <div class="flex h-[40%] w-auto items-center justify-center pt-[2%]">
          <div v-html="displayedText" class="ml-[4rem] font-chen text-5xl text-textColor2"></div>
        </div>
      </div>
      <div class="flex h-auto w-1/3 items-start justify-center">
        <NuxtLink
          :to="openChallenge >= 1 ? '/challenge2' : null"
          :class="{ 'animate-bounce2': openChallenge >= 1 }"
          class="relative flex h-auto w-[40%] justify-center"
        >
          <img
            src="/cow2.png"
            :style="{ filter: openChallenge >= 1 ? 'none' : 'brightness(50%)' }"
            alt="Challenge1"
            class="absolute h-auto w-full"
          />
        </NuxtLink>
        <div
          v-if="openChallenge < 1"
          class="absolute bottom-[35%] flex h-auto w-[10%] flex-col items-center justify-center"
        >
          <img src="/lock.svg" alt="lock" />
          <p class="p-3 font-shu text-3xl">未解鎖</p>
        </div>
        <img
          src="/grass.png"
          :style="{ filter: openChallenge >= 1 ? 'none' : 'brightness(50%)' }"
          alt="Grass"
          class="absolute bottom-[12%] h-auto w-[15%]"
        />
      </div>
      <div class="flex h-auto w-1/3 items-start justify-center">
        <NuxtLink
          :to="openChallenge >= 2 ? '/challenge3' : null"
          :class="{ 'animate-bounce3': openChallenge >= 2 }"
          class="relative flex h-auto w-[40%] justify-center"
        >
          <img
            src="/cow3.png"
            :style="{ filter: openChallenge >= 2 ? 'none' : 'brightness(50%)' }"
            alt="Challenge1"
            class="absolute h-auto w-full"
          />
        </NuxtLink>
        <div
          v-if="openChallenge < 2"
          class="absolute bottom-[35%] flex h-auto w-[10%] flex-col items-center justify-center"
        >
          <img src="/lock.svg" alt="lock" />
          <p class="p-3 font-shu text-3xl">未解鎖</p>
        </div>
        <img
          src="/grass.png"
          :style="{ filter: openChallenge >= 2 ? 'none' : 'brightness(50%)' }"
          alt="Grass"
          class="absolute bottom-[23%] h-auto w-[15%]"
        />
      </div>
    </div>
    <div
      v-if="showSetting"
      @click="closeModelSetting"
      class="fixed inset-0 z-10 flex h-auto w-full items-center justify-center bg-black bg-opacity-50"
    >
      <div @click.stop class="animate-fade-in h-auto w-auto">
        <OutsideSetting />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const userName = useCookie('username')
const openChallenge = useCookie('openChallenge')

let originalText = `Hi, ${userName.value} ~ <br> 在尋找COW的過程中 <br> 尋找自己吧！ <br>`
const displayedText = ref('')
const currentIndex = ref(0)

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
})

const showSetting = ref(false)

const openModelSetting = () => {
  showSetting.value = true
}

const closeModelSetting = () => {
  showSetting.value = false
}
</script>

<style scoped>
@keyframes bounce1 {
  0%,
  100% {
    transform: translateY(30vh);
  }

  50% {
    transform: translateY(0vh);
  }
}

.animate-bounce1 {
  animation: bounce1 5s infinite;
}

@keyframes bounce2 {
  0%,
  100% {
    transform: translateY(60vh);
  }

  50% {
    transform: translateY(10vh);
  }
}

.animate-bounce2 {
  animation: bounce2 8s infinite;
}

@keyframes bounce3 {
  0%,
  100% {
    transform: translateY(50vh);
  }

  50% {
    transform: translateY(15vh);
  }
}

.animate-bounce3 {
  animation: bounce3 10s infinite;
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
  animation: fade-in 0.5s ease-in-out;
}
</style>
