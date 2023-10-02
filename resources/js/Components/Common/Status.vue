<script setup>
defineProps({
  status: {
    type: Number,
    required: true
  },
  options: {
    type: Object,
    default: () => {
      return {
        0: {
          text: 'Inactivo',
          type: 'danger'
        },
        1: {
          text: 'Activo',
          type: 'success'
        }
      }
    }
  }
})
</script>

<template>
  <p
    class="inline-flex rounded-full bg-opacity-10 py-1 px-3 text-sm font-medium"
    :class="`bg-${options[status].type} text-${options[status].type}`"
  >
    {{ options[status].text }}
  </p>
</template>
