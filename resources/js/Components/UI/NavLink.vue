<script setup>
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import SvgIcon from '../Common/SvgIcon.vue'

defineProps({
  url: {
    required: true,
    type: Object
  }
})

const isUrl = (url) => {
  usePage().url
  url = url.replace('admin.', '')
  return url.startsWith(route().current().split('.')[1])
}
</script>

<template>
  <Link
    class="group relative flex items-center gap-2.5 rounded-sm py-2 lg:py-3 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
    :class="isUrl(url.route) && 'bg-graydark dark:bg-meta-4'"
    :href="route(url.route)"
  >
    <SvgIcon :name="url.icon" />
    {{ url.name }}
  </Link>
</template>
