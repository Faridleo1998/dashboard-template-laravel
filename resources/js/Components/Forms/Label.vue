<script setup>
import { computed } from 'vue'

const props = defineProps({
  label: {
    type: String,
    default: '',
    required: false
  },
  isRequired: {
    type: Boolean,
    default: false
  }
})

const isRequiredStyles = computed(() =>
  props.isRequired
    ? 'after:content-["*"] after:text-danger after:scale-150 after:relative after:top-[4px]'
    : ''
)
</script>

<template>
  <label class="text-black dark:text-white flex items-center gap-3 mb-2" :class="isRequiredStyles">
    {{ label }}
  </label>
</template>
