<template>
  <!-- <Header /> -->
  <section class="min-h-screen h-full flex items-center justify-center w-full">
    <div class="grid lg:grid-cols-2 w-full h-full min-h-screen">
      <div
        class="left place-self-center w-full px-8 md:px-16 lg:px-24 xl:px-36 2xl:px-52"
      >
        <slot />
      </div>
      <div class="right hidden lg:block"></div>
    </div>
  </section>
  <UNotifications />
</template>

<style>
.right {
  background: linear-gradient(-45deg, #27c55e, #10b981, #84cc16, #23d5ab);
  background-size: 400% 400%;
  animation: gradient 15s ease infinite;
}

@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}
</style>
