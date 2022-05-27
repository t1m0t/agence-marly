<?php

namespace App\Service;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\HttpFoundation\Response;


class ForgeCookie
{
    private $request = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function CSRFWithRedirect(string $redirectURL): RedirectResponse
    {
        $response = new RedirectResponse($redirectURL);
        $cookie = $this->forgeCSRFCookie();
        $response->headers->setCookie($cookie);
        return $response;
    }

    public function forgeCSRFCookie(): Cookie
    {
        $session = $this->request->getSession();

        $csrf_manager = new CsrfTokenManager();
        $session->set('X_CSRF_TOKEN', $csrf_manager->getToken('X_CSRF_TOKEN'));
        $cookie = Cookie::create('X_CSRF_TOKEN')
            ->withValue($session->get('X_CSRF_TOKEN'))
            ->withExpires(strtotime(Carbon::now()->add(2, 'hour')))
            ->withSameSite('strict')
            ->withHttpOnly(true)
            ->withSecure(true);
        return $cookie;
    }

    public function forgeAuthCookie(): Cookie
    {
        $session = $this->request->getSession();

        $session->set('X_AUTH_TOKEN', random_bytes(128));
        $cookie = Cookie::create('X_AUTH_TOKEN')
            ->withValue($session->get('X_AUTH_TOKEN'))
            ->withExpires(strtotime(Carbon::now()->add(1, 'hour')))
            ->withSameSite('strict')
            ->withHttpOnly(true)
            ->withSecure(true);
        return $cookie;
    }

    public function AuthCookieWithRedirect($redirectURL)
    {
        $response = new RedirectResponse($redirectURL);
        $cookie = $this->forgeAuthCookie();
        $response->headers->setCookie($cookie);
        return $response;
    }
}
