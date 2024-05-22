<template>
  <div class="h-[100vh] w-[100vw] bg-orange-50 p-[2%]">
    <div
      v-if="showContent"
      @click="closeContent"
      class="fixed inset-0 z-10 flex h-full w-full items-center justify-center bg-black bg-opacity-50"
    >
      <div @click.stop class="animate-fade-in h-[30%] w-[40%] rounded-xl bg-overlay p-[2%]">
        <div class="flex h-[10%] w-auto items-start justify-end">
          <button
            @click="closeContent"
            class="text-xl transition duration-200 ease-in-out hover:text-white"
          >
            X
          </button>
        </div>
        <div v-if="selectedId == 1">
          <div class="mb-2 h-[30%] w-auto text-center font-shu text-4xl font-bold">A5和牛</div>
          <div class="h-[60%] w-auto p-[1%] font-chen text-4xl">
            牛排界的愛馬仕，覺得人生不如意的時候，先停一下，吃口A5和牛，享受人生。
          </div>
        </div>
        <div v-else-if="selectedId == 2">
          <div class="mb-2 h-[30%] w-auto text-center font-shu text-4xl font-bold">五花牛</div>
          <div class="h-[60%] w-auto p-[1%] font-chen text-4xl">
            油脂會胖，但肥牛會讓你快樂。找件會讓你快樂的事情去做吧！
          </div>
        </div>
        <div v-else-if="selectedId == 3">
          <div class="mb-2 h-[30%] w-auto text-center font-shu text-4xl font-bold">雪花牛</div>
          <div class="h-[60%] w-auto p-[1%] font-chen text-4xl">
            雪花飄飄~北風蕭蕭~覺得冷，雪花牛配火鍋，暖你一生。
          </div>
        </div>
        <div v-else-if="selectedId == 4">
          <div class="mb-2 h-[30%] w-auto text-center font-shu text-4xl font-bold">培根牛</div>
          <div class="h-[60%] w-auto p-[1%] font-chen text-4xl">
            緊實的肉質，需要高溫炙烤或悶煮。許多事情，放寬心，慢慢來。
          </div>
        </div>
        <div v-else-if="selectedId == 5">
          <div class="mb-2 h-[30%] w-auto text-center font-shu text-4xl font-bold">霜降牛</div>
          <div class="h-[60%] w-auto p-[1%] font-chen text-4xl">
            油脂如霜降般不均勻灑在鮮紅肉色上，人生中，也難免會碰上不如意，咀嚼它，化解它。
          </div>
        </div>
        <div v-else-if="selectedId == 6">
          <div class="mb-2 h-[30%] w-auto text-center font-shu text-4xl font-bold">安格斯牛</div>
          <div class="h-[60%] w-auto p-[1%] font-chen text-4xl">
            因為安格斯牛肉質偏嫩，建議以中火烹煮。在做每件事時，也需要控制火侯，因地制宜。
          </div>
        </div>
      </div>
    </div>
    <div>
      <NuxtLink to="http://localhost:3000/challenge">
        <img src="/Exit.png" alt="Exit" class="fixed left-3 top-3 h-auto w-[3%]" />
      </NuxtLink>
    </div>
    <div class="flex h-[10%] w-auto justify-center font-chen text-5xl">收藏集</div>
    <div class="background animate-fade-in h-[90%] w-auto">
      <div class="relative flex h-1/3 w-auto items-center justify-center">
        <button @click="openContent(1)" v-if="id.includes(1)" class="h-[100%] w-auto">
          <img src="/3starCow.png" alt="" class="h-[70%] w-auto" />
        </button>
        <img
          v-else
          src="/question.png"
          alt=""
          class="h-[70%] w-auto"
          :style="{ filter: 'brightness(75%)' }"
        />
      </div>
      <div class="flex h-1/3 w-auto">
        <div class="flex h-auto w-1/2 items-center justify-center">
          <button @click="openContent(2)" v-if="id.includes(2)" class="h-[100%] w-auto">
            <img src="/兩星牛1.png" alt="" class="h-[70%] w-auto" />
          </button>
          <img
            v-else
            src="/question.png"
            alt=""
            class="h-[70%] w-auto"
            :style="{ filter: 'brightness(75%)' }"
          />
        </div>
        <div class="flex h-auto w-1/2 items-center justify-center">
          <button @click="openContent(3)" v-if="id.includes(3)" class="h-[100%] w-auto">
            <img src="/兩星牛2.png" alt="" class="h-[70%] w-auto" />
          </button>
          <img
            v-else
            src="/question.png"
            alt=""
            class="h-[70%] w-auto"
            :style="{ filter: 'brightness(75%)' }"
          />
        </div>
      </div>
      <div class="flex h-1/3 w-auto">
        <div class="flex h-auto w-1/3 items-center justify-center">
          <button @click="openContent(4)" v-if="id.includes(4)" class="h-[100%] w-auto">
            <img src="/一星牛1.png" alt="" class="h-[70%] w-auto" />
          </button>
          <img
            v-else
            src="/question.png"
            alt=""
            class="h-[70%] w-auto"
            :style="{ filter: 'brightness(75%)' }"
          />
        </div>
        <div class="flex h-auto w-1/3 items-center justify-center">
          <button @click="openContent(5)" v-if="id.includes(5)" class="h-[100%] w-auto">
            <img src="/一星牛2.png" alt="" class="h-[70%] w-auto" />
          </button>
          <img
            v-else
            src="/question.png"
            alt=""
            class="h-[70%] w-auto"
            :style="{ filter: 'brightness(75%)' }"
          />
        </div>
        <div class="flex h-auto w-1/3 items-center justify-center">
          <button @click="openContent(6)" v-if="id.includes(6)" class="h-[100%] w-auto">
            <img src="/一星牛3.png" alt="" class="h-[70%] w-auto" />
          </button>
          <img
            v-else
            src="/question.png"
            alt=""
            class="h-[70%] w-auto"
            :style="{ filter: 'brightness(75%)' }"
          />
        </div>
      </div>
    </div>
    <div
      v-if="showLoading"
      class="fixed inset-0 z-10 flex w-full items-center justify-center bg-black bg-opacity-50"
    >
      <div class="Loading-fade-in w-auto">
        <Loading />
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
const id = ref([])
const showLoading = ref(true)

const selectedId = ref(null)
const showContent = ref(false)
const openContent = (id) => {
  showContent.value = true
  selectedId.value = id
}
const closeContent = () => {
  showContent.value = false
}
onMounted(async () => {
  const token = useCookie('token')
  const { data, status, error } = await useFetch('http://localhost:8000/api/user-achievement', {
    method: 'GET',
    headers: {
      Authorization: 'Bearer ' + token.value,
      'Content-Type': 'application/json'
    }
  })

  if (status.value === 'success') {
    for (let i = 0; i < data.value.length; i++) {
      id.value.push(data.value[i].achievement_id)
    }
  } else if (error.value.statusCode == 404) {
    console.log(error)
    console.log(id.value)
    id.value = []
  } else if (error.value.statusCode == 401) {
    console.log(error)
    console.log('請先登入')
  }
  showLoading.value = false
})
</script>

<style scoped>
.background {
  background-image: url('bookcase.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 90%;
  width: 100%;
}
@keyframes fade-in {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

.animate-fade-in {
  animation: fade-in 0.5s ease-in-out;
}
.cow-fade-in {
  animation: fade-in 0.5s ease-in-out;
  animation-delay: 2s; /* 延遲 2 秒 */
}

.Loading-fade-in {
  animation-delay: 5s;
  animation: fade-in 2s ease-in-out;
}
</style>
