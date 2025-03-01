# Tips

## Recon-0
人間が一番脆弱！詰まったらstaffに話しかけてみよう
なにか重大な情報が漏れるかもしれない

## Recon-1
直接リンクされていないけど存在するファイルってあるよね
```
sitemap.xml
.git
.env
.well-known/security.txt
favicon.ico
ads.txt
manifest.json
robots.txt
README.md
README.txt
.htaccess
.htpasswd
```

## Recon-2
HTMLのソースコード上にコメントの消し忘れとかたまにある

## Recon-3
何かエラーが出てる？`SQLのエラー`って何か活用出来ないかな？
SQL injectionにもいくつか種類がある
```
- blind sql injection
    - time based sql injection
    - boolean based sql injection
- Out-of-band sql injection
- Error based sql injection
- Union based sql injection
- Stacked Query sql injection
etc...
```

念の為よくあるチートシートを乗せるよ
- SQL injection cheat sheet - PortSwigger
https://portswigger.net/web-security/sql-injection/cheat-sheet

## Recon-4(Step1突破後)
またエラー？このエラーをよく見るとなにかコマンドが失敗してる？

## Recon-5(Step1突破後)
またクレジットがあるね