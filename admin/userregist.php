<?php

/**
 * 管理エリア・ユーザ一括登録
 *
 * ユーザ一括登録
 *
 * @author Katsuo Mogi mogi-k2@msg.biglobe.ne.jp
 * @since 1.0
 * @version $Id: userregist.php,v 1.4 2004/04/25 10:19:35 mainpc Exp $
 */
// 管理エリア用インクルードファイル
require dirname(__DIR__, 3) . '/include/cp_header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
foreach (['groups', 'use_optionfields', 'field_defaults'] as $varname) {
    ${$varname} = $_POST[$varname] ?? [];
}
foreach (['submit'] as $varname) {
    ${$varname} = $_POST[$varname] ?? '';
}
foreach (['op'] as $varname) {
    ${$varname} = $_GET[$varname] ?? '';
}
foreach (['csv'] as $varname) {
    ${$varname} = $HTTP_POST_FILES[$varname] ?? '';
}
// var_dump($xoopsConfig);
$errorMsg = [];
$skipFlag = false;
$row = 1;
$option_fields = ['rank'];
$use_fields = ['name', 'uname', 'pass', 'email', 'user_from', 'user_occ', 'bio', 'user_intrest'];
$ranklist = XoopsLists::getUserRankList();
if ('regist' == $op) {
    if (empty($groups)) {
        $errorMsg[] = sprintf(_AM_GROUPEMPTYERR, _AM_ADDGROUP);
    }

    if (empty($errorMsg) && is_uploaded_file($csv['tmp_name'])) {
        $rankfliplist = array_flip($ranklist);

        if ($use_optionfields) {
            $use_fields = array_merge($use_fields, array_intersect($option_fields, $use_optionfields));
        }

        /* var_dump($field_defaults);
        var_dump($use_fields);
        exit();
        */

        $memberHandler = xoops_getHandler('member');

        $fp = fopen($csv['tmp_name'], 'rb');

        if (function_exists('mb_internal_encoding')) {
            $interenc = mb_internal_encoding();
        }

        while ($cols = fgetcsv($fp, 2000, ',')) {
            if (function_exists('mb_convert_variables')) {
                mb_convert_variables($interenc, 'ASCII,UTF-8,SJIS,EUC-JP', $cols);
            }

            $criteriacompo = new Criteriacompo(new Criteria('uname', $cols[array_search('uname', $use_fields, true)]));

            $criteriacompo->add(new Criteria('email', $cols[array_search('email', $use_fields, true)]), 'OR');

            if ($memberHandler->getUserCount($criteriacompo) > 0) {
                $errorMsg[] = sprintf(
                    _AM_EXISTSERR,
                    $cols[array_search('uname', $use_fields, true)],
                    $cols[array_search('email', $use_fields, true)],
                    $row
                );
            } else {
                /*
                var_dump($use_fields);
                var_dump($cols);
                exit();
                */

                if (count($use_fields) > count($cols)) {
                    $errorMsg[] = sprintf(_AM_FIELDFEWERR, $row);

                    $skipFlag = true;
                } else {
                    $newuser = $memberHandler->createUser();

                    for ($cnt = 0, $cntMax = count($use_fields); $cnt < $cntMax; $cnt++) {
                        $tmpval = $cols[$cnt];

                        switch ($use_fields[$cnt]) {
case 'pass':
$tmpval = md5($tmpval);
break;
case 'rank':
$tmpval = (!empty($tmpval) ? $tmpval : @$ranklist[@$field_defaults['rank']]);
if (empty($rankfliplist[$tmpval])) {
    $errorMsg[] = sprintf(_AM_RANKNOTFOUNDERR, $tmpval, $row);

    $skipFlag = true;
} else {
    $tmpval = $rankfliplist[$tmpval];
}
break;
default:
$tmpval = (!empty($tmpval) ? $tmpval : @$field_defaults[$use_fields[$cnt]]);
break;
}

                        $newuser->setVar($use_fields[$cnt], $tmpval);
                    }
                }

                if ($skipFlag) {
                    $skipFlag = false;
                } else {
                    $newuser->setVar('level', 1);

                    $newuser->setVar('user_mailok', 0);

                    $newuser->setVar('user_regdate', time());

                    $newuser->setVar('user_avatar', 'blank.gif');

                    $newuser->setVar('timezone_offset', $xoopsConfig['default_TZ']);

                    $newuser->setVar('umode', $xoopsConfig['com_mode']);

                    $newuser->setVar('uorder', $xoopsConfig['com_order']);

                    if (!$memberHandler->insertUser($newuser)) {
                        $errorMsg[] = sprintf(_AM_ADDUSERERR, $cols[array_search('uname', $use_fields, true)], $row);

                        $errorMsg = array_merge($errorMsg, $newuser->getErrors());
                    } else {
                        $uid = $newuser->getVar('uid');

                        foreach ($groups as $group) {
                            if (!$memberHandler->addUserToGroup($group, $uid)) {
                                $grouplist = $memberHandler->getGroupList();

                                $errorMsg[] = sprintf(
                                    _AM_GROUPADDERR,
                                    ($grouplist ? $grouplist[$group] : $group),
                                    $cols[array_search('uname', $use_fields, true)],
                                    $row
                                );
                            }
                        }
                    }
                }
            }

            $row++;
        }

        fclose($fp);
    }

    if (empty($errorMsg)) {
        redirect_header('index.php', 3, _AM_DBUPDATED);

        exit();
    }
}
// 管理エリア用ヘッダ
xoops_cp_header();
foreach ($errorMsg as $msg) {
    echo '<font color="red">' . $msg . '</font><br>';
}
echo "<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
$groups_select = new XoopsFormSelectGroup(_AM_ADDGROUP, 'groups', false, $groups, 5, true);
$fields_tray = new XoopsFormElementTray(_AM_USECOL, '<br>');
$name_label = new XoopsFormLabel(_AM_NAME);
$uname_label = new XoopsFormLabel(_AM_UNAME);
$pass_label = new XoopsFormLabel(_AM_PASS);
$email_label = new XoopsFormLabel(_AM_EMAIL);
$ufrom_label = new XoopsFormLabel(_AM_UFROM);
$uocc_label = new XoopsFormLabel(_AM_UOCC);
$bio_label = new XoopsFormLabel(_AM_BIO);
$uintr_label = new XoopsFormLabel(_AM_UINTR);
$rank_tray = new XoopsFormElementTray('', ' | ');
$rank_cbox = new XoopsFormCheckBox('', 'use_optionfields[rank]', (empty($submit) ? 'rank' : @$use_optionfields['rank']));
$rank_cbox->addOption('rank', _AM_RANK);
$rank_select = new XoopsFormSelect(_AM_DEFAULTLABEL, 'field_defaults[rank]', (empty($field_defaults['rank']) ? 0 : $field_defaults['rank']));
$rank_tray->addElement($rank_cbox);
$rank_tray->addElement($rank_select);
if (count($ranklist) > 0) {
    $rank_select->addOption(0, _AM_NSRA);

    $rank_select->addOption(0, '--------------');

    $rank_select->addOptionArray($ranklist);
} else {
    $rank_select->addOption(0, _AM_NSRID);
}
$fields_tray->addElement($name_label);
$fields_tray->addElement($uname_label);
$fields_tray->addElement($pass_label);
$fields_tray->addElement($email_label);
$fields_tray->addElement($ufrom_label);
$fields_tray->addElement($uocc_label);
$fields_tray->addElement($bio_label);
$fields_tray->addElement($uintr_label);
$fields_tray->addElement($rank_tray);
//$crypt_radio = new XoopsFormRadioYN(_AM_DOCRYPT, "crypt");
$csv_file = new XoopsFormFile(_AM_CSV, 'csv', 100000);
$form = new XoopsThemeForm(_AM_USERREGIST, 'createform', 'userregist.php?op=regist');
$form->setExtra('enctype="multipart/form-data"');
$submit_button = new XoopsFormButton('', 'submit', _GO, 'submit');
$form->addElement($groups_select);
$form->addElement($fields_tray);
$form->addElement($csv_file);
$form->addElement($submit_button);
//$form->setRequired($groups_select);
$form->display();
echo '</td></tr></table>';
// 管理エリア用フッタ
xoops_cp_footer();
