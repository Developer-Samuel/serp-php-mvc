<!-- 📄 features/scraper/components/form/ScraperForm.vue -->

<template>
  <form class="w-full mt-6" @submit.prevent="search">
    <Alert :message="errorMessage" wrapper-class="bg-red-500 text-white" />

    <div class="flex mt-6">
      <Input v-model="model" placeholder="Search..." />

      <Button type="submit" class="bg-blue-600 hover:bg-blue-700 rounded-r-lg"> Search </Button>
    </div>
  </form>
</template>

<script setup lang="ts">
import Button from '@/ts/components/actions/Button.vue';
import Alert from '@/ts/components/alert/Alert.vue';
import Input from '@/ts/components/form/fields/Input.vue';

const model = defineModel<string>({
  required: true,
});

defineProps<{
  errorMessage: string | null;
  search: () => void;
}>();
</script>
