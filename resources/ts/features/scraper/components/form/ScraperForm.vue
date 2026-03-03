<!-- 📄 features/scraper/components/form/ScraperForm.vue -->

<template>
  <form @submit.prevent="search" class="w-full mt-6">
    <Alert
      :message="errorMessage"
      wrapper-class="bg-red-500 text-white"
    />

    <div class="flex mt-6">
      <Input
        v-model="model"
        placeholder="Search..."
      />

    <Button type="submit" class="bg-blue-600 hover:bg-blue-700 rounded-r-lg">
      Search
    </Button>
    </div>
  </form>
</template>

<script setup lang="ts">
import Button from '@/ts/features/scraper/components/form/actions/Button.vue'
import Alert from '@/ts/features/scraper/components/form/alert/Alert.vue'
import Input from '@/ts/features/scraper/components/form/fields/Input.vue'

const model = defineModel<string>({
  required: true
})

const props = defineProps<{
  errorMessage: string | null
  search: () => void
}>()
</script>