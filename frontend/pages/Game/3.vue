<script setup>
import { reactive, onMounted, ref, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'

//
const username = useCookie('username')
const userid = useCookie('userid')
const answer = useCookie('answer')
const token = useCookie('token')

// we can set a random number between 1 and 6
const achievementid = useCookie('achievementid')

// Cow variables
const cowImage = ref('/CowRight.png')
const hasClickedCow = ref(false)

// Book variables
const bookDirection = ref('Right')
const showBook = ref(false)
const bookAnimationClass = ref('')
const isFading = ref(false)

// Buttons variables
const showButtons = ref(true)
const showIGsetting = ref(false)
const isGameInfoVisible = ref(true)

// Book images
const bookImageLeft = ref('/DroppedBookLeft.svg')
const bookImageRight = ref('/DroppedBookRight.svg')

// Book flip function
const isBookFlipped = ref(false)
const isLeftFlipped = ref(false)
const isBookRightPageInvisible = ref(false)
const isBookLeftPageInvisible = ref(false)

// Cow book image
const cowBookImage = ref('/CowLOGO.svg')
const isCowBookImageInvisible = ref(false)

// Answer
const isAnswer = ref(false)

// Audio
const audioRefInfo = ref(null)
const audioRefInGame = ref(null)
const volume = ref(1)

// Timer
const gameStartTime = ref(null)
const pauseTime = ref(null)
const savedGameStartTime = ref(null)
const second = ref(0)
const timerId = ref(null)

// Random redirect
const redirectLink = ref('')
const router = useRouter()

// Bonus
const showBonus = ref(false)
const bonusAnimation = ref('')
const isBonus = ref(false)

// Gray background
const showOverlay = ref(false)

// Outside setting
const showConfirm = ref(false)

// Close confirm
const cancelConfirm = () => {
  showConfirm.value = false
  showOverlay.value = false
  audioRefInGame.value.play()
  resumeTimer()
}

// Confirm
const confirm = async () => {
  showConfirm.value = false
  showOverlay.value = false
  await navigateTo({ path: '/challenge' })
}

// Next navigation
const updateRedirect = async () => {
  const randomNumber = Math.random()
  if (randomNumber < 0.9) {
    showBonus.value = true
    redirectLink.value = ''
    isBookRightPageInvisible.value = false
    isBookLeftPageInvisible.value = false
    setTimeout(() => {
      bonusAnimation.value = 'bonus-blink'
    }, 1000)
  } else {
    await navigateTo({ path: '/challenge' })
    console.log('Redirect to challenge')
  }
}

// Open bonus
const openBonus = () => {
  isBonus.value = true
  showBonus.value = false
}

// Close bonus to next
const handleBonusClick = async () => {
  isBonus.value = false
  await navigateTo({ path: '/scenario/6' })
}

// Cow style
const cowStyle = reactive({
  top: '0%',
  left: '0%',
  width: '1%',
  height: 'auto',
  transform: 'translate(-50%, -50%)'
  // opacity: '0'
})

// Book style
const bookStyle = reactive({
  top: '50%',
  left: '50%',
  width: '3%',
  height: 'auto'
})

// Timer functions
const startTimer = () => {
  gameStartTime.value = Date.now()
  timerId.value = setInterval(() => {
    const gameTimeInMilliseconds = Date.now() - gameStartTime.value
    const seconds = Math.floor(gameTimeInMilliseconds / 1000)
    console.log('Game time:', seconds, 'seconds')
  }, 1000)
}

const pauseTimer = () => {
  clearInterval(timerId.value)
  pauseTime.value = Date.now()
  console.log('Game paused')
}

const resumeTimer = () => {
  const pauseDuration = Date.now() - pauseTime.value
  gameStartTime.value += pauseDuration
  timerId.value = setInterval(() => {
    const gameTimeInMilliseconds = Date.now() - gameStartTime.value
    second.value = Math.floor(gameTimeInMilliseconds / 1000)
    console.log('Game time:', seconds, 'seconds')
  }, 1000)
}

const stopTimer = () => {
  clearInterval(timerId.value)
  savedGameStartTime.value = gameStartTime.value
  console.log('Time stopped')
}

// Info Volume Test
const handleVolumeTest = () => {
  audioRefInfo.value.volume = volume.value
  audioRefInfo.value.play()
}

// Handle the game info start event
// 【finish】 @@@ calculate time
// 【finish】 ### sound on
const handleGameInfoStart = () => {
  isGameInfoVisible.value = false
  audioRefInGame.value.volume = volume.value
  audioRefInGame.value.play()
  startTimer()
  // console.log('Game started')
}

// Handle the exit click event
const handleExitClick = (event) => {
  if (showIGsetting.value || isGameInfoVisible.value) {
    // Add condition to check if GameInfo is showing
    event.preventDefault()
    return
  }
  showConfirm.value = true
  showIGsetting.value = false
  showOverlay.value = true
  audioRefInGame.value.pause()
  pauseTimer()
}

const handleContinue = () => {
  showIGsetting.value = false
  showOverlay.value = false
  audioRefInGame.value.play()
  resumeTimer()
}

// Toggle the IGsetting component
// 【finish】 @@@ stop time
// 【finish】 ### stop sound
const toggleIGsetting = () => {
  if (showConfirm.value || isGameInfoVisible.value) return
  showIGsetting.value = !showIGsetting.value
  showOverlay.value = showIGsetting.value

  if (showIGsetting.value) {
    audioRefInGame.value.pause()
    pauseTimer()
  } else {
    audioRefInGame.value.play()
    resumeTimer()
  }
}

// $$$ 【get】 refresh token to update
// %%% first 【get】 answer of word before get refresh token if no answer use loading
onMounted(async () => {
  let cowX = Math.floor(Math.random() * 90)
  let cowY = Math.floor(Math.random() * 90)
  cowStyle.top = `${cowY}%`
  cowStyle.left = `${cowX}%`

  // Randomly select a cow image
  const direction = Math.random() < 0.5 ? 'Right' : 'Left'
  cowImage.value = `/Cow${direction}.png`
  bookDirection.value = direction === 'Right' ? 'Left' : 'Right' // Change the book direction based on the cow direction

  window.addEventListener('mousemove', (event) => {
    const mouseX = (event.clientX / window.innerWidth) * 100
    const mouseY = (event.clientY / window.innerHeight) * 100

    // Calculate the distance between the mouse and the cow
    const dx = mouseX - cowX
    const dy = mouseY - cowY
    const distance = Math.sqrt(dx * dx + dy * dy)

    // Adjust the volume based on the distance
    if (audioRefInGame.value) {
      audioRefInGame.value.volume = Math.max(0.1, Math.min(1, 1.3 - (2 * distance) / 50))
    }
  })

  // Refresh token
  const { data } = await useFetch('http://localhost:8000/api/auth/refresh', {
    method: 'GET',
    headers: {
      Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    }
  })

  token.value = data.value.token
  useCookie('token', token.value)

  // Get the answer
  const {
    data: data2,
    status: status2,
    error: error2
  } = await useFetch('http://localhost:8000/api/book/answer', {
    method: 'GET',
    headers: {
      Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    }
  })

  if (status2.value === 'success') {
    answer.value = data2.value.answer
  } else if (error2.value.statusCode == 404) {
    answer.value = '問題一定可以被解決'
  }
})

onUnmounted(() => {
  clearInterval(timerId.value)
})

// Handle the cow click event
// 【finish】 @@@ stop time
// 【finish】 ### stop sound
// !!! send time to backend
// ^^^ achievement (watch notepad)
const handleClick = async () => {
  if (isGameInfoVisible.value) return // Add condition to check if StartGameInfo is showing
  if (hasClickedCow.value) return // Prevent multiple cow clicks
  if (showIGsetting.value) return // Add condition to check if Setting is showing
  showButtons.value = false
  hasClickedCow.value = true // Prevent multiple cow clicks
  audioRefInGame.value.pause()

  // Stop Timer
  stopTimer()

  // Set the cow style
  cowStyle.top = '50%'
  cowStyle.left = '50%'
  cowStyle.width = '15%'
  cowStyle.height = 'auto'
  cowStyle.opacity = '1'

  // Set the book show style
  setTimeout(() => {
    showBook.value = true
    bookStyle.top = '50%'
    bookStyle.left = '50%'
    bookStyle.width = '3%'
    bookStyle.height = 'auto'

    // Set the book animation style
    if (bookDirection.value === 'Right') {
      bookAnimationClass.value = 'book-animation-Right'
    } else {
      bookAnimationClass.value = 'book-animation-Left'
    }
  }, 500)

  // Move the cow outside of the screen
  setTimeout(() => {
    cowStyle.transition = 'left 2.5s'
    if (bookDirection.value === 'Right') {
      cowStyle.left = '-15%' // Move the cow to the right outside of the screen
    } else {
      cowStyle.left = '115%' // Move the cow to the left outside of the screen
    }
  }, 1500)

  // Move and enlarge the book
  setTimeout(() => {
    bookStyle.transition = 'all 0.429s'
    bookStyle.top = '10%'
    bookStyle.left = '50%'
    bookStyle.width = '24vw'
    bookStyle.height = 'auto'
    bookAnimationClass.value = 'book-blink'
  }, 2800)

  // Send the time to the backend
  const { error } = await useFetch('http://localhost:8000/api/challenge-record', {
    method: 'POST',
    headers: {
      Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    },
    body: {
      user_id: userid.value,
      challenge_number: 3,
      best_time: savedGameStartTime.value
    }
  })

  if (error.value.statusCode == 404) {
    console.log('Error:', error.value)
  }
}

// Handle the book click event
const handleBookClick = () => {
  if (showIGsetting.value || bookAnimationClass.value !== 'book-blink') {
    return
  }
  bookStyle.transition = 'all 2s'
  bookStyle.top = '10%'
  bookStyle.left = '50%'
  bookStyle.width = '24vw'
  bookStyle.height = 'auto'
  bookAnimationClass.value = 'bookFlipped'
  isBookFlipped.value = true
  isBookRightPageInvisible.value = true

  setTimeout(() => {
    isBookLeftPageInvisible.value = true
    isLeftFlipped.value = true // 点击书本时切换左侧背景翻转状态
    isCowBookImageInvisible.value = true
    isFading.value = true
    isAnswer.value = true
  }, 500)
}
</script>

<template>
  <div
    :class="{ 'bg-gray-200': showOverlay }"
    class="grass-background h-[100vh] w-[100vw] bg-cover bg-no-repeat"
  >
    <div>
      <GameInfoButton
        :show="isGameInfoVisible"
        @testVolume1="handleVolumeTest"
        @close="handleGameInfoStart"
      />

      <audio ref="audioRefInfo" controls autoplay style="display: none">
        <source src="/mow.MP3" type="audio/mpeg" />
        Your browser does not support the audio element.
      </audio>

      <audio ref="audioRefInGame" controls loop autoplay style="display: none">
        <source src="/mow.MP3" type="audio/mpeg" />
        Your browser does not support the audio element.
      </audio>
    </div>
    <div class="h-[10vh] w-full">
      <button
        v-if="showButtons"
        class="exit absolute left-0 ml-[3vw] mt-[3vh] h-[6vh] w-[5vw] bg-contain bg-no-repeat"
        @click.prevent="handleExitClick"
      ></button>
      <button
        v-if="showButtons"
        class="setting absolute right-0 mr-[3vw] mt-[3vh] h-[6vh] w-[5vw] bg-contain bg-no-repeat"
        @click="toggleIGsetting"
      ></button>
    </div>
    <div>
      <IGsetting v-if="showIGsetting" @continue="handleContinue"></IGsetting>
    </div>
    <div class="relative h-[87vh] w-full overflow-hidden">
      <div
        v-if="isBookLeftPageInvisible"
        class="bookLeftPage absolute left-[26%] top-[10%] z-auto h-[81%] w-[24%] border-[6px] border-solid border-bookPageBorder bg-bookPage"
        :class="{ leftFlipped: isLeftFlipped }"
      >
        <img
          :src="cowBookImage"
          class="absolute top-[10%] h-[70%] w-[100vw]"
          v-if="isCowBookImageInvisible"
          alt="cowLogo"
        />
      </div>
      <div
        v-if="isBookRightPageInvisible"
        class="bookRightPage absolute left-[50%] top-[10%] z-auto h-[81%] w-[24%] border-[6px] border-solid border-bookPageBorder bg-bookPage"
      >
        <div class="h-[80%] w-auto pl-[5%] pr-[5%] pt-[50%] text-center text-5xl">
          <div v-if="isFading" v-text="answer" class="animation-fade-in font-shu text-answer"></div>
        </div>
        <div class="h-[20%] w-auto p-[5%]">
          <div
            v-if="isFading"
            class="absolute bottom-3 right-5 font-neucha text-4xl text-bookPageBorder"
          >
            <button
              @click="updateRedirect"
              class="animation-fade-in transition-transform duration-300 ease-in-out hover:scale-125 hover:text-bookPageMiddle"
            >
              NEXT>>
            </button>
          </div>
        </div>
      </div>
      <img
        :src="cowImage"
        class="absolute transition-all duration-300 ease-in-out"
        :class="isGameInfoVisible || showIGsetting ? 'cursor-auto' : 'cursor-pointer'"
        :style="cowStyle"
        @click="handleClick"
      />

      <img
        v-if="showBook && bookDirection === 'Left'"
        :src="bookImageLeft"
        class="absolute cursor-pointer"
        :class="bookAnimationClass"
        :style="bookStyle"
        @click="handleBookClick"
      />
      <img
        v-if="showBook && bookDirection === 'Right'"
        :src="bookImageRight"
        class="absolute cursor-pointer"
        :class="bookAnimationClass"
        :style="bookStyle"
        @click="handleBookClick"
      />
    </div>
    <div
      v-if="showBonus"
      class="bonus absolute left-[60%] top-[50%]"
      :class="bonusAnimation"
      @click="openBonus"
    >
      <img
        src="/Bonus.png"
        alt="Bonus"
        class="animation-bonus-fade-in h-auto w-[50%] cursor-pointer"
      />
    </div>
    <!-- user request -->
    <div
      v-if="isBonus"
      class="animation-bonus-fade-in absolute left-[48%] top-[50%] z-[10] h-[4rem] w-[6rem] scale-150 flex-col rounded-xl bg-[#E3C0A7]"
    >
      <div class="flex h-[0.5rem] w-[6rem] items-center justify-center"></div>
      <div class="flex h-[2.5rem] w-full flex-row">
        <div class="flex h-full w-[3rem] items-center justify-center">
          <img src="/bonusCow.svg" alt="bonusCow" class="h-auto w-[80%]" />
        </div>
        <div class="flex h-full w-[5rem]">
          <p
            class="flex items-center justify-center rounded bg-textColor bg-opacity-50 p-1 font-shu text-[0.9rem]"
          >
            A5和牛
          </p>
        </div>
      </div>
      <div class="flex h-[1rem] w-full items-center justify-center">
        <button
          @click="handleBonusClick"
          class="flex h-[10%] w-[30%] items-center justify-center rounded-[1rem] bg-[#846e82] p-1 text-center text-[0.25rem] text-white no-underline"
        >
          NEXT
        </button>
      </div>
    </div>
    <div v-if="showConfirm" class="absolute left-[45%] top-[50%] z-[20]">
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
          <button @click="confirm" class="m-2 w-[2rem]">
            <img src="/confirm.svg" alt="confirm" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.bg-gray-200 {
  background-color: rgba(128, 128, 128, 0.7);
}

.grass-background {
  background-image: url('/Grass background texture.png');
}

.exit {
  background-image: url('/Exit.png');
}

.setting {
  background-image: url('/Setting.png');
}

.bookRightPage {
  border-left: none;
  box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.3);
}

