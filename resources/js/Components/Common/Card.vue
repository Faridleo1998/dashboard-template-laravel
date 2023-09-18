<template>
  <div
    class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-6"
  >
    <div v-if="$slots.header" class="mb-10 mt-4 text-black dark:text-white font-bold text-title-sm">
      <slot name="header" />
    </div>
    <slot />

    <div v-if="$slots.footer" class="mt-10 lg:mt-15 flex gap-4 justify-center md:justify-between">
      <slot name="footer" />
    </div>
  </div>
</template>
