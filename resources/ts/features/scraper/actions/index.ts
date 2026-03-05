// 📄 features/scraper/actions/index.ts

import type { Ref } from 'vue';
import type { ScrapeResponse } from '@/ts/features/scraper/contracts/scrapeResponse';

import { createSearchAction } from '@/ts/features/scraper/actions/search/search';
import { createDownloadAction } from '@/ts/features/scraper/actions/download/downloadJson';
import { createDownloadXmlAction } from '@/ts/features/scraper/actions/download/downloadXml';

export const useScrapeActions = (
  keyword: Ref<string>,
  results: Ref<ScrapeResponse | null>,
  errorMessage: Ref<string | null>
) => {
  const search = createSearchAction(keyword, results, errorMessage);
  const downloadJson = createDownloadAction(keyword, results);
  const downloadXml = createDownloadXmlAction(keyword, results);

  return {
    search,
    downloadJson,
    downloadXml,
  };
};
