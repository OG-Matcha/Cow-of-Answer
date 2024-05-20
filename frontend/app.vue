<template>
  <div>
    <div v-if="isScreenResolutionValid">
      <NuxtPage />
    </div>
    <div v-else class="flex h-screen items-center justify-center bg-bg-color">
      <div class="font-shu text-2xl">
        請使用至少 <span class="font-neucha">1080 x 720</span> 的解析度以獲得最佳遊戲體驗。
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const isScreenResolutionValid = ref(false)

const checkScreenResolution = () => {
  isScreenResolutionValid.value = window.innerWidth >= 1080 && window.innerHeight >= 720
}

onMounted(() => {
  window.addEventListener('resize', checkScreenResolution)
  checkScreenResolution()
})

onUnmounted(() => {
  window.removeEventListener('resize', checkScreenResolution)
})
</script>
