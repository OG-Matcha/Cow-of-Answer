<script setup>
import { ref, onMounted } from 'vue'
// import { useCookie } from 'vue-cookie-next'

const email = ref('')
const password = ref('')
const username = ref('')
const token = useCookie('token')

const logIn = ref(false)
const signIn = ref(false)

const openModalL = () => {
  logIn.value = true
}
const openModalS = () => {
  signIn.value = true
}
const closeModal = () => {
  logIn.value = false
  signIn.value = false
}

let showButtons = ref(false)
let animationsEnded = ref(0)

const handleAnimationEnd = () => {
  animationsEnded.value++
  if (animationsEnded.value >= 1) {
    showButtons.value = true
  }
}
onMounted(() => {
  document.body.style.overflow = 'hidden'
})
</script>

<template>
  <div class="flex h-[100vh] w-[100vw]">
    <div class="flex h-auto w-[47%] items-center justify-center bg-orange-50 p-[2%]">
      <img
        src="/CowLOGO.png"
        alt="cows"
        class="animate-slide-in-from-left h-[80%] w-[80%] justify-center"
        @animationend="handleAnimationEnd"
      />
    </div>

    <div class="h-auto w-[53%] bg-orange-50 p-[2%]">
      <div class="flex h-[70%] w-auto items-end justify-center">
        <img
          src="/TitleFont.png"
          alt="Cow Of Answer"
          class="animate-slide-in-from-right h-[65%] w-[65%]"
          @animationend="handleAnimationEnd"
        />
      </div>
      <div class="flex h-[30%] w-auto">
        <div class="flex h-auto w-[50%] items-center justify-center">
          <button
            @click="openModalL"
            class="flex items-center justify-center text-center text-4xl transition-transform duration-300 ease-in-out hover:scale-110"
          >
            <img
              v-show="showButtons"
              src="/LogIn.png"
              alt="登入"
              class="animate-fade-in h-auto w-[55%]"
            />
          </button>
        </div>
        <div class="flex h-auto w-[50%] items-center justify-center">
          <button
            @click="openModalS"
            class="flex items-center justify-center text-center text-4xl transition-transform duration-300 ease-in-out hover:scale-110"
          >
            <img
              v-show="showButtons"
              src="/SignUp.png"
              alt="註冊"
              class="animate-fade-in h-auto w-[55%]"
            />
          </button>
        </div>
      </div>
    </div>
  </div>
  <div
    v-if="logIn"
    @click="closeModal"
    class="fixed inset-0 z-10 flex h-full w-full items-center justify-center bg-black bg-opacity-50"
  >
    <div @click.stop class="animate-fade-in h-[50%] w-[50%] rounded-3xl bg-overlay p-[2%]">
      <div class="flex h-[25%] w-auto items-start justify-end">
        <button
          @click="closeModal"
          class="text-xl transition duration-200 ease-in-out hover:text-white"
        >
          X
        </button>
      </div>
      <div class="flex h-[25%] w-auto p-[1%] text-xl">
        <p class="flex h-auto w-[30%] items-center pl-[3%] font-neucha text-2xl text-textColor">
          E-mail：
        </p>
        <input
          v-model="email"
          type="email"
          placeholder=" "
          class="h-auto w-[70%] border-b-2 border-textColor bg-transparent outline-none"
        />
      </div>
      <div class="flex h-[25%] w-auto p-[1%] text-2xl">
        <p class="flex h-auto w-[30%] items-center pl-[3%] font-neucha text-xl text-textColor">
          密碼：
        </p>
        <input
          v-model="password"
          type="password"
          placeholder=" "
          class="h-auto w-[70%] border-b-2 border-textColor bg-transparent outline-none"
        />
      </div>
      <div class="flex h-[25%] w-auto justify-end pr-[3%] pt-[2%]">
        <button
          class="flex h-auto w-[20%] items-center justify-end transition-transform duration-300 ease-in-out hover:scale-110"
        >
          <img src="/LogIn.png" alt="登入" />
        </button>
      </div>
    </div>
  </div>
  <div
    v-if="signIn"
    @click="closeModal"
    class="fixed inset-0 z-10 flex h-full w-full items-center justify-center bg-black bg-opacity-50"
  >
    <div @click.stop class="animate-fade-in h-[50%] w-[50%] rounded-3xl bg-overlay p-[2%]">
      <div class="flex h-[20%] w-auto items-start justify-end">
        <button
          @click="closeModal"
          class="text-xl transition duration-200 ease-in-out hover:text-white"
        >
          X
        </button>
      </div>
      <div class="flex h-[20%] w-auto p-[1%] text-2xl">
        <p class="flex h-auto w-[35%] items-center pl-[3%] font-neucha text-textColor">
          使用者名稱：
        </p>
        <input
          v-model="username"
          type="text"
          placeholder="Linda67890"
          class="h-auto w-[65%] border-b-2 border-textColor bg-transparent outline-none"
        />
      </div>
      <div class="flex h-[20%] w-auto p-[1%] text-2xl">
        <p class="flex h-auto w-[35%] items-center pl-[3%] font-neucha text-textColor">E-mail：</p>
        <input
          v-model="email"
          type="email"
          placeholder=" "
          class="h-auto w-[65%] border-b-2 border-textColor bg-transparent outline-none"
        />
      </div>
      <div class="flex h-[20%] w-auto p-[1%] text-2xl">
        <p class="flex h-auto w-[35%] items-center pl-[3%] font-neucha text-textColor">密碼：</p>
        <input
          v-model="password"
          type="password"
          placeholder="請輸入6~13含有英數字的密碼"
          class="h-auto w-[65%] border-b-2 border-textColor bg-transparent outline-none"
        />
      </div>
      <div class="flex h-[20%] w-auto justify-end pr-[3%] pt-[2%]">
        <button
          @click="signInUser"
          class="flex h-auto w-[20%] items-center justify-end transition-transform duration-300 ease-in-out hover:scale-110"
        >
          <img src="/SignUp.png" alt="註冊" />
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
@keyframes slide-in-from-left {
  0% {
    transform: translateX(-100%);
  }

  100% {
    transform: translateX(0);
  }
}

.animate-slide-in-from-left {
  animation: slide-in-from-left 2s ease-out;
}

@keyframes slide-in-from-right {
  0% {
    transform: translateX(100%);
  }

  100% {
    transform: translateX(0);
  }
}

.animate-slide-in-from-right {
  animation: slide-in-from-right 2s ease-out;
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
</style>
