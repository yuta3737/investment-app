# 投資シミュレーション API 設計書

## 1. API設計

### エンドポイント
`POST /api/simulations`

### リクエストパラメータ

| パラメータ | 型 | 説明 |
|------------|----|------|
| principal | number | 初期投資額 |
| rate | float | 年利（例：0.05） |
| years | integer | 運用年数 |
| type | string | 'simple' or 'compound' |

### レスポンス例
```json
{
  "final_amount": "10000",
  "profit": "100000",
  "breakdown": [...],
  "notified": true
}