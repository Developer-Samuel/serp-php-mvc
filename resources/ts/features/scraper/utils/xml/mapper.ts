// 📄 features/scraper/utils/xml/mapper.ts

import type { ScrapeItem } from '@/ts/features/scraper/contracts/scrapeItem';

export function mapItem(item: unknown): ScrapeItem {
  const typed = item as { title: string; link: string; description?: string };

  return {
    title: typed.title,
    url: typed.link,
    description: typed.description ?? '',
  };
}
