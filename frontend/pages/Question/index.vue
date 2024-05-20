<template>
  <div>
    <div class="flex h-[100vh] w-[100vw]">
      <button @click="openModelSetting">
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
        <div class="flex h-[50%] w-auto items-end pb-[5%] pl-[5%]">
          <div v-html="displayedText" class="font-chen text-4xl text-textColor2"></div>
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
            <button @click="navigateToChallenge">
              <img
                src="/btnNext.png"
                alt="Next"
                class="h-auto w-[60%] transition-transform duration-300 ease-in-out hover:scale-110"
              />
            </button>
          </div>
        </div>
        <div class="h-[20%] w-auto p-[5%]" v-if="showSkipText">
          <div
            class="flex items-center justify-end text-center font-neucha text-2xl text-textColor2"
          >
            <button
              @click="navigateToChallenge"
              class="animate-fade-in transition-transform duration-300 ease-in-out hover:scale-110 hover:text-hovercolor"
            >
              SKIP>>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      v-if="showLoading"
      class="fixed inset-0 z-10 flex w-full items-center justify-center bg-black bg-opacity-50"
    >
      <div class="animate-fade-in w-auto">
        <Loading />
      </div>
    </div>
    <div
      v-if="showSetting"
      @click="closeModelSetting"
      class="fixed inset-0 z-10 flex h-auto w-full items-center justify-center bg-black bg-opacity-50"
    >
      <div @click.stop class="setting-animate-fade-in h-auto w-auto">
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

let originalText = `Hi, ${userName.value} ~ <br> 最近有什麼困擾著你? <br> 輸入你的問題 <br> 尋找封印在幕後的答案之牛！ <br> `
const displayedText = ref('')
const currentIndex = ref(0)
const showSkipText = ref(false)
const showSetting = ref(false)
const showLoading = ref(false)

onMounted(async () => {
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

  const token = useCookie('token')
  const { data, status, error } = await useFetch('http://localhost:8000/api/rank-list/rank/user', {
    method: 'GET',
    headers: {
      Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    }
  })

  if (status.value === 'success') {
    openChallenge.value = data.value.length

    if (openChallenge.value == 3) {
      skipScenario.value = true
    } else {
      skipScenario.value = false
    }
  } else if (error.value.statusCode == 404) {
    openChallenge.value = 0
  }
})

const openModelSetting = () => {
  showSetting.value = true
}

const closeModelSetting = () => {
  showSetting.value = false
}

const openModelLoading = () => {
  showLoading.value = true
}

const closeModelLoading = () => {
  showLoading.value = false
}

const navigateToChallenge = async () => {
  if (openChallenge.value === null || openChallenge.value === undefined) {
    openModelLoading()

    const checkInterval = setInterval(async () => {
      if (openChallenge.value !== null && openChallenge.value !== undefined) {
        clearInterval(checkInterval)
        closeModelLoading()
        await navigateTo({ path: '/challenge' })
      }
    }, 1000)
  } else {
    await navigateTo({ path: '/challenge' })
  }
}
</script>

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

.setting-animate-fade-in {
  animation: fade-in 0.5s ease-in-out;
}

.animate-fade-in {
  animation-delay: 5s;
  animation: fade-in 2s ease-in-out;
}
</style>
