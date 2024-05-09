<template>
  <div class="background">
    <div class="center">
      <div class="containerLeft" :class="{ leftFlipped: isLeftFlipped }"></div>
      <!-- 动态显示左侧背景 -->
      <div class="containerRight">
        <div class="book" @click="flipBook">
          <div class="cover front-cover" :class="{ bookFlipped: isBookFlipped }"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, toRefs, onMounted } from 'vue'

export default {
  name: 'BookAnimation',
  setup() {
    const state = reactive({
      isBookFlipped: false, // 是否翻转
      isLeftFlipped: false // 是否左侧背景翻转
    })

    function flipBook() {
      state.isBookFlipped = true // 点击书本时切换翻转状态

      setTimeout(() => {
        state.isLeftFlipped = true // 点击书本时切换左侧背景翻转状态
      }, 500)
    }

    return {
      ...toRefs(state),
      flipBook
    }
  }
}
</script>

<style scoped>
.background {
  width: 100vw;
  height: 100vh;
}

.center {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex; /* 将左右容器放在一行 */
}

.containerLeft {
  background-color: #f5deb3; /* 米色背景 */
  width: 200px; /* 书籍宽度 */
  height: 300px; /* 书籍高度 */
  display: flex;
  align-items: center;
  padding-top: 10px;
  border: 6px solid #635850; /* 书籍边框 */
  border-right: 0.5px solid #000;
  box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.3);
  z-index: 2;
  opacity: 0;
}

.containerRight {
  /* position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); */
  background-color: #f5deb3; /* 米色背景 */
  width: 200px; /* 书籍宽度 */
  height: 300px; /* 书籍高度 */
  display: flex;
  align-items: center;
  padding-top: 10px;
  border: 6px solid #635850; /* 书籍边框 */
  border-left: none;
  box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.3);
}

.book {
  position: relative;
  width: 105%;
  height: 110%;
  z-index: 1; /* 确保书籍在背景层上方 */
}

.cover {
  position: absolute;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.front-cover {
  background-image: url('DroppedBookLeft.svg');
  transform-origin: left center;
  transform-style: preserve-3d;
  z-index: 0;
}
@keyframes bookFlip {
  0% {
    transform: rotateY(0deg);
    opacity: 1;
  }
  25% {
    transform: rotateY(22.5deg);
    opacity: 1;
  }
  50% {
    transform: rotateY(45deg);
    opacity: 1;
  }
  75% {
    transform: rotateY(67.5deg);
    opacity: 1;
  }
  100% {
    transform: rotateY(90deg);
    opacity: 0.5;
  }
}
.bookFlipped {
  animation: bookFlip 0.6s forwards;
}

@keyframes leftFlip {
  0% {
    transform: scaleX(0);
    transform-origin: right;
    opacity: 1;
  }
  10% {
    transform: scaleX(0.1);
  }
  20% {
    transform: scaleX(0.2);
  }
  30% {
    transform: scaleX(0.3);
  }
  40% {
    transform: scaleX(0.4);
  }
  50% {
    transform: scaleX(0.5);
  }
  60% {
    transform: scaleX(0.6);
  }
  70% {
    transform: scaleX(0.7);
  }
  80% {
    transform: scaleX(0.8);
  }
  90% {
    transform: scaleX(0.9);
  }
  100% {
    transform: scaleX(1);
    transform-origin: right;
    opacity: 1;
  }
}
.leftFlipped {
  animation: leftFlip 0.5s forwards;
}
</style>
