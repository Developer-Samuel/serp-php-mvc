// 📄 features/scraper/actions/search/search.ts

import type { Ref } from 'vue'
import type { ScrapeResponse } from '@/ts/features/scraper/contracts/scrapeResponse'

import { scraperService } from '@/ts/features/scraper/services/scraperService'
import { useLoading } from '@/ts/composables/loading/useLoading'

export const createSearchAction = (
  keyword: Ref<string>,
  results: Ref<ScrapeResponse | null>,
  errorMessage: Ref<string | null>
) => {
  const { start, stop } = useLoading()

  return async (): Promise<void> => {
    errorMessage.value = null

    const trimmed = keyword.value.trim()

    start()

    try {
      results.value = await scraperService.scrape({
        keyword: trimmed
      })
    } catch (error: unknown) {
      errorMessage.value =
        (error as any)?.response?.data?.error ??
        'Search failed. Please try again.'

      results.value = null
    } finally {
      stop()
    }
  }
}