<?php

/**
 * common functions
 *
 *
 * @author Katsuo Mogi mogi-k2@msg.biglobe.ne.jp
 * @since 1.0
 * @version $Id: functions.php,v 1.1 2004/03/21 02:21:42 mainpc Exp $
 * @param mixed $memberHandler
 * @param mixed $groupids
 */
/**
 * get users by multiple groups
 *
 * @param object $memberHandler memberhandler
 * @param array $groupids groupid
 * @return array belonging uids
 */
function users_by_multigroup($memberHandler, &$groupids)
{
    $intersectids = [];

    $foundids = $memberHandler->getUsersByGroup(array_shift($groupids));

    if ($groupids) {
        $retids = users_by_multigroup($memberHandler, $groupids);

        foreach ($retids as $id) {
            if (false !== array_search($id, $foundids, true)) {
                $intersectids[] = $id;
            }
        }

        return $intersectids;
        // array_intersect is PHP4.0.4 can't use
// return array_intersect(users_by_multigroup($memberHandler, $groupids), $foundids);
    }

    return $foundids;
}
