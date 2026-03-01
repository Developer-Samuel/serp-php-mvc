// 📄 features/scraper/actions/download/downloadXml.ts

import type { Ref } from 'vue'
import type { ScrapeResponse } from '@/ts/features/scraper/services/contracts/scrapeResponse'
import type { ScrapeItem } from '@/ts/features/scraper/services/contracts/scrapeItem'

import { buildXml } from '@/ts/features/scraper/utils/xml/builder'
import { downloadXmlFile } from '@/ts/features/scraper/utils/xml/downloader'
import { mapItem } from '@/ts/features/scraper/utils/xml/mapper'

export const createDownloadXmlAction = (
  keyword: Ref<string>,
  results: Ref<ScrapeResponse | ScrapeItem[] | null>
) => {
  return (): void => {
    if (!results.value) return

    const raw = results.value as any

    const items: ScrapeItem[] = Array.isArray(raw)
        ? raw.map(mapItem)
        : Array.isArray(raw?.items)
            ? raw.items.map(mapItem)
            : []

    const xml = buildXml(items)

    downloadXmlFile(xml, keyword.value)
  }
}
