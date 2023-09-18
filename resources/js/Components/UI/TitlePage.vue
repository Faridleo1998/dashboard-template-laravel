<script setup>
defineProps({
  title: {
    type: String,
    required: false,
    default: ''
  }
})
</script>

<template>
  <div
    class="mb-6 flex flex-col md:flex-row gap-3 sm:flex-row sm:items-center sm:justify-between text-center md:text-left"
  >
    <h2 class="text-title-md2 font-semibold text-black dark:text-white">
      {{ title }}
    </h2>
    <slot />
  </div>
</template>
