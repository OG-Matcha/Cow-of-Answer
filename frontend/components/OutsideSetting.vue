<template>
  <div>
    <div
      v-if="!showConfirm"
      class="reel align-center absolute left-[38%] top-[20%] z-[5] flex h-[30vw] w-[25vw] flex-col justify-center bg-contain bg-no-repeat"
    >
      <div class="font space-y-19 r-50% flex flex-col items-center justify-center font-chen">
        <button class="font" @click="confirm">登出</button>
        <NuxtLink to="/table/1" class="font mt-[1.25vh]">排行榜</NuxtLink>
        <NuxtLink to="/achievement" class="font mt-[1.25vh]">收藏集</NuxtLink>
      </div>
    </div>
    <div
      v-if="showConfirm"
      class="z-[10] flex w-[8rem] scale-150 flex-col items-center justify-center rounded-xl bg-[#E3C0A7]"
    >
      <div class="mt-1 flex h-[20%] w-[85%] justify-end">
        <button class="w-[0.5rem]" @click="showConfirm = false">
          <img src="/xx.svg" alt="x" />
        </button>
      </div>
      <div class="flex">
        <p class="font-shu text-[0.6rem]">是否確定要登出</p>
      </div>
      <div class="flex w-full items-center justify-around">
        <button @click="showConfirm = false" class="m-2 w-[2rem]">
          <img src="/cancel.svg" alt="cancel" />
        </button>
        <button @click="logOut" class="m-2 w-[2rem]">
          <img src="/confirm.svg" alt="confirm" />
        </button>
      </div>
    </div>
    <div
      v-if="showLoading"
      class="fixed inset-0 z-10 flex w-full items-center justify-center bg-black bg-opacity-50"
    >
      <div class="animate-fade-in w-auto">
        <Loading />
      </div>
    </div>
    <div
      v-if="showHint"
      class="fixed inset-0 z-10 flex w-full items-center justify-center bg-black bg-opacity-50"
    >
      <div class="animate-fade-in w-auto">
        <Hint :label="label" @close="showHint = false" />
      </div>
    </div>
  </div>
</template>

<script setup>
const token = useCookie('token')
const username = useCookie('username')
const label = ref('登出失敗，請再試一次')
const showConfirm = ref(false)
const showLoading = ref(false)
const showHint = ref(false)

const confirm = () => {
  showConfirm.value = true
}

const openModelLoading = () => {
  showLoading.value = true
}

const closeModelLoading = () => {
  showLoading.value = false
}

const openModelHint = () => {
  showHint.value = true
}

const logOut = async () => {
  openModelLoading()

  const { status } = await useFetch('http://localhost:8000/api/auth/logout', {
    method: 'GET',
    headers: {
      Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    }
  })

  if (status.value === 'success') {
    closeModelLoading()

    token.value = null
    username.value = null

    await navigateTo({ path: '/' })
  } else {
    openModelHint()
    closeModelLoading()
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
