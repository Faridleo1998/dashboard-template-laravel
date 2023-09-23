<script setup>
defineProps({
  title: {
    type: String,
    default: ''
  },
  icon: {
    type: String,
    default: ''
  }
})
</script>

<template>
  <button class="hover:text-primary duration-150" :title="title">
    <i v-if="icon" :class="`ti ti-${icon}`"></i>
  </button>
</template>
