<script setup>
const logOut = async () => {
  alert('確定登出？')
  const { data, status } = await useFetch('http://localhost:8000/api/auth/logout', {
    method: 'GET',
    headers: {
      //   Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    }
  })

  console.log(status.value)

  if (status.value === 'success') {
    console.log('User logout success')
    await navigateTo({ path: '/mainPage' })
  } else {
    console.log('User logout failed')
  }
}
</script>

<template>
  <div class="list-background flex h-auto w-auto scale-150 flex-col items-center justify-center">
    <NuxtLink
      to="http://localhost:3000/mainPage"
      class="no-scale h-[20%] w-auto font-chen text-xs"
      @click="logOut"
      >登出</NuxtLink
    >
    <NuxtLink
      to="http://localhost:3000/table"
      class="no-scale flex h-[20%] w-auto justify-center font-chen text-xs"
      >排行榜</NuxtLink
    >
    <NuxtLink
      to="/"
      class="no-scale flex h-[20%] w-auto items-start justify-center font-chen text-xs"
      >收藏集</NuxtLink
    >
  </div>
</template>

<style scoped>
.list-background {
  background-image: url('list.png');
  background-size: cover; /* Adjust this value to prevent image cropping */
  background-repeat: no-repeat;
  justify-content: space-around;
  padding: 5px;
}
.scale-150 {
  transform: scale(4);
}
</style>