.bookLeftPage {
  border-right: 2px solid #000;
  box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.3);
}

@keyframes bookAnimationLeft {
  0% {
    transform: translateX(0) translateY(0) rotate(0deg) scale(0.8);
  }
  100% {
    transform: translateX(-12vw) translateY(0.5vw) rotate(-360deg) scale(0.8);
  }
}

@keyframes bookAnimationRight {
  0% {
    transform: translateX(0) rotate(0deg) scale(0.8);
  }
  50% {
    transform: translateX(8vw) translateY(0.25vw) rotate(180deg) scale(0.8);
  }
  100% {
    transform: translateX(12vw) translateY(0.5vw) rotate(360deg) scale(0.8);
  }
}

.book-animation-Left {
  animation: bookAnimationLeft 0.5s cubic-bezier(0, 0, 0.58, 1) forwards;
}

.book-animation-Right {
  animation: bookAnimationRight 0.5s cubic-bezier(0, 0, 0.58, 1) forwards;
}

@keyframes bookBlink {
  0%,
  100% {
    opacity: 0.1;
  }
  50% {
    opacity: 1;
  }
}

.book-blink {
  animation: bookBlink 1s infinite;
}

.showIGsetting {
  z-index: 1;
}

@keyframes bookFlip {
  0% {
    transform-origin: left;
    transform: rotateY(0deg);
    opacity: 1;
  }
  25% {
    transform-origin: left;
    transform: rotateY(22.5deg);
    opacity: 1;
  }
  50% {
    transform-origin: left;
    transform: rotateY(45deg);
    opacity: 1;
  }
  75% {
    transform-origin: left;
    transform: rotateY(67.5deg);
    opacity: 1;
  }
  100% {
    transform-origin: left;
    transform: rotateY(90deg);
    opacity: 0.5;
  }
}

