<template>
  <div class="grass-background h-[100vh] w-[100vw]">
    <div class="h-[10vh] w-full">
      <NuxtLink to="/" class="exit absolute left-0 ml-[3vw] mt-[3vh] h-[6vh] w-[5vw]"></NuxtLink>
      <NuxtLink
        to="/"
        class="setting absolute right-0 mr-[3vw] mt-[3vh] h-[6vh] w-[5vw]"
      ></NuxtLink>
    </div>
    <div class="relative h-[87vh] w-full overflow-hidden">
      <img
        :src="cowImage"
        class="absolute cursor-pointer transition-all duration-300 ease-in-out"
        :style="cowStyle"
        @click="handleClick"
      />
      <img
        v-if="showBook && bookDirection === 'Left'"
        src="/DroppedBookLeft.svg"
        class="absolute cursor-pointer"
        :class="bookAnimationClass"
        :style="bookStyle"
        @click="handleBookClick"
      />
      <img
        v-if="showBook && bookDirection === 'Right'"
        src="/DroppedBookRight.svg"
        class="absolute cursor-pointer"
        :class="bookAnimationClass"
        :style="bookStyle"
        @click="handleBookClick"
      />
    </div>
  </div>
</template>

<script>
import { reactive, onMounted, ref } from 'vue'

export default {
  setup() {
    const cowStyle = reactive({
      top: '0%',
      left: '0%',
      width: '3%',
      height: 'auto',
      transform: 'translate(-50%, -50%)'
      // opacity: '0'
    })

    const bookStyle = reactive({
      top: '50%',
      left: '50%',
      width: '5%',
      height: 'auto'
    })

    const handleBookClick = () => {
      bookStyle.top = '50%'
      bookStyle.left = '50%'
      bookStyle.width = '20%'
      bookStyle.height = 'auto'
      bookAnimationClass.value =
        bookDirection.value === 'Right' ? 'book-animation-Right' : 'book-animation-Left'
    }

    const cowImage = ref('/CowRight.png')
    const showBook = ref(false)
    const bookDirection = ref('Right')
    const bookAnimationClass = ref('')

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

    const handleClick = () => {
      cowStyle.top = '50%'
      cowStyle.left = '50%'
      cowStyle.width = '15%'
      cowStyle.height = 'auto'
      cowStyle.opacity = '1'
      setTimeout(() => {
        showBook.value = true
        bookStyle.top = cowStyle.top
        bookStyle.left = cowStyle.left
        bookStyle.width = '5%'
        bookStyle.height = 'auto'
      }, 500)

      setTimeout(() => {
        cowStyle.transition = 'left 2.5s'
        if (bookDirection.value === 'Right') {
          cowStyle.left = '-15%' // Move the cow to the right outside of the screen
        } else {
          cowStyle.left = '115%' // Move the cow to the left outside of the screen
        }
      }, 1000) // Delay for the duration of the book animation
    }

    return {
      cowStyle,
      cowImage,
      handleClick,
      showBook,
      bookDirection,
      handleBookClick,
      bookStyle,
      bookAnimationClass
    }
  }
}
</script>

<style scoped>
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
  animation:
    bookAnimationLeft 0.5s cubic-bezier(0, 0, 0.58, 1) forwards,
    bookBlink 1s infinite 2s;
}

.book-animation-Right {
  animation:
    bookAnimationRight 0.5s cubic-bezier(0, 0, 0.58, 1) forwards,
    bookBlink 1s infinite 2s;
}

@keyframes bookBlink {
  0%,
  100% {
    opacity: 1;
  }
  50% {
    opacity: 0;
  }
}

.book-center {
  transform: translate(-50%, -50%) scale(2) !important;
  top: 50% !important;
  left: 50% !important;
  animation: none !important;
}
</style>
