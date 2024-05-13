<script>
import { reactive, onMounted, ref, computed } from 'vue'
import IGsetting from '@/components/IGsetting.vue'
import GameInfoButton from '@/components/GameInfoButton.vue'

export default {
  components: {
    IGsetting,
    GameInfoButton
  },
  setup() {
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

    // Cow style
    const cowStyle = reactive({
      top: '0%',
      left: '0%',
      width: '3%',
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

    // Handle the game info start event
    // @@@ calculate time
    // ### sound on
    // $$$ get refresh token to update
    const handleGameInfoStart = () => {
      isGameInfoVisible.value = false
    }

    // Handle the exit click event
    const handleExitClick = (event) => {
      if (showIGsetting.value || isGameInfoVisible.value) {
        // Add condition to check if GameInfo is showing
        event.preventDefault()
        return
      }
      showButtons.value = false
      showIGsetting.value = false
    }

    // Toggle the IGsetting component
    // @@@ stop time
    // ### stop sound
    const toggleIGsetting = () => {
      if (isGameInfoVisible.value) return
      showIGsetting.value = !showIGsetting.value
      showButtons.value = true
    }

    // Handle the book click event
    const handleBookClick = () => {
      if (showIGsetting.value || bookAnimationClass.value !== 'book-blink') {
        return
      }
      bookStyle.transition = 'all 2s'
      bookStyle.top = '30%'
      bookStyle.left = '45%'
      bookStyle.width = '16vw'
      bookStyle.height = 'auto'
      isFading.value = true
      bookAnimationClass.value = 'bookFlipped'
    }

    // Randomly set the cow position

    // %%% first get answer of word before get refresh token
    onMounted(() => {
      const x = Math.floor(Math.random() * 90)
      const y = Math.floor(Math.random() * 90)
      cowStyle.top = `${y}%`
      cowStyle.left = `${x}%`

      // Randomly select a cow image
      const direction = Math.random() < 0.5 ? 'Right' : 'Left'
      cowImage.value = `/Cow${direction}.png`
      bookDirection.value = direction === 'Right' ? 'Left' : 'Right' // Change the book direction based on the cow direction
    })

    const state = reactive({
      isBookFlipped: false, // 是否翻转
      isLeftFlipped: false // 是否左侧背景翻转
    })

    function flipBook() {
      state.isBookFlipped = true // 点击书本时切换翻转状态

      setTimeout(() => {
        state.isLeftFlipped = true // 点击书本时切换左侧背景翻转状态
      }, 500)
    }

    // Handle the cow click event
    // @@@ stop time
    // ### stop sound
    // !!! send time to backend
    // ^^^ achievement (watch notepad)
    const handleClick = () => {
      if (isGameInfoVisible.value) return // Add condition to check if StartGameInfo is showing
      if (hasClickedCow.value) return // Prevent multiple cow clicks
      if (showIGsetting.value) return // Add condition to check if Setting is showing
      showButtons.value = false

      hasClickedCow.value = true // Prevent multiple cow clicks

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
        bookStyle.top = '30%'
        bookStyle.left = '45%'
        bookStyle.width = '16vw'
        bookStyle.height = 'auto'
        bookAnimationClass.value = 'book-blink'
      }, 2800)
    }

    // Return the reactive variables and functions
    return {
      cowStyle,
      cowImage,
      handleClick,
      showBook,
      bookDirection,
      handleBookClick,
      bookStyle,
      bookAnimationClass,
      showIGsetting,
      toggleIGsetting,
      handleExitClick,
      showButtons,
      bookImageLeft,
      bookImageRight,
      hasClickedCow,
      isGameInfoVisible,
      handleGameInfoStart,
      ...toRefs(state),
      flipBook
    }
  }
}
</script>

<template>
  <div
    :class="{ 'bg-gray-200': showIGsetting }"
    class="grass-background h-[100vh] w-[100vw] bg-cover bg-no-repeat"
  >
    <div>
      <GameInfoButton :show="isGameInfoVisible" @click="handleGameInfoStart" />
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
      <IGsetting
        v-if="showIGsetting"
        :show="showIGsetting"
        @toggle="showIGsetting = !showIGsetting"
      ></IGsetting>
    </div>
    <div class="relative h-[87vh] w-full overflow-hidden">
      <div
        class="bookLeftPage bg-bookPage border-bookPageBorder absolute left-[29%] top-[30%] z-auto h-[55%] w-[16%] border-[6px] border-solid"
        :class="{ leftFlipped: isLeftFlipped }"
      ></div>
      <div
        class="bookRightPage bg-bookPage border-bookPageBorder absolute left-[45%] top-[30%] z-auto h-[55%] w-[16%] border-[6px] border-solid"
      ></div>
      <img
        :src="cowImage"
        class="absolute transition-all duration-300 ease-in-out"
        :class="isGameInfoVisible || showIGsetting ? 'cursor-auto' : 'cursor-pointer'"
        :style="cowStyle"
        @click="handleClick"
      />
      <!-- <div class="bookCenter">
        <div class="containerLeft" :class="{ leftFlipped: isLeftFlipped }"></div>
          <div class="containerRight">
            <div class="book" @click="flipBook">
              <div class="cover front-cover" :class="{ bookFlipped: isBookFlipped }"></div>
            </div>
        </div> -->
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
      <!-- </div> -->
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
  border-right: 1px solid #000;
  box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.3);
}
/* .bookCenter {
  position: absolute;
  top: 30%;
  left: 45%;
  transform: translate(-50%, -50%);
  display: flex;
}

.containerLeft {
  background-color: #f5deb3; 
  width: 200px; 
  height: 300px; 
  display: flex;
  align-items: center;
  padding-top: 10px;
  border: 6px solid #635850; 
  border-right: 0.5px solid #000;
  box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.3);
  z-index: 2;
  opacity: 0;
}

.containerRight {
  background-color: #f5deb3; 
  width: 200px; 
  height: 300px; 
  display: flex;
  align-items: center;
  padding-top: 10px;
  border: 6px solid #635850; 
  border-left: none;
  box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.3);
}

.book {
  position: relative;
  width: 105%;
  height: 110%;
  z-index: 1; 
}

.cover {
  position: absolute;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.front-cover {
  background-image: url('DroppedBookLeft.svg');
} */

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
</style>
