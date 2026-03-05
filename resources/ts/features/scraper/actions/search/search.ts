// 📄 features/scraper/actions/search/search.ts

import type { Ref } from 'vue';
import type { ScrapeResponse } from '@/ts/features/scraper/contracts/scrapeResponse';
import type { ApiErrorResponse } from '@/ts/features/scraper/contracts/apiErrorResponse';

import { scraperService } from '@/ts/features/scraper/services/scraperService';
import { useLoading } from '@/ts/composables/loading/useLoading';

export const createSearchAction = (
  keyword: Ref<string>,
  results: Ref<ScrapeResponse | null>,
  errorMessage: Ref<string | null>
): (() => Promise<void>) => {
  const { start, stop } = useLoading();

  return async (): Promise<void> => {
    errorMessage.value = null;
    const trimmed: string = keyword.value.trim();

    if (!trimmed) {
      errorMessage.value = 'Keyword cannot be empty.';
      return;
    }

    start();

    try {
      results.value = await scraperService.scrape({
        keyword: trimmed,
      });
    } catch (error: unknown) {
      const apiError = error as ApiErrorResponse;

      errorMessage.value =
        apiError.response?.data?.error ?? (error instanceof Error ? error.message : 'Search failed. Please try again.');

      results.value = null;
    } finally {
      stop();
    }
  };
};
