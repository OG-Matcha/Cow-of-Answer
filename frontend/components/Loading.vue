<template>
  <div class="flex flex w-[5rem] scale-150 items-center justify-center rounded-xl bg-[#E3C0A7]">
    <div class="loader py-4 font-neucha text-textColor2"></div>
  </div>
</template>

<script setup></script>

<style scoped>
.scale-150 {
  transform: scale(4);
}

/* from https://css-loaders.com/ */
.loader {
  --w: 20ch;
  font-weight: bold;
  font-size: 10px;
  line-height: 1.5em;
  letter-spacing: 20.3ch;
  width: 10ch;
  overflow: hidden;
  white-space: nowrap;
  animation: l17 2s infinite;
}
.loader:before {
  content: 'Loading...';
}

@keyframes l17 {
  0% {
    text-shadow:
      calc(0 * var(--w)) -1.2em #625b71,
      calc(-1 * var(--w)) -1.2em #625b71,
      calc(-2 * var(--w)) -1.2em #625b71,
      calc(-3 * var(--w)) -1.2em #625b71,
      calc(-4 * var(--w)) -1.2em #625b71,
      calc(-5 * var(--w)) -1.2em #625b71,
      calc(-6 * var(--w)) -1.2em #625b71,
      calc(-7 * var(--w)) -1.2em #625b71,
      calc(-8 * var(--w)) -1.2em #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  4% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) -1.2em #625b71,
      calc(-2 * var(--w)) -1.2em #625b71,
      calc(-3 * var(--w)) -1.2em #625b71,
      calc(-4 * var(--w)) -1.2em #625b71,
      calc(-5 * var(--w)) -1.2em #625b71,
      calc(-6 * var(--w)) -1.2em #625b71,
      calc(-7 * var(--w)) -1.2em #625b71,
      calc(-8 * var(--w)) -1.2em #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  8% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) -1.2em #625b71,
      calc(-3 * var(--w)) -1.2em #625b71,
      calc(-4 * var(--w)) -1.2em #625b71,
      calc(-5 * var(--w)) -1.2em #625b71,
      calc(-6 * var(--w)) -1.2em #625b71,
      calc(-7 * var(--w)) -1.2em #625b71,
      calc(-8 * var(--w)) -1.2em #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  12% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) -1.2em #625b71,
      calc(-4 * var(--w)) -1.2em #625b71,
      calc(-5 * var(--w)) -1.2em #625b71,
      calc(-6 * var(--w)) -1.2em #625b71,
      calc(-7 * var(--w)) -1.2em #625b71,
      calc(-8 * var(--w)) -1.2em #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  16% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) -1.2em #625b71,
      calc(-5 * var(--w)) -1.2em #625b71,
      calc(-6 * var(--w)) -1.2em #625b71,
      calc(-7 * var(--w)) -1.2em #625b71,
      calc(-8 * var(--w)) -1.2em #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  20% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) -1.2em #625b71,
      calc(-6 * var(--w)) -1.2em #625b71,
      calc(-7 * var(--w)) -1.2em #625b71,
      calc(-8 * var(--w)) -1.2em #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  24% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 0 #625b71,
      calc(-6 * var(--w)) -1.2em #625b71,
      calc(-7 * var(--w)) -1.2em #625b71,
      calc(-8 * var(--w)) -1.2em #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  28% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 0 #625b71,
      calc(-6 * var(--w)) 0 #625b71,
      calc(-7 * var(--w)) -1.2em #625b71,
      calc(-8 * var(--w)) -1.2em #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  32% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 0 #625b71,
      calc(-6 * var(--w)) 0 #625b71,
      calc(-7 * var(--w)) 0 #625b71,
      calc(-8 * var(--w)) -1.2em #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  36% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 0 #625b71,
      calc(-6 * var(--w)) 0 #625b71,
      calc(-7 * var(--w)) 0 #625b71,
      calc(-8 * var(--w)) 0 #625b71,
      calc(-9 * var(--w)) -1.2em #625b71;
  }
  40%,
  60% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 0 #625b71,
      calc(-6 * var(--w)) 0 #625b71,
      calc(-7 * var(--w)) 0 #625b71,
      calc(-8 * var(--w)) 0 #625b71,
      calc(-9 * var(--w)) 0 #625b71;
  }
  64% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 0 #625b71,
      calc(-6 * var(--w)) 0 #625b71,
      calc(-7 * var(--w)) 0 #625b71,
      calc(-8 * var(--w)) 0 #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
  68% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 0 #625b71,
      calc(-6 * var(--w)) 0 #625b71,
      calc(-7 * var(--w)) 0 #625b71,
      calc(-8 * var(--w)) 1.2em #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
  72% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 0 #625b71,
      calc(-6 * var(--w)) 0 #625b71,
      calc(-7 * var(--w)) 1.2em #625b71,
      calc(-8 * var(--w)) 1.2em #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
  76% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 0 #625b71,
      calc(-6 * var(--w)) 1.2em #625b71,
      calc(-7 * var(--w)) 1.2em #625b71,
      calc(-8 * var(--w)) 1.2em #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
  80% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 0 #625b71,
      calc(-5 * var(--w)) 1.2em #625b71,
      calc(-6 * var(--w)) 1.2em #625b71,
      calc(-7 * var(--w)) 1.2em #625b71,
      calc(-8 * var(--w)) 1.2em #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
  84% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 0 #625b71,
      calc(-4 * var(--w)) 1.2em #625b71,
      calc(-5 * var(--w)) 1.2em #625b71,
      calc(-6 * var(--w)) 1.2em #625b71,
      calc(-7 * var(--w)) 1.2em #625b71,
      calc(-8 * var(--w)) 1.2em #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
  88% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 0 #625b71,
      calc(-3 * var(--w)) 1.2em #625b71,
      calc(-4 * var(--w)) 1.2em #625b71,
      calc(-5 * var(--w)) 1.2em #625b71,
      calc(-6 * var(--w)) 1.2em #625b71,
      calc(-7 * var(--w)) 1.2em #625b71,
      calc(-8 * var(--w)) 1.2em #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
  92% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 0 #625b71,
      calc(-2 * var(--w)) 1.2em #625b71,
      calc(-3 * var(--w)) 1.2em #625b71,
      calc(-4 * var(--w)) 1.2em #625b71,
      calc(-5 * var(--w)) 1.2em #625b71,
      calc(-6 * var(--w)) 1.2em #625b71,
      calc(-7 * var(--w)) 1.2em #625b71,
      calc(-8 * var(--w)) 1.2em #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
  96% {
    text-shadow:
      calc(0 * var(--w)) 0 #625b71,
      calc(-1 * var(--w)) 1.2em #625b71,
      calc(-2 * var(--w)) 1.2em #625b71,
      calc(-3 * var(--w)) 1.2em #625b71,
      calc(-4 * var(--w)) 1.2em #625b71,
      calc(-5 * var(--w)) 1.2em #625b71,
      calc(-6 * var(--w)) 1.2em #625b71,
      calc(-7 * var(--w)) 1.2em #625b71,
      calc(-8 * var(--w)) 1.2em #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
  100% {
    text-shadow:
      calc(0 * var(--w)) 1.2em #625b71,
      calc(-1 * var(--w)) 1.2em #625b71,
      calc(-2 * var(--w)) 1.2em #625b71,
      calc(-3 * var(--w)) 1.2em #625b71,
      calc(-4 * var(--w)) 1.2em #625b71,
      calc(-5 * var(--w)) 1.2em #625b71,
      calc(-6 * var(--w)) 1.2em #625b71,
      calc(-7 * var(--w)) 1.2em #625b71,
      calc(-8 * var(--w)) 1.2em #625b71,
      calc(-9 * var(--w)) 1.2em #625b71;
  }
}
</style>
