<?php
function auth($login, $passwd) {
	if (!$passwd || !$login)
		return FALSE;
	$accounts = unserialize(file_get_contents('../private/passwd'));
	$passwd = hash ('whirlpool', $passwd);
	if ($accounts) {
		foreach ($accounts as $key => $val) {
			if ($val['login'] === $login && $val['passwd'] === $passwd)
				return TRUE;
		}
	}
	return FALSE;
}
