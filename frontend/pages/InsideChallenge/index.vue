<script setup>
import { ref } from 'vue'
import IGsetting from '@/components/IGsetting.vue'

const showIGsetting = ref(false)
</script>
<template>
  <div
    :class="{ 'bg-gray-200': showIGsetting }"
    class="bg-table flex h-screen w-[100%]"
    style="background-image: url('/Grassbackground.png'); background-size: cover"
  >
    <div class="bg-table fixed flex h-[11%] w-full">
      <div class="bg-table flex h-full w-[50%]">
        <button class="left-0 top-0 m-4 flex">
          <img src="/Exit.png" alt="EX button" class="h-[100%] w-[80%]" />
        </button>
      </div>

      <div class="bg-table relative flex h-full w-[50%] justify-end">
        <button class="left-0 top-0 m-4" @click="showIGsetting = !showIGsetting">
          <img src="/inGameSetting.png" alt="IGset button" class="h-[100%] w-[100%]" />
        </button>
      </div>
    </div>

    <div class="bg-table fixed flex h-[89%] w-full items-center justify-center" style="top: 11%">
      <IGsetting
        v-if="showIGsetting"
        :show="showIGsetting"
        @toggle="showIGsetting = !showIGsetting"
      />
    </div>
  </div>
</template>

<style scoped>
.bg-gray-200 {
  background-color: rgba(128, 128, 128, 0.5);
}
</style>
