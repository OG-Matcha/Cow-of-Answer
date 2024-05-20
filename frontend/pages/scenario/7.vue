<template>
  <div class="fade-in flex h-screen items-center justify-center bg-bg-color">
    <div class="flex flex-col items-center justify-around text-center">
      <p class="m-3 font-shu text-5xl tracking-[2rem]">全劇終</p>
      <p class="m-3 font-neucha text-5xl tracking-[2rem]">The End</p>
    </div>
  </div>
</template>

<script setup>
onMounted(() => {
  setTimeout(async () => {
    const pageElement = document.querySelector('.fade-in')
    pageElement.classList.add('fade-out')

    await new Promise(requestAnimationFrame)

    await navigateTo({
      path: '/challenge'
    })
  }, 5000)
})
</script>

<style scoped>
@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.fade-in {
  animation: fadeIn 1s ease-in-out;
}

@keyframes fadeOut {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    background-color: black;
  }
}

.fade-out {
  animation: fadeOut 4s ease-in-out forwards;
}
</style>
