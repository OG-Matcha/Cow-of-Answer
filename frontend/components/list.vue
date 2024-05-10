<script setup>

</script>

<template>
    <div class="list-background">
      <NuxtLink to="/" class="link">登出</NuxtLink>
      <NuxtLink to="/" class="link">排行榜</NuxtLink>
      <NuxtLink to="/Table" class="link">收藏集</NuxtLink>
    </div>
  </template>
  
  <style scoped>
  .list-background {
    background-image: url('list.png');
    background-size: contain;  /* Adjust this value to prevent image cropping */
    background-repeat: no-repeat;
  }
  
  .link {
    font-size: 0.3em;  /* Adjust this value to scale the text */
  }
  </style>