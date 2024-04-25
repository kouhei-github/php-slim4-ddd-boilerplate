# PHPのSlimでクリーンアーキテクチャ
PHPの軽量フレームワークである、Slim4でクリーンアーキテクチャの作成<br>
マルチステージビルドでキャッシュ戦略を実施して、ビルドを早くした
---

## 使い方

### 1. コンテナのビルド
```shell
docker compose -f docker-compose.prod.yml build
```

### 2. コンテナの起動
```shell
docker compose -f docker-compose.prod.yml up -d
```

### 3. ローカルホストへアクセス
[http://localhost:9000/](http://localhost:9000/)

### 4. コンテナの削除

```shell
docker compose -f docker-compose.prod.yml down
```
