<template>
  <div
    class="reel align-center absolute left-[38%] top-[20%] z-[5] flex h-[30vw] w-[25vw] flex-col justify-center bg-contain bg-no-repeat"
  >
    <div class="font space-y-19 r-50% flex flex-col items-center justify-center font-chen">
      <button class="font" @click="logOut">登出</button>
      <NuxtLink to="http://localhost:3000/table" class="font mt-[1.25vh]">排行榜</NuxtLink>
      <NuxtLink to="/" class="font mt-[1.25vh]">收藏集</NuxtLink>
    </div>
  </div>
</template>

<script setup>
const token = useCookie('token')
const logOut = async () => {
  alert('確定登出？')
  const { status } = await useFetch('http://localhost:8000/api/auth/logout', {
    method: 'GET',
    headers: {
      Authorization: 'Bearer ' + token.value,
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

<style scoped>
.reel {
  background-image: url('/reel.png');
}
.scale-150 {
  transform: scale(4);
}

.font {
  font-size: clamp(0.125rem, 4vw, 5rem);
  text-shadow:
    1px 1px 4px rgba(219, 114, 73, 0.829),
    1px 1px 4px rgba(5, 5, 5, 0.829);
}
</style>
