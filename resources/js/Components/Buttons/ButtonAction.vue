<script setup>
import SvgIcon from '../Common/SvgIcon.vue'

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
    <SvgIcon :name="icon" />
  </button>
</template>
