<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const buttonTypes = {
  primary: 'bg-primary hover:bg-primaryDark',
  danger: 'bg-danger hover:bg-dangerDark'
}

const props = defineProps({
  type: {
    type: String,
    default: 'primary'
  },
  icon: {
    type: String,
    default: ''
  },
  align: {
    type: String,
    default: 'left'
  },
  href: {
    type: String,
    default: ''
  },
  isOnlyIcon: {
    type: Boolean,
    default: false
  }
})

const classes = `h-full block inline-flex items-center justify-center rounded-md py-3 ${
  props.isOnlyIcon ? 'px-4' : 'px-8'
} text-center font-medium text-white lg:px-8 xl:px-10 duration-300 gap-2 w-auto ${
  props.isOnlyIcon ? '' : 'md:min-w-[180px]'
}`

const align = computed(() => {
  if (props.align === 'right') {
    return 'flex-row-reverse'
  }
  return ''
})
</script>

<template>
  <Link
    v-if="href !== ''"
    :class="[classes, buttonTypes[type], align]"
    :href="href"
    v-bind="$attrs"
  >
    <i v-if="icon" :class="`ti ti-${icon}`"></i>
    <p v-if="!isOnlyIcon" class="-mb-1">
      <slot />
    </p>
  </Link>

  <button v-else :class="[classes, buttonTypes[type], align]" v-bind="$attrs">
    <i v-if="icon" :class="`ti ti-${icon}`"></i>
    <p v-if="!isOnlyIcon" class="-mb-1">
      <slot />
    </p>
  </button>
</template>
