<script setup>
defineProps({
  message: {
    type: String,
    required: true
  }
})
</script>

<template>
  <h5 class="dark:text-gray-2 text-center mt-6">{{ message }}</h5>
</template>
