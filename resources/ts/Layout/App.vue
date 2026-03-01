<!-- 📄 layout/App.vue -->

<template>
  <main class="
    absolute flex flex-col justify-center items-center
    bg-gray-200 dark:bg-gray-950 text-black dark:text-white
    w-full h-screen
  ">
    <Loading v-if="isLoading" />
    <slot></slot>
  </main>
</template>

<script setup lang="ts">
import { useLoading } from '@/ts/composables/loading/useLoading'
import Loading from '@/ts/components/loading/Loading.vue'

const { isLoading } = useLoading()
</script>