// 📄 features/scraper/utils/xml/downloader.ts

export function downloadXmlFile(content: string, keyword: string): void {
  const blob = new Blob([content], { type: 'application/xml' })

  const url = URL.createObjectURL(blob)

  const anchor = document.createElement('a')
  anchor.href = url
  anchor.download = `results-${keyword.trim()}.xml`

  document.body.appendChild(anchor)
  anchor.click()
  document.body.removeChild(anchor)

  URL.revokeObjectURL(url)
}