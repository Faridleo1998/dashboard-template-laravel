<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import SvgIcon from '../Common/SvgIcon.vue'

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
  }
})

const classes =
  'block inline-flex items-center justify-center rounded-md py-3 px-8 text-center font-medium text-white lg:px-8 xl:px-10 duration-300 gap-2 w-full sm:w-[180px]'

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
    <SvgIcon v-if="icon !== ''" :name="icon" />
    <slot />
  </Link>

  <button v-else :class="[classes, buttonTypes[type], align]" v-bind="$attrs">
    <SvgIcon v-if="icon !== ''" :name="icon" />
    <slot />
  </button>
</template>
