<script setup>
import { defineAsyncComponent, computed } from 'vue'

const props = defineProps({
  name: {
    type: String,
    default: 'Widget'
  }
})

const DynamicIcon = computed(() => {
  const name = props.name === '' ? 'Widget' : props.name
  return defineAsyncComponent(() => import(`../../../assets/icons/${name}.vue`))
})
</script>

<template>
  <component :is="DynamicIcon" class="stroke-current" />
</template>
