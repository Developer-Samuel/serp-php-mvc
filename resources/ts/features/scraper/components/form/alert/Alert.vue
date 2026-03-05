<!-- 📄 features/scraper/components/form/alert/Alert.vue -->

<template>
  <div v-if="message" :class="[wrapperClass, 'w-full rounded-xl p-2']">
    <div class="text-md font-bold text-center">
      {{ message }}
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  message: string | null;
  wrapperClass?: string;
}>();
</script>
