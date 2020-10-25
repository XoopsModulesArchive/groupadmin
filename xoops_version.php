<?php

/**
 * モジュール定義
 *
 * モジュールの各種定義情報
 *
 * @author Katsuo Mogi mogi-k2@msg.biglobe.ne.jp
 * @since 1.0
 * @version $Id: xoops_version.php,v 1.6 2004/04/25 10:53:07 mainpc Exp $
 */
// 基本情報
$modversion['name'] = _MI_GROUPADMIN_NAME; // モジュール名前
$modversion['version'] = 2.20; // バージョン
$modversion['description'] = _MI_GROUPADMIN_DESC; // 概要
$modversion['credits'] = 'UHW Module For XOOPS';
$modversion['author'] = 'Katsuo Mogi mogi-k2@msg.biglobe.ne.jp'; // 作者
$modversion['help'] = 'help.html'; // ヘルプファイル(未利用)
$modversion['license'] = 'GPL see LICENSE'; // ライセンス
$modversion['official'] = 0; // 公式モジュール？
$modversion['image'] = 'images/groupadmin_slogo.png'; // モジュールの画像
$modversion['dirname'] = 'groupadmin'; // モジュールのディレクトリ名
// 管理エリア情報
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php'; // 管理エリア・メイン画面
$modversion['adminmenu'] = 'admin/menu.php'; // 管理エリア・サブメニュー項目定義ファイル
// ユーザメニュー情報
$modversion['hasMain'] = 0;
// // コンフィグ値定義 (only for modules that need config settings generated automatically)
// // モジュール管理サブメニューに自動的に「一般設定」が表示され、フォームも作られる
// // name of config option for accessing its specified value. i.e. $xoopsModuleConfig['confname']
// $modversion['config'][1]['name'] = 'write_group';
// // title of this config option displayed in config settings form
// $modversion['config'][1]['title'] = '_MI_GROUPADMIN_CONFTITLE1';
// // description of this config option displayed under title
// $modversion['config'][1]['description'] = '_MI_GROUPADMIN_CONFTITLE1DESC';
// // form element type used in config form for this option. can be one of either textbox, textarea, select, select_multi, yesno, group, group_multi
// $modversion['config'][1]['formtype'] = 'group_multi';
// // value type of this config option. can be one of either int, text, float, array, or other
// // form type of group_multi, select_multi must always be value type of array
// $modversion['config'][1]['valuetype'] = 'array';
// // the default value for this option
// // ignore it if no default
// // 'yesno' formtype must be either 0(no) or 1(yes)
// $modversion['config'][1]['default'] = array(XOOPS_GROUP_ADMIN);
// // options to be displayed in selection box
// // required and valid for 'select' or 'select_multi' formtype option only
// // language constants can be used for array key, otherwise use integer
// /*
// $modversion['config'][1]['options'] = array('5' => 5, '10' => 10, '15' => 15);
// */
// $modversion['config'][2]['name'] = 'regists_per_page';
// $modversion['config'][2]['title'] = '_MI_GROUPADMIN_CONFTITLE2';
// $modversion['config'][2]['description'] = '_MI_GROUPADMIN_CONFTITLE2DESC';
// $modversion['config'][2]['formtype'] = 'textbox';
// $modversion['config'][2]['valuetype'] = 'int';
// $modversion['config'][2]['default'] = 10;
