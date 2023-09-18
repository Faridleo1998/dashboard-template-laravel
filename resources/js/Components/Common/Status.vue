<script setup>
import { computed } from 'vue'

const props = defineProps({
  status: {
    type: Number,
    required: true
  },
  active: {
    type: String,
    default: 'Activo'
  },
  inactive: {
    type: String,
    default: 'Inactivo'
  },
  alternativeOptions: {
    type: Boolean,
    default: false
  }
})

const textOption = computed(() => {
  if (props.alternativeOptions) {
    return props.status ? 'Si' : 'No'
  } else {
    return props.status ? 'Activo' : 'Inactivo'
  }
})
</script>

<template>
  <p
    class="inline-flex rounded-full bg-opacity-10 py-1 px-3 text-sm font-medium"
    :class="status ? 'bg-success text-success' : 'bg-danger text-danger'"
  >
    {{ textOption }}
  </p>
</template>
