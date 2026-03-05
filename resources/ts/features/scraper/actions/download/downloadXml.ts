// 📄 features/scraper/actions/download/downloadXml.ts

import type { Ref } from 'vue';
import type { ScrapeResponse } from '@/ts/features/scraper/contracts/scrapeResponse';
import type { ScrapeItem } from '@/ts/features/scraper/contracts/scrapeItem';

import { buildXml } from '@/ts/features/scraper/utils/xml/builder';
import { downloadXmlFile } from '@/ts/features/scraper/utils/xml/downloader';
import { mapItem } from '@/ts/features/scraper/utils/xml/mapper';

export const createDownloadXmlAction = (
  keyword: Ref<string>,
  results: Ref<ScrapeResponse | ScrapeItem[] | null>
): (() => void) => {
  return (): void => {
    const data: ScrapeResponse | ScrapeItem[] | null = results.value;
    if (!data) return;

    let items: ScrapeItem[] = [];

    if (Array.isArray(data)) {
      items = data.map((item: ScrapeItem) => mapItem(item));
    } else if (data && typeof data === 'object' && 'items' in data && Array.isArray(data.items)) {
      items = data.items.map((item: ScrapeItem) => mapItem(item));
    }

    if (items.length === 0) {
      return;
    }

    const xml: string = buildXml(items);
    downloadXmlFile(xml, keyword.value);
  };
};
