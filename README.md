# PostFit

<img width="712" alt="スクリーンショット 2021-02-26 17 02 41" src="https://user-images.githubusercontent.com/71067058/109272692-965a0500-7854-11eb-8c93-9e3960719f57.png">

## アプリケーション概要

行ったトレーニングを投稿し、記録していくことができるアプリです。

## URL

## 制作背景

より多くの人のトレーニングの手助けになれればと思いこのアプリを開発しました。

- どのくらいの頻度でどの部位をトレーニングしているのか覚えていない。
- 筋トレやジムに行くモチベーションを上げたい。

上記のことは私が思っていたことなのですが、トレーニングを行っている人なら一度は考えたことがあるのではないでしょうか。このアプリは上記のことを全て解決します。また、

- ジムを契約したけど続かずに辞めてしまった。
- 最近太ってきたけど気にせずに食べ過ぎてしまう。

このような話もよく耳にします。トレーニングを記録することは継続を確認することができ、それがモチベーションの向上につながります。

## 機能一覧

### ユーザー機能

- ユーザーの新規登録、ログイン、編集
- ゲストログイン

### 記録機能(体重、ベンチプレス、デッドリフト、スクワット)

- 体重や各種目のMAXを記録

<img width="1159" alt="スクリーンショット 2021-01-19 12 56 25" src="https://user-images.githubusercontent.com/71067058/104986530-87fb1b00-5a56-11eb-9d06-a258b6eb7b77.png">

- 保存した記録をグラフに表示（週間、月間、年間の切り替え表示可能）

![624dab787c4aa40d4bb7e79727694189](https://user-images.githubusercontent.com/71067058/104987907-145b0d00-5a5a-11eb-996e-a2296dd94f1d.gif)

- 記録の編集/削除
- マイページにて各記録、そしてベンチプレス、デッドリフト、スクワットのMAXの合計を表示（体重のみ非公開設定可能）

### ブログ投稿機能

- ブログの新規投稿、編集、削除
- 投稿一覧表示

### その他

- レスポンシブデザイン

## 使用技術

- HTML / CSS
- Bootstrap4
- PHP 8.0.1
- Laravel 8.28.1
- MySQL
- docker
- AWS(EC2)

### users テーブル

| Column             | Type    | Options                    |
| ------------------ | ------- | -------------------------- |
| id                 |         |                            |
| name               | string  |                            |
| email              | string  | unique                     |
| email_verified_at  |         | nullable                   |
| password           | string  |                            |
| remember_token     |         |                            |
| created_at         |         |                            |
| updated_at         |         |                            |

#### リレーション
- hasMany :blogs

### blogs テーブル

| Column               | Type               | Options           |
| -------------------- | ------------------ | ----------------- |
| id                   |                    |                   |
| title                | string             | 50                |
| target_site          | string             |                   |
| content              | text               |                   |
| user_id              | unsignedBigInteger |                   |
| created_at           |                    |                   |
| updated_at           |                    |                   |

#### リレーション

- belongsTo :user
