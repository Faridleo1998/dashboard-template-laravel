<script setup>
import { Link } from '@inertiajs/vue3'
import Logo from '../../assets/images/logo/logo-dark.svg'
</script>

<template>
  <div
    class="min-h-screen flex flex-col justify-center items-center md:pt-6 pt-0 dark:bg-boxdark-2 dark:text-bodydark"
  >
    <div>
      <Link href="/">
        <img :src="Logo" alt="Logo de explorer" class="max-w-[340px] mb-10" />
      </Link>
    </div>

    <div
      class="w-[90%] md:w-full max-w-md mt-6 px-6 py-4 md:py-6 bg-white overflow-hidden rounded-sm border border-stroke shadow-default dark:border-strokedark dark:bg-boxdark"
    >
      <slot />
    </div>
  </div>
</template>
