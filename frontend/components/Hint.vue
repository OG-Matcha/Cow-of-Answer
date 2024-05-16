<template>
  <div class="flex w-[8rem] scale-150 flex-col items-center justify-center rounded-xl bg-[#E3C0A7]">
    <div class="mt-1 flex h-[20%] w-[85%] justify-end">
      <button class="w-[0.5rem]" @click="$emit('close')">
        <img src="/xx.svg" alt="x" />
      </button>
    </div>
    <div class="flex h-[80%] w-full items-center justify-start">
      <img src="/warning.svg" class="mx-2 mb-3 mt-2 w-[1rem]" alt="warning" />
      <div v-html="label" class="mb-1 px-[0.1rem] font-neucha text-[0.4rem]"></div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  label: {
    type: String,
    required: true
  }
})

const label = ref(props.label)
</script>

<style scoped>
.scale-150 {
  transform: scale(4);
}
</style>
