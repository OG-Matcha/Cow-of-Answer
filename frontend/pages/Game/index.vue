<template>
  <div class="grass-background h-[100vh] w-[100vw]">
    <div class="h-[10vh] w-full">
      <NuxtLink to="/" class="exit absolute left-0 ml-[3vw] mt-[3vh] h-[6vh] w-[5vw]"></NuxtLink>
      <NuxtLink
        to="/"
        class="setting absolute right-0 mr-[3vw] mt-[3vh] h-[6vh] w-[5vw]"
      ></NuxtLink>
    </div>
    <div class="relative h-[87vh] w-full">
      <img
        :src="cowImage"
        class="absolute cursor-pointer transition-all duration-300 ease-in-out"
        :style="cowStyle"
        @click="handleClick"
      />
      <img
        v-if="showBook && bookDirection === 'Left'"
        src="/DroppedBookLeft.png"
        class="scale-30 book-animation-Left absolute left-1/2 top-1/2 h-auto w-48 translate-x-[-10%] translate-y-[-10%] transform"
      />
      <img
        v-if="showBook && bookDirection === 'Right'"
        src="/DroppedBookRight.png"
        class="scale-30 book-animation-Right absolute left-1/2 top-1/2 h-auto w-48 translate-x-[-10%] translate-y-[-10%] transform"
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

    const cowImage = ref('/CowRight.png')
    const showBook = ref(false)
    const bookDirection = ref('Right')

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
      }, 500)
    }

    return {
      cowStyle,
      cowImage,
      handleClick,
      showBook,
      bookDirection
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

.scale-30 {
  transform: scale(0.3);
}

@keyframes bookAnimationLeft {
  0% {
    transform: translateX(0) translateY(0) rotate(0deg) scale(0.3);
  }
  100% {
    transform: translateX(-12vw) translateY(0.5vw) rotate(-360deg) scale(0.3);
  }
}

@keyframes bookAnimationRight {
  0% {
    transform: translateX(0) rotate(0deg) scale(0.3);
  }
  50% {
    transform: translateX(6vw) translateY(0.25vw) rotate(180deg) scale(0.3);
  }
  100% {
    transform: translateX(12vw) translateY(0.5vw) rotate(360deg) scale(0.3);
  }
}

.book-animation-Left {
  animation: bookAnimationLeft 0.75s cubic-bezier(0, 0, 0.58, 1) forwards;
}

.book-animation-Right {
  animation: bookAnimationRight 0.5s cubic-bezier(0, 0, 0.58, 1) forwards;
}
</style>
