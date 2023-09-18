<script setup>
import { ref } from 'vue'
import { watch } from 'vue'
import SvgIcon from '../Common/SvgIcon.vue'
import NavLink from '../NavLink.vue'

const props = defineProps({
  url: {
    type: Object,
    required: true
  },
  groupLinkOpen: {
    type: Boolean,
    default: false
  },
  keyLink: {
    type: Number,
    required: true
  },
  keyGroupLink: {
    type: Number,
    required: true
  }
})

const isOpen = ref(false)

const emit = defineEmits(['handleClickGroupLink'])

watch(
  () => props.keyGroupLink,
  () => {
    if (props.keyGroupLink !== props.keyLink) isOpen.value = false
  }
)
</script>

<template>
  <div
    class="group relative flex items-center justify-between gap-2.5 rounded-sm py-2 lg:py-3 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4 cursor-pointer"
    @click="isOpen = !isOpen"
  >
    <div class="flex items-center gap-2.5">
      <SvgIcon :name="url.icon" />
      {{ url.name }}
    </div>
    <SvgIcon name="ExpandDown" class="duration-300" :class="isOpen ? 'rotate-0' : 'rotate-180'" />
  </div>
  <div class="overflow-hidden" :class="!isOpen && 'hidden'">
    <ul class="mt-4 flex flex-col gap-2.5 pl-6">
      <li v-for="(routeChildren, index) in url.children" :key="index">
        <NavLink :url="routeChildren" @click="emit('handleClickGroupLink', false, keyLink)" />
      </li>
    </ul>
  </div>
</template>
