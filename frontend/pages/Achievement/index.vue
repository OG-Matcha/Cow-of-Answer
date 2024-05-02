<template>
  <div class="list-background flex h-screen w-screen flex-col items-center justify-center">
    <div class="">
      <h1 class="w-full bg-bg-color p-32 text-3xl text-stone-600">Test Header</h1>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style scoped>
.list-background {
  background-image: url('/Grass background texture.png');
  background-size: contain; /* Adjust this value to prevent image cropping */
  background-repeat: no-repeat;
}
</style>
