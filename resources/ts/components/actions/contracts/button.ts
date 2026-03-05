// 📄 features/scraper/components/actions/contract/button.ts

import type { ButtonType } from '@/ts/components/actions/types/button.type';

export interface Button {
  type?: ButtonType;
  body?: string | null;
  class?: string | null;
}
