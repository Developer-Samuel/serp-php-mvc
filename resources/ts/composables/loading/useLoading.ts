// 📄 composables/loading/useLoading.ts

import { ref, type Ref } from 'vue'

const isLoading: Ref<boolean> = ref(false)

export const useLoading = () => {
  const start = (): void => {
    isLoading.value = true
  }

  const stop = (): void => {
    isLoading.value = false
  }

  return {
    isLoading,
    start,
    stop,
  }
}