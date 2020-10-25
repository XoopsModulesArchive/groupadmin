<?php

/**
 * 管理エリア・グループ編集
 *
 * グループへの一括追加・削除
 *
 * @author Katsuo Mogi mogi-k2@msg.biglobe.ne.jp
 * @since 1.0
 * @version $Id: groupedit.php,v 1.2 2004/03/21 02:21:09 mainpc Exp $
 */
// 管理エリア用インクルードファイル
require dirname(__DIR__, 3) . '/include/cp_header.php';
require_once dirname(__DIR__) . '/include/functions.php';
$memberHandler = xoops_getHandler('member');
// 管理エリア用ヘッダ
xoops_cp_header();
$addgroup = (!empty($_POST['addgroup'])) ? $_POST['addgroup'] : [];
$userids = (!empty($_POST['userids'])) ? $_POST['userids'] : [];
$groups = (!empty($_POST['groups'])) ? $_POST['groups'] : [];
$limit = (!empty($_POST['limit'])) ? (int)$_POST['limit'] : 20;
$start = (!empty($_POST['start'])) ? (int)$_POST['start'] : 0;
$op = (!empty($_POST['op'])) ? $_POST['op'] : '';
$total = $memberHandler->getUserCount(new Criteria('level', 0, '>'));
$foundtotal = 0;
$curr_foundids_criteria = null;
$errorMsg = $foundusers = [];
$clsval = ['even', 'odd'];
$ignorePostVars = ['addgroup', 'userids'];
$hiddenform = '';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
$form = new XoopsThemeForm('-', 'searchform', 'groupedit.php');
$tray = new XoopsFormElementTray(_AM_SEARCHTITLE);
$groups_select = new XoopsFormSelectGroup(_AM_SEARCHGROUP, 'groups', false, $groups, 5, true);
$limit_text = new XoopsFormText(_AM_DISPPERPAGE, 'limit', 4, 4, $limit);
$submit_button = new XoopsFormButton('', '', _GO, 'submit');
$tray->addElement($groups_select);
$tray->addElement($limit_text);
$tray->addElement($submit_button);
$form->addElement($tray);
$grouplist = $groups_select->getOptions();
$groupidlist = array_keys($grouplist);
if ('update' == $op) {
    foreach ($groupidlist as $gid) {
        if (!$memberHandler->removeUsersFromGroup($gid, $userids)) {
            $errorMsg[] = sprintf(_AM_REMOVEERR, $grouplist[$gid]);

            continue;
        }

        if (!empty($addgroup[$gid])) {
            foreach ($addgroup[$gid] as $adduid) {
                if (!$memberHandler->addUserToGroup($gid, $adduid)) {
                    $userobj = $memberHandler->getUser($adduid);

                    $errorMsg[] = sprintf(_AM_ADDERR, ($userobj ? $userobj->getVar('uname') : $adduid), $grouplist[$gid]);

                    continue;
                }
            }
        }
    }
}
if ($foundids = users_by_multigroup($memberHandler, $groups)) {
    $curr_foundids_criteria = new Criteriacompo();

    foreach ($foundids as $id) {
        $curr_foundids_criteria->add(new Criteria('uid', $id), 'OR');
    }

    $curr_foundids_criteria->add(new Criteria('level', 0, '>'));

    $curr_foundids_criteria->setStart($start);

    $curr_foundids_criteria->setLimit($limit);

    $foundtotal = $memberHandler->getUserCount($curr_foundids_criteria);
}
echo '
<script type="text/javascript">
<!--
function groupChecking(iChkElem, iGroupId){
var max, i, flg;
var frm = document.updateform;
var elename;
elename = "addgroup[" + iGroupId + "][]";
if(frm.elements[elename]){
max = frm.elements[elename].length;
flg = iChkElem.checked;
if(max){
for(i = 0; i < max; i++)
frm.elements[elename][i].checked = flg;
}else{
frm.elements[elename].checked = flg;
}
}
}
//-->
</script>
';
foreach ($errorMsg as $msg) {
    echo '<font color="red">' . $msg . '</font><br>';
}
echo $form->display();
echo sprintf(_AM_COUNTMSG, $total, $foundtotal);
echo '<form name="updateform" action="groupedit.php" method="post">';
echo '<table class="outer" cellpadding="4" cellspacing="1"><tr align="center"><td></td>';
foreach ($grouplist as $gid => $groupname) {
    echo '<th>' . $groupname . '<br><input type="checkbox" onClick="groupChecking(this, ' . $gid . ')">';

    echo '</th>';
}
echo '</tr>';
$myts = MyTextSanitizer::getInstance();
foreach ($_POST as $k => $v) {
    if (false === array_search($k, $ignorePostVars, true)) {
        if (is_array($v)) {
            foreach ($v as $val) {
                $hiddenform .= "<input type='hidden' name='" . htmlspecialchars($k, ENT_QUOTES | ENT_HTML5) . "[]' value='" . htmlspecialchars($val, ENT_QUOTES | ENT_HTML5) . "'>\n";
            }
        } else {
            $hiddenform .= "<input type='hidden' name='" . htmlspecialchars($k, ENT_QUOTES | ENT_HTML5) . "' value='" . htmlspecialchars($v, ENT_QUOTES | ENT_HTML5) . "'>\n";
        }
    }
}
if (!isset($_POST['limit'])) {
    $hiddenform .= "<input type='hidden' name='limit' value='" . $limit . "'>\n";
}
if (!isset($_POST['start'])) {
    $hiddenform .= "<input type='hidden' name='start' value='" . $start . "'>\n";
}
if ($start < $foundtotal) {
    if (!empty($curr_foundids_criteria)) {
        $foundusers = $memberHandler->getUsers($curr_foundids_criteria, true);
    }

    foreach ($foundusers as $uid => $user) {
        $belongs = $user->getGroups();

        $cnt = 0;

        echo '<tr><td class="head">';

        echo $user->getVar('uname');

        echo '<input type="hidden" name="userids[]" value="' . $uid . '"></td>';

        foreach ($groupidlist as $groupid) {
            echo '<td align="center" class="' . $clsval[$cnt++ % 2] . '">';

            echo '<input type="checkbox" name="addgroup[' . $groupid . '][]" value="' . $uid . '"' . (false !== array_search($groupid, $belongs, true) ? ' checked' : '') . '>';

            echo '</td>';
        }

        echo '</tr>';
    }

    $totalpages = ceil($foundtotal / $limit);

    if ($totalpages > 1) {
        $prev = $start - $limit;

        if ($start - $limit >= 0) {
            $hiddenform .= "<a href='#0' onclick='javascript:document.updateform.start.value=" . $prev . ";document.updateform.submit();'>" . _AM_PREVIOUS . "</a>&nbsp;\n";
        }

        $counter = 1;

        $currentpage = ($start + $limit) / $limit;

        while ($counter <= $totalpages) {
            if ($counter == $currentpage) {
                $hiddenform .= '<b>' . $counter . '</b> ';
            } elseif (($counter > $currentpage - 4 && $counter < $currentpage + 4) || 1 == $counter || $counter == $totalpages) {
                if ($counter == $totalpages && $currentpage < $totalpages - 4) {
                    $hiddenform .= '... ';
                }

                $hiddenform .= "<a href='#" . $counter . "' onclick='javascript:document.updateform.start.value=" . ($counter - 1) * $limit . ";document.updateform.submit();'>" . $counter . '</a> ';

                if (1 == $counter && $currentpage > 5) {
                    $hiddenform .= '... ';
                }
            }

            $counter++;
        }

        $next = $start + $limit;

        if ($foundtotal > $next) {
            $hiddenform .= "&nbsp;<a href='#" . $foundtotal . "' onclick='javascript:document.updateform.start.value=" . $next . ";document.updateform.submit();'>" . _AM_NEXT . "</a>\n";
        }

        // $hiddenform .= "</form>";
    }
}
echo '<tr><td align="right" colspan="' . (count($grouplist) + 1) . '">';
if (!empty($curr_foundids_criteria)) {
    echo $hiddenform;
}
echo '　　　　　　　　　　<input type="submit" name="op" value="update">';
echo '</td></tr>';
echo '</table></form>';
// 管理エリア用フッタ
xoops_cp_footer();
