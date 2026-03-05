// 📄 features/scraper/state/useScrapeState.ts

import { ref, type Ref } from 'vue';
import type { ScrapeResponse } from '@/ts/features/scraper/contracts/scrapeResponse';

export const useScrapeState = () => {
  const keyword: Ref<string> = ref('');
  const results: Ref<ScrapeResponse | null> = ref(null);
  const errorMessage: Ref<string | null> = ref(null);

  return {
    keyword,
    results,
    errorMessage,
  };
};
