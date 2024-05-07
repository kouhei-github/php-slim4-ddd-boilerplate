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

---

## Database関連

### マイグレーション
#### 1. マイグレーションファイルの作成
下記を実行するとこのようなファイルが作成される
**created db/migrations/20240505023238_create_user_migration.php**
```shell
make migrate_create name=CreateUserMigration # 作りたいマイグレーションファイル
# vendor/bin/phinx create  CreateUserMigration # 作りたいマイグレーションファイル
```

#### 2. マイグレーションファイルの反映
```shell
make migrate_up
# vendor/bin/phinx migrate
```

#### 3. マイグレーションファイルのロールバック
```shell
make migrate_down
# vendor/bin/phinx rollback
```

## エンドポイントの確認
### GET アクセスの確認
```text
http://localhost:9000/api/v1/
```
#### Request Headers
| Header Keys | Header Values        |
|-------------|----------------------|
| なし          | なし|

---

### POST ユーザーの追加
```text
http://localhost:9000/api/v1/user/
```

#### Request Body
```json
{
    "email": "test@test.com",
    "name": "test"
}
```

---

### GET ユーザーの取得
```text
http://localhost:9000/api/v1/user/1
```

#### Request Headers
| Header Keys | Header Values        |
|-------------|----------------------|
| なし          | なし|

---

