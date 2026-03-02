// 📄 features/scraper/utils/xml/builder.ts

import type { ScrapeItem } from '@/ts/features/scraper/contracts/scrapeItem'

export function buildXml(items: ScrapeItem[]): string {
  const indent = (level: number) => '  '.repeat(level)

  const rows = items.map(item => [
    `${indent(1)}<item>`,
    `${indent(2)}<title>${item.title}</title>`,
    `${indent(2)}<link>${item.url}</link>`,
    `${indent(2)}<description>${item.description ?? ''}</description>`,
    `${indent(1)}</item>`
  ].join('\n')).join('\n')

  return [
    `<?xml version="1.0" encoding="UTF-8"?>`,
    `<results>`,
    rows,
    `</results>`
  ].join('\n')
}
