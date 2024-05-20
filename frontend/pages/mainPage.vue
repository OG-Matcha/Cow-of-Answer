<template>
  <div>
    <div class="flex h-[100vh] w-[100vw] overflow-hidden">
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
              @click="openModelLogin"
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
              @click="openModelSignUp"
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
      @click="closeModel"
      class="fixed inset-0 z-10 flex h-full w-full items-center justify-center bg-black bg-opacity-50"
    >
      <div @click.stop class="animate-fade-in h-[50%] w-[50%] rounded-3xl bg-overlay p-[2%]">
        <div class="flex h-[25%] w-auto items-start justify-end">
          <button
            @click="closeModel"
            class="text-xl transition duration-200 ease-in-out hover:text-white"
          >
            X
          </button>
        </div>
        <div class="flex h-[25%] w-auto p-[1%] text-xl">
          <p class="flex h-auto w-[30%] items-center pl-[3%] font-neucha text-2xl text-textColor2">
            E-mail：
          </p>
          <input
            v-model="email"
            type="email"
            placeholder=" "
            required
            class="h-auto w-[70%] border-b-2 border-textColor bg-transparent outline-none"
          />
        </div>
        <div class="flex h-[25%] w-auto p-[1%] text-2xl">
          <p class="flex h-auto w-[30%] items-center pl-[3%] font-neucha text-xl text-textColor2">
            密碼：
          </p>
          <input
            v-model="password"
            type="password"
            placeholder=" "
            required
            class="h-auto w-[70%] border-b-2 border-textColor bg-transparent outline-none"
          />
        </div>
        <div class="flex h-[25%] w-auto justify-end pr-[3%] pt-[2%]">
          <div class="flex w-[80%] items-center justify-start">
            <p class="pl-[1.4rem] font-neucha text-2xl text-red-600">{{ errorMessage }}</p>
          </div>
          <button
            @click="LogInUser"
            class="flex h-auto w-[20%] items-center justify-end transition-transform duration-300 ease-in-out hover:scale-110"
          >
            <img src="/LogIn.png" alt="登入" />
          </button>
        </div>
      </div>
    </div>
    <div
      v-if="signUp"
      @click="closeModel"
      class="fixed inset-0 z-10 flex h-full w-full items-center justify-center bg-black bg-opacity-50"
    >
      <div @click.stop class="animate-fade-in h-[50%] w-[50%] rounded-3xl bg-overlay p-[2%]">
        <div class="flex h-[20%] w-auto items-start justify-end">
          <button
            @click="closeModel"
            class="text-xl transition duration-200 ease-in-out hover:text-white"
          >
            X
          </button>
        </div>
        <div class="flex h-[20%] w-auto p-[1%] text-2xl">
          <p class="flex h-auto w-[35%] items-center pl-[3%] font-neucha text-textColor2">
            使用者名稱：
          </p>
          <input
            v-model="username"
            type="text"
            required
            class="h-auto w-[65%] border-b-2 border-textColor bg-transparent outline-none"
          />
        </div>
        <div class="flex h-[20%] w-auto p-[1%] text-2xl">
          <p class="flex h-auto w-[35%] items-center pl-[3%] font-neucha text-textColor2">
            E-mail：
          </p>
          <input
            v-model="email"
            type="email"
            required
            placeholder=" "
            class="h-auto w-[65%] border-b-2 border-textColor bg-transparent outline-none"
          />
        </div>
        <div class="flex h-[20%] w-auto p-[1%] text-2xl">
          <p class="flex h-auto w-[35%] items-center pl-[3%] font-neucha text-textColor2">密碼：</p>
          <input
            v-model="password"
            type="password"
            required
            placeholder="請輸入6~13含有英數字的密碼"
            class="h-auto w-[65%] border-b-2 border-textColor bg-transparent outline-none"
          />
        </div>
        <div class="flex h-[20%] w-auto justify-end pr-[3%] pt-[2%]">
          <div class="flex w-[80%] items-center justify-start">
            <p class="pl-[1.4rem] font-neucha text-2xl text-red-600">{{ errorMessage }}</p>
          </div>
          <button
            @click="RegisterUser"
            class="flex h-auto w-[20%] items-center justify-end transition-transform duration-300 ease-in-out hover:scale-110"
          >
            <img src="/SignUp.png" alt="註冊" />
          </button>
        </div>
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
import { ref } from 'vue'

const email = ref('')
const password = ref('')
const errorMessage = ref('')
const label = ref(' 登入失敗<br>（使用者帳號或密碼錯誤）')

const username = useCookie('username')
const token = useCookie('token')
const userid = useCookie('userid')

const logIn = ref(false)
const signUp = ref(false)
const showLoading = ref(false)
const showHint = ref(false)

const openModelLogin = () => {
  logIn.value = true
}

const openModelSignUp = () => {
  signUp.value = true
}

const openModelLoading = () => {
  showLoading.value = true
}

const openModelHint = () => {
  showHint.value = true
}

const closeModel = () => {
  logIn.value = false
  signUp.value = false

  email.value = ''
  password.value = ''
  username.value = ''
  errorMessage.value = ''
}

const closeLoading = () => {
  showLoading.value = false
}

let showButtons = ref(false)
let animationsEnded = ref(0)

const handleAnimationEnd = () => {
  animationsEnded.value++
  if (animationsEnded.value >= 1) {
    showButtons.value = true
  }
}

const LogInUser = async () => {
  if (!email.value || !password.value) {
    errorMessage.value = '* 請填寫所有欄位 *'
    await nextTick()
    return
  }

  const emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/
  if (!emailRegex.test(email.value)) {
    errorMessage.value = '* 請輸入有效的電子郵件 *'
    await nextTick()
    return
  }

  const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,13}$/
  if (!passwordRegex.test(password.value)) {
    errorMessage.value = '* 請輸入符合條件的密碼 *'
    await nextTick()
    return
  }

  errorMessage.value = ''
  await nextTick()

  openModelLoading()

  const { data, error, status } = await useFetch('http://localhost:8000/api/auth/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: {
      email: email.value,
      password: password.value
    }
  })

  closeLoading()

  if (status.value === 'success') {
    token.value = data.value.token
    username.value = data.value.user.name
    userid.value = data.value.user.id

    await navigateTo({ path: '/question' })
  } else if (error.value.statusCode == 401) {
    label.value = ' 登入失敗（密碼錯誤）'
    openModelHint()
  } else if (error.value.statusCode == 404) {
    label.value = ' 登入失敗<br>（使用者帳號錯誤）'
    openModelHint()
  }
}

const RegisterUser = async () => {
  if (!username.value || !email.value || !password.value) {
    errorMessage.value = '* 請填寫所有欄位 *'
    await nextTick()
    return
  }

  const emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/
  if (!emailRegex.test(email.value)) {
    errorMessage.value = '* 請輸入有效的電子郵件地址 *'
    await nextTick()
    return
  }

  const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,13}$/
  if (!passwordRegex.test(password.value)) {
    errorMessage.value = '* 請輸入符合條件的密碼 *'
    await nextTick()
    return
  }

  errorMessage.value = ''
  await nextTick()

  openModelLoading()

  const { data, status } = await useFetch('http://localhost:8000/api/auth/register', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: {
      name: username.value,
      email: email.value,
      password: password.value
    }
  })

  closeLoading()

  if (status.value === 'success') {
    token.value = data.value.token
    username.value = data.value.user.name
    userid.value = data.value.user.id

    await navigateTo({ path: '/question' })
  } else {
    label.value = ' 註冊失敗<br>（Email 已被註冊過）'
    openModelHint()
  }
}
</script>

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
