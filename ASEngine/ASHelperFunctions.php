<?php

/**
 * Redirect to provided url
 * @param $url
 */
function redirect($url)
{
    $url = rtrim(SCRIPT_URL, '/') . '/' . ltrim($url, '/');

    if ( ! headers_sent() )
    {    
        header('Location: '.$url, TRUE, 302);
        exit;
    }
    else
    {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';
        exit;
    }
}

/**
 * Get page where user should be redirected, based on user's role.
 * If there is no specific page set for provided role, redirect to default page.
 *
 * @return string Page where user should be redirected.
 */
function get_redirect_page()
{
    $login = new ASLogin();

    if ( $login->isLoggedIn() )
    {
        $user = new ASUser(ASSession::get("user_id"));
        $role = $user->getRole();
    }
    else
        $role = 'default';

    $redirect = unserialize(SUCCESS_LOGIN_REDIRECT);

    if ( ! isset($redirect['default']) )
        $redirect['default'] = 'index.php';

    return isset($redirect[$role]) ? $redirect[$role] : $redirect['default'];
}


/**
 * Escape HTML entities in a string.
 *
 * @param  string  $value
 * @return string  Escaped string
 */
function e($value)
{
    return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
}
