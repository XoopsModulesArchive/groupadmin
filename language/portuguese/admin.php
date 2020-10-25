<?php

/**
 * モジュール言語定義管理画面用ファイル
 *
 * 管理画面で使用する文字列の定義
 *
 * @author Katsuo Mogi mogi-k2@msg.biglobe.ne.jp
 * @since 1.0
 * @version $Id: admin.php,v 1.5 2004/04/25 10:07:45 mainpc Exp $
 */
define('_AM_CONFIG', 'グループ管理');
define('_AM_GENERALCONF', '一般設定');
define('_AM_GROUPEDIT', 'グループへ追加・削除');
define('_AM_USERREGIST', 'ユーザ一括登録');
/*********** userregist.php ***********/
define('_AM_ADDGROUP', '追加グループ');
define('_AM_USECOL', 'CSV使用項目');
define('_AM_NAME', '名前');
define('_AM_UNAME', 'ユーザ名');
define('_AM_PASS', 'パスワード');
define('_AM_EMAIL', 'メールアドレス');
define('_AM_UFROM', '居住地');
define('_AM_UOCC', '職業');
define('_AM_BIO', 'その他');
define('_AM_UINTR', '趣味');
define('_AM_RANK', 'ランク');
define('_AM_DEFAULTLABEL', 'デフォルト値：');
define('_AM_CSV', '新規ユーザファイル');
define('_AM_NSRA', '特別ランクは設定されていません');
define('_AM_NSRID', '特別ランクの設定がありません');
define('_AM_DBUPDATED', 'データベースを更新しました');
define('_AM_GROUPEMPTYERR', '%sが選択されていません');
define('_AM_ADDUSERERR', 'ユーザ%sの追加に失敗しました CSVファイル%u行(件)目');
define('_AM_GROUPADDERR', '%sグループへユーザ%sを追加出来ませんでした CSVファイル%u行(件)目');
define('_AM_EXISTSERR', 'ユーザ名%sまたはメールアドレス%sは既に存在しています CSVファイル%u行(件)目');
define('_AM_FIELDFEWERR', 'フィールド数が足りません CSVファイル%u行(件)目');
define('_AM_RANKNOTFOUNDERR', '使用できないランク %s が指定されました CSVファイル%u行(件)目');
/*********** groupedit.php ***********/
define('_AM_SEARCHTITLE', '表示条件');
define('_AM_SEARCHGROUP', '属するグループ');
define('_AM_DISPPERPAGE', '表示件数');
define('_AM_PREVIOUS', '前');
define('_AM_NEXT', '次');
define('_AM_COUNTMSG', '%u人のユーザ中 %d人のユーザが見つかりました');
define('_AM_REMOVEERR', '%sグループからの削除に失敗しました');
define('_AM_ADDERR', 'ユーザ%sを%sグループへ追加できませんでした');
