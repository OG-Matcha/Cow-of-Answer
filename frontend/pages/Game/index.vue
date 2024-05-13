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
    const showButtons = ref(true)
    const showIGsetting = ref(false)
    const cowImage = ref('/CowRight.png')
    const showBook = ref(false)
    const bookDirection = ref('Right')
    const bookAnimationClass = ref('')
    const isFading = ref(false)
    const hasClickedCow = ref(false)
    const isGameInfoVisible = ref(false)

    const bookImageLeft = ref('/DroppedBookLeft.svg')
    const bookImageRight = ref('/DroppedBookRight.svg')
    const openBookImage = ref('/OpenedBook.svg')

    const handleGameInfoStart = () => {
      isGameInfoVisible.value = true
    }

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
    const toggleIGsetting = () => {
      if (isGameInfoVisible.value) return
      showIGsetting.value = !showIGsetting.value
      showButtons.value = true
    }

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
      width: '5%',
      height: 'auto'
    })

    // Handle the book click event
    const handleBookClick = () => {
      if (showIGsetting.value || bookAnimationClass.value !== 'book-blink') {
        return
      }
      bookStyle.transition = 'all 2s'
      bookStyle.top = '30%'
      bookStyle.left = '45%'
      bookStyle.width = '20%'
      bookStyle.height = 'auto'
      isFading.value = true
      bookAnimationClass.value = 'book-open'
      setTimeout(() => {
        bookAnimationClass.value = ''
        if (bookDirection.value === 'Left') {
          bookImageLeft.value = openBookImage.value
        } else {
          bookImageRight.value = openBookImage.value
        }
        isFading.value = false
      }, 2000)
    }

    const handleAnimationEnd = () => {
      if (bookDirection.value === 'Left') {
        bookImageLeft.value = openBookImage.value
      } else {
        bookImageRight.value = openBookImage.value
      }
      bookAnimationClass.value = ''
    }

    // Randomly set the cow position
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

    // Handle the cow click event
    const handleClick = () => {
      if (isGameInfoVisible.value) return
      if (hasClickedCow.value) return
      if (showIGsetting.value) return // Add condition to check if GameInfo is showing
      showButtons.value = false

      hasClickedCow.value = true // Prevent multiple cow clicks

      // Set the cow style
      cowStyle.top = '50%'
      cowStyle.left = '50%'
      cowStyle.width = '15%'
      cowStyle.height = 'auto'
      cowStyle.opacity = '1'

      setTimeout(() => {
        showBook.value = true
        bookStyle.top = '50%'
        bookStyle.left = '50%'
        bookStyle.width = '5%'
        bookStyle.height = 'auto'
        if (bookDirection.value === 'Right') {
          bookAnimationClass.value = 'book-animation-Right'
        } else {
          bookAnimationClass.value = 'book-animation-Left'
        }
      }, 500)

      setTimeout(() => {
        cowStyle.transition = 'left 2.5s'
        if (bookDirection.value === 'Right') {
          cowStyle.left = '-15%' // Move the cow to the right outside of the screen
        } else {
          cowStyle.left = '115%' // Move the cow to the left outside of the screen
        }
      }, 1500) // Delay for the duration of the book animation

      setTimeout(() => {
        bookStyle.transition = 'all 0.429s'
        bookStyle.top = '30%'
        bookStyle.left = '45%'
        bookStyle.width = '20%'
        bookStyle.height = 'auto'
        bookAnimationClass.value = 'book-blink'
      }, 2800) // Move and enlarge the book after the cow has moved
    }

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
      openBookImage,
      isFading,
      hasClickedCow,
      handleAnimationEnd,
      isGameInfoVisible,
      handleGameInfoStart
    }
  }
}
</script>

<template>
  <div :class="{ 'bg-gray-200': showIGsetting }" class="grass-background h-[100vh] w-[100vw]">
    <div>
      <GameInfoButton v-if="!isGameInfoVisible">
        <button @click="handleGameInfoStart">開始遊戲</button></GameInfoButton
      >
    </div>
    <div class="h-[10vh] w-full">
      <button
        v-if="showButtons"
        class="exit absolute left-0 ml-[3vw] mt-[3vh] h-[6vh] w-[5vw]"
        @click.prevent="handleExitClick"
      ></button>
      <button
        v-if="showButtons"
        class="setting absolute right-0 mr-[3vw] mt-[3vh] h-[6vh] w-[5vw]"
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
      <img
        :src="cowImage"
        class="absolute cursor-pointer transition-all duration-300 ease-in-out"
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
  background-color: rgba(128, 128, 128, 0.5);
}

.grass-background {
  background-image: url('/Grass background texture.png');
  background-size: cover;
  background-repeat: no-repeat;
}

.exit {
  background-image: url('/Exit.png');
  background-size: contain; /* Adjust this value to prevent image cropping */
  background-repeat: no-repeat;
}

.setting {
  background-image: url('/Setting.png');
  background-size: contain; /* Adjust this value to prevent image cropping */
  background-repeat: no-repeat;
}

.scale-10 {
  transform: scale(0.1);
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

/* @keyframes bookOpen {
  0% {
    transform-origin: left;
    transform: rotateY(0deg);
  }
  100% {
    transform-origin: left;
    transform: rotateY(-180deg);
  }
}

.book-open {
  animation: bookOpen 2s forwards;
} */
</style>
