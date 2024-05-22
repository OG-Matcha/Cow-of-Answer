<template>
  <div class="h-[100vh] w-[100vw] bg-table">
    <div class="flex h-[40%] w-full border-b-2 border-black bg-table">
      <div>
        <NuxtLink to="http://localhost:3000/challenge">
          <img src="/Exit.png" alt="Exit" class="fixed left-3 top-3 h-auto w-[3%]" />
        </NuxtLink>
      </div>
      <div class="h-auto w-[20%]"></div>

      <div class="flex h-auto w-[60%] justify-center font-neucha">
        <div class="h-full w-[35%]">
          <div class="flex h-[25%] w-auto items-end justify-center text-xl">{{ times[1] }}</div>
          <div class="flex h-[65%] w-auto items-end justify-center">
            <img src="/tableCow.png" alt="third" class="h-full w-auto" />
          </div>
          <div class="flex h-[10%] w-auto items-end justify-center text-xl">2nd {{ names[1] }}</div>
        </div>
        <div class="h-full w-[50%]">
          <div class="flex h-[15%] w-auto items-end justify-center text-2xl">{{ times[0] }}</div>
          <div class="flex h-[75%] w-auto items-end justify-center">
            <img src="/tableCow.png" alt="first" class="h-full w-auto" />
          </div>
          <div class="flex h-[10%] w-auto items-end justify-center text-2xl">
            1st {{ names[0] }}
          </div>
        </div>
        <div class="h-auto w-[15%]">
          <div class="flex h-[40%] w-auto items-end justify-center text-lg">{{ times[2] }}</div>
          <div class="flex h-[50%] w-auto items-end justify-center">
            <img src="/tableCow.png" alt="third" class="h-auto w-full" />
          </div>
          <div class="flex h-[10%] w-auto items-end justify-center text-lg">3rd {{ names[2] }}</div>
        </div>
      </div>
      <div class="flex h-auto w-[20%] flex-col justify-center p-[3%] font-chen">
        <NuxtLink
          to="/table/1"
          class="m-[2%] flex justify-center border-2 duration-300 ease-in-out hover:scale-110 hover:border-textColor"
        >
          <span class="inline-block p-1 text-2xl hover:text-textColor">關卡一</span>
        </NuxtLink>
        <NuxtLink
          to="/table/2"
          class="m-[2%] flex justify-center border-2 duration-300 ease-in-out hover:scale-110 hover:border-textColor"
        >
          <span class="inline-block p-1 text-2xl hover:text-textColor">關卡二</span>
        </NuxtLink>
        <NuxtLink
          to="/table/3"
          class="m-[2%] flex justify-center border-2 duration-300 ease-in-out hover:scale-110 hover:border-textColor"
        >
          <span class="inline-block p-1 text-2xl hover:text-textColor">關卡三</span>
        </NuxtLink>
      </div>
    </div>
    <div class="flex h-[60%] w-auto justify-center font-neucha text-xl">
      <div class="flex h-auto w-1/3 flex-col items-center">
        <div
          v-for="(rank, index) in ranks"
          :key="index"
          class="m-[2%] text-xl"
          :class="{
            'text-red-500': username === names.slice(-7)[index] && Ytime === times.slice(-7)[index]
          }"
        >
          {{ rank }}
        </div>
        <div class="h-[5vh] w-auto"></div>
        <p class="font-chen text-xl">你的最佳紀錄</p>
      </div>
      <div class="flex h-auto w-1/3 flex-col items-center text-lg">
        <div
          v-for="(name, index) in names.slice(-7)"
          :key="index"
          class="m-[2%] text-xl"
          :class="{
            'text-red-500': username === names.slice(-7)[index] && Ytime === times.slice(-7)[index]
          }"
        >
          {{ name }}
        </div>
        <div class="h-[5vh] w-auto">...</div>
        {{ username || '--' }}
      </div>
      <div class="flex h-auto w-1/3 flex-col items-center text-lg">
        <div
          v-for="(time, index) in times.slice(-7)"
          :key="index"
          class="m-[2%] text-xl"
          :class="{
            'text-red-500': username === names.slice(-7)[index] && Ytime === times.slice(-7)[index]
          }"
        >
          {{ time }}
        </div>
        <div class="h-[5vh] w-auto"></div>
        {{ Ytime || '--:--:--' }}
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
  </div>
</template>

<script setup>
import { ref } from 'vue'

const username = useCookie('username')
const showLoading = ref(true)

const ranks = ref(['4th', '5th', '6th', '7th', '8th', '9th', '10th'])

const names = ref([])
while (names.value.length < 10) {
  names.value.push('--')
}

const times = ref([])
while (times.value.length < 10) {
  times.value.push('--:--:--')
}

const Ytime = ref('')

function secondsToHms(d) {
  if (d == 0) {
    return '00:00:00'
  }

  if (d === null || d === undefined) {
    return '--:--:--'
  }
  d = Number(d)
  var h = Math.floor(d / 3600)
  var m = Math.floor((d % 3600) / 60)
  var s = Math.floor((d % 3600) % 60)

  var hDisplay = h > 0 ? (h < 10 ? '0' + h : h) + ':' : '00:'
  var mDisplay = m > 0 ? (m < 10 ? '0' + m : m) + ':' : '00:'
  var sDisplay = s > 0 ? (s < 10 ? '0' + s : s) : '00'
  return hDisplay + mDisplay + sDisplay
}

onMounted(async () => {
  const token = useCookie('token')
  const { data, status, error } = await useFetch('http://localhost:8000/api/rank-list/2', {
    method: 'GET',
    headers: {
      Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    }
  })

  if (status.value === 'success') {
    for (let i = 0; i < data.value.length; i++) {
      names.value[i] = data.value[i].user_name
      times.value[i] = secondsToHms(data.value[i].best_time)
    }
  } else if (error.value.statusCode == 404) {
    console.log(error)
  } else if (error.value.statusCode == 401) {
    console.log(error)
  }

  const {
    data: myData,
    status: myStatus,
    error: myError
  } = await useFetch('http://localhost:8000/api/rank-list/rank/user', {
    method: 'GET',
    headers: {
      Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    }
  })
  if (myStatus.value === 'success') {
    const challenge = myData.value.find((item) => item.challenge_number === 2)
    if (challenge) {
      Ytime.value = secondsToHms(challenge.best_time)
    } else {
      Ytime.value = '--:--:--'
    }
  } else if (myError.value.statusCode == 404) {
    console.log(myError)
    Ytime.value = '--:--:--'
    console.log(Ytime.value)
  } else if (myError.value.statusCode == 401) {
    console.log(myError)
  }

  showLoading.value = false
})
</script>
<style scoped>
@keyframes fade-in {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

.animate-fade-in {
  animation-delay: 5s;
  animation: fade-in 2s ease-in-out;
}
</style>
