<template>
  <div>
    <audio loop ref="audioElement" src="/Background.mp3" preload="auto"></audio>
    <div class="flex h-[100vh] w-[100vw] bg-orange-50 p-[2%]">
      <button @click="openModelSetting">
        <img src="/Setting.png" alt="setting" class="fixed left-3 top-3 h-auto w-[3%]" />
      </button>

      <div class="h-auto w-1/3">
        <div class="flex h-[60%] w-auto items-start justify-center">
          <NuxtLink
            :to="openChallenge >= 0 ? (skipEnable ? '/game/1' : '/scenario/1') : null"
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
          :to="openChallenge >= 1 ? (skipEnable ? '/game/2' : '/scenario/3') : null"
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
          :to="openChallenge >= 2 ? (skipEnable ? '/game/3' : '/scenario/5') : null"
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
        <div v-if="skipScenario" class="absolute bottom-[5%] flex items-center justify-center">
          <label
            for="skipEnable"
            class="container flex items-center justify-center font-shu text-2xl"
            >跳過劇情
            <input type="checkbox" id="skipEnable" v-model="skipEnable" />
            <span class="checkmark"></span>
          </label>
        </div>
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
const skipScenario = useCookie('skipScenario')
const skipEnable = useCookie('skipEnable')

let originalText = `Hi, ${userName.value} ~ <br> 在尋找COW的過程中 <br> 尋找自己吧！ <br>`
const displayedText = ref('')
const currentIndex = ref(0)
const audioElement = ref(null)

onMounted(() => {
  audioElement.value.volume = 0.5
  audioElement.value.play()
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
/* from https://www.w3schools.com/howto/howto_css_custom_checkbox.asp */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  cursor: pointer;
}

.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.checkmark {
  position: absolute;
  top: 30%;
  left: 10%;
  height: 15px;
  width: 15px;
  border-radius: 0.1rem;
  border: 2px solid #563a3d;
  background-color: #fdfaf3;
}

.container:hover input ~ .checkmark {
  background-color: #ccc;
}

.container input:checked ~ .checkmark {
  background-color: #563a3d;
}

.checkmark:after {
  content: '';
  position: absolute;
  display: none;
}

.container input:checked ~ .checkmark:after {
  display: block;
}

.container .checkmark:after {
  left: 3px;
  top: 0.5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

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