.bookFlipped {
  animation: bookFlip 0.6s forwards;
}

@keyframes leftFlip {
  0% {
    transform: scaleX(0);
    transform-origin: right;
    opacity: 1;
  }
  10% {
    transform: scaleX(0.1);
  }
  20% {
    transform: scaleX(0.2);
  }
  30% {
    transform: scaleX(0.3);
  }
  40% {
    transform: scaleX(0.4);
  }
  50% {
    transform: scaleX(0.5);
  }
  60% {
    transform: scaleX(0.6);
  }
  70% {
    transform: scaleX(0.7);
  }
  80% {
    transform: scaleX(0.8);
  }
  90% {
    transform: scaleX(0.9);
  }
  100% {
    transform: scaleX(1);
    transform-origin: right;
    opacity: 1;
  }
}
.leftFlipped {
  animation: leftFlip 0.5s forwards;
}

@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.animation-fade-in {
  animation: fade-in 3.5s ease-in;
}

.bonus {
  transform: translate(-50%, -50%);
}

.animation-bonus-fade-in {
  animation: fade-in 1s ease-in;
}

@keyframes bonusBlink {
  0%,
  100% {
    opacity: 1;
  }
  50% {
    opacity: 0.1;
  }
}

.bonus-blink {
  animation: bonusBlink 1s infinite;
}

.scale-150 {
  transform: scale(4);
}
</style>
