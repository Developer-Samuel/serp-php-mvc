// 📄 features/scraper/utils/xml/mapper.ts

import type { ScrapeItem } from '@/ts/features/scraper/services/contracts/scrapeItem'

export function mapItem(item: any): ScrapeItem {
  return {
    title: item.title,
    url: item.link,
    description: item.description ?? ''
  }
}