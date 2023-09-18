<script setup>
defineProps({
  message: {
    type: String,
    required: true
  }
})
</script>

<template>
  <h5 class="text-black dark:text-white">{{ message }}</h5>
</template>
