<?php

/**
 * ¥â¥¸¥å¡¼¥ë¸À¸ìÄêµÁ´ÉÍý²èÌÌÍÑ¥Õ¥¡¥¤¥ë
 *
 * ´ÉÍý²èÌÌ¤Ç»ÈÍÑ¤¹¤ëÊ¸»úÎó¤ÎÄêµÁ
 *
 * @author Katsuo Mogi mogi-k2@msg.biglobe.ne.jp
 * @since 1.0
 * @version $Id: admin.php,v 1.5 2004/04/25 10:07:45 mainpc Exp $
 */
define('_AM_CONFIG', '¥°¥ë¡¼¥×´ÉÍý');
define('_AM_GENERALCONF', '°ìÈÌÀßÄê');
define('_AM_GROUPEDIT', '¥°¥ë¡¼¥×¤ØÄÉ²Ã¡¦ºï½ü');
define('_AM_USERREGIST', '¥æ¡¼¥¶°ì³çÅÐÏ¿');
/*********** userregist.php ***********/
define('_AM_ADDGROUP', 'ÄÉ²Ã¥°¥ë¡¼¥×');
define('_AM_USECOL', 'CSV»ÈÍÑ¹àÌÜ');
define('_AM_NAME', 'Ì¾Á°');
define('_AM_UNAME', '¥æ¡¼¥¶Ì¾');
define('_AM_PASS', '¥Ñ¥¹¥ï¡¼¥É');
define('_AM_EMAIL', '¥á¡¼¥ë¥¢¥É¥ì¥¹');
define('_AM_UFROM', 'µï½»ÃÏ');
define('_AM_UOCC', '¿¦¶È');
define('_AM_BIO', '¤½¤ÎÂ¾');
define('_AM_UINTR', '¼ñÌ£');
define('_AM_RANK', '¥é¥ó¥¯');
define('_AM_DEFAULTLABEL', '¥Ç¥Õ¥©¥ë¥ÈÃÍ¡§');
define('_AM_CSV', '¿·µ¬¥æ¡¼¥¶¥Õ¥¡¥¤¥ë');
define('_AM_NSRA', 'ÆÃÊÌ¥é¥ó¥¯¤ÏÀßÄê¤µ¤ì¤Æ¤¤¤Þ¤»¤ó');
define('_AM_NSRID', 'ÆÃÊÌ¥é¥ó¥¯¤ÎÀßÄê¤¬¤¢¤ê¤Þ¤»¤ó');
define('_AM_DBUPDATED', '¥Ç¡¼¥¿¥Ù¡¼¥¹¤ò¹¹¿·¤·¤Þ¤·¤¿');
define('_AM_GROUPEMPTYERR', '%s¤¬ÁªÂò¤µ¤ì¤Æ¤¤¤Þ¤»¤ó');
define('_AM_ADDUSERERR', '¥æ¡¼¥¶%s¤ÎÄÉ²Ã¤Ë¼ºÇÔ¤·¤Þ¤·¤¿ CSV¥Õ¥¡¥¤¥ë%u¹Ô(·ï)ÌÜ');
define('_AM_GROUPADDERR', '%s¥°¥ë¡¼¥×¤Ø¥æ¡¼¥¶%s¤òÄÉ²Ã½ÐÍè¤Þ¤»¤ó¤Ç¤·¤¿ CSV¥Õ¥¡¥¤¥ë%u¹Ô(·ï)ÌÜ');
define('_AM_EXISTSERR', '¥æ¡¼¥¶Ì¾%s¤Þ¤¿¤Ï¥á¡¼¥ë¥¢¥É¥ì¥¹%s¤Ï´û¤ËÂ¸ºß¤·¤Æ¤¤¤Þ¤¹ CSV¥Õ¥¡¥¤¥ë%u¹Ô(·ï)ÌÜ');
define('_AM_FIELDFEWERR', '¥Õ¥£¡¼¥ë¥É¿ô¤¬Â­¤ê¤Þ¤»¤ó CSV¥Õ¥¡¥¤¥ë%u¹Ô(·ï)ÌÜ');
define('_AM_RANKNOTFOUNDERR', '»ÈÍÑ¤Ç¤­¤Ê¤¤¥é¥ó¥¯ %s ¤¬»ØÄê¤µ¤ì¤Þ¤·¤¿ CSV¥Õ¥¡¥¤¥ë%u¹Ô(·ï)ÌÜ');
/*********** groupedit.php ***********/
define('_AM_SEARCHTITLE', 'É½¼¨¾ò·ï');
define('_AM_SEARCHGROUP', 'Â°¤¹¤ë¥°¥ë¡¼¥×');
define('_AM_DISPPERPAGE', 'É½¼¨·ï¿ô');
define('_AM_PREVIOUS', 'Á°');
define('_AM_NEXT', '¼¡');
define('_AM_COUNTMSG', '%u¿Í¤Î¥æ¡¼¥¶Ãæ %d¿Í¤Î¥æ¡¼¥¶¤¬¸«¤Ä¤«¤ê¤Þ¤·¤¿');
define('_AM_REMOVEERR', '%s¥°¥ë¡¼¥×¤«¤é¤Îºï½ü¤Ë¼ºÇÔ¤·¤Þ¤·¤¿');
define('_AM_ADDERR', '¥æ¡¼¥¶%s¤ò%s¥°¥ë¡¼¥×¤ØÄÉ²Ã¤Ç¤­¤Þ¤»¤ó¤Ç¤·¤¿');
