<?php

/**
 * 管理エリア・メイン画面
 *
 * 管理エリアでモジュールがクリックされた時に表示されるファイル
 *
 * @author Katsuo Mogi mogi-k2@msg.biglobe.ne.jp
 * @since 1.0
 * @version $Id: index.php,v 1.1.1.1 2004/03/18 04:29:16 mainpc Exp $
 */
// 管理エリア用インクルードファイル
require dirname(__DIR__, 3) . '/include/cp_header.php';
// 管理エリア用ヘッダ
xoops_cp_header();
echo '<h4>' . _AM_CONFIG . '</h4>';
echo "<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
echo " - <b><a href='groupedit.php'>" . _AM_GROUPEDIT . "</a></b><br><br>\n";
echo " - <b><a href='userregist.php'>" . _AM_USERREGIST . "</a></b><br><br>\n";
//echo " - <b><a href='".XOOPS_URL.'/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod='.$xoopsModule->getVar('mid')."'>"._AM_GENERALCONF."</a></b><br><br>\n";
echo '</td></tr></table>';
// 管理エリア用フッタ
xoops_cp_footer();
