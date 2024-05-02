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

    onMounted(() => {
      const x = Math.floor(Math.random() * 90)
      const y = Math.floor(Math.random() * 90)
      cowStyle.top = `${y}%`
      cowStyle.left = `${x}%`

      // Randomly select a cow image
      cowImage.value = Math.random() < 0.5 ? '/CowRight.png' : '/CowLeft.png'
    })

    const handleClick = () => {
      cowStyle.top = '50%'
      cowStyle.left = '50%'
      cowStyle.width = '15%'
      cowStyle.height = 'auto'
      cowStyle.opacity = '1'
    }

    return {
      cowStyle,
      cowImage,
      handleClick
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
</style>
