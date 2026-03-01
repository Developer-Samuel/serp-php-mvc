// 📄 features/scraper/actions/search/search.ts

import type { Ref } from 'vue'
import type { ScrapeResponse } from '@/ts/features/scraper/services/contracts/scrapeResponse'

import { scraperService } from '@/ts/features/scraper/services/scraperService'

export const createSearchAction = (
  keyword: Ref<string>,
  results: Ref<ScrapeResponse | null>,
  errorMessage: Ref<string | null>
) => {
  return async (): Promise<void> => {
    errorMessage.value = null

    const trimmed = keyword.value.trim()

    try {
      results.value = await scraperService.scrape({
        keyword: trimmed
      })
    } catch (error: unknown) {
      errorMessage.value =
        (error as any)?.response?.data?.error ??
        'Search failed. Please try again.'

      results.value = null
    }
  }
}