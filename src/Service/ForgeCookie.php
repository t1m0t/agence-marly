<?php

namespace App\Service;

use App\Entity\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

class ForgeCookie
{
    private $request = null;
    private $cookieDuration = [
        'qty' => 600,
        'unit' => 'seconds'
    ];
    private  $user;

    public function __construct(Request $request, array $cookieDuration, ?User $user = null)
    {
        $this->request = $request;
        $this->cookieDuration = $cookieDuration;
        $this->user = $user;
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
            ->withExpires(strtotime(Carbon::now()->add($this->cookieDuration['qty'], $this->cookieDuration['unit'])))
            ->withSameSite('strict')
            ->withHttpOnly(true)
            ->withSecure(true);
        return $cookie;
    }

    public function forgeAuthCookie(): Cookie
    {
        $session = $this->request->getSession();
        $session->set('X_AUTH_TOKEN', $this->randomString(128));
        $cookie = Cookie::create('X_AUTH_TOKEN')
            ->withValue($session->get('X_AUTH_TOKEN'))
            ->withExpires(strtotime(Carbon::now()->add($this->cookieDuration['qty'], $this->cookieDuration['unit'])))
            ->withSameSite('strict')
            ->withHttpOnly(true)
            ->withSecure(true);
        return $cookie;
    }

    public function AuthCookieWithRedirect($redirectURL)
    {
        $response = new RedirectResponse($redirectURL);
        $cookie = $this->forgeAuthCookie();
        $isLoggedInCookie = $this->forgeIsLoggedInCookie();
        $isAdminCookie = $this->forgeIsAdminCookie();
        $response->headers->setCookie($cookie);
        $response->headers->setCookie($isLoggedInCookie);
        $response->headers->setCookie($isAdminCookie);
        return $response;
    }

    private function randomString(int $n): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ./*-_&%?;';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    private function forgeIsLoggedInCookie()
    {
        $cookie = Cookie::create('IS_LOGGED_IN')
            ->withValue(true)
            ->withExpires(strtotime(Carbon::now()->add($this->cookieDuration['qty'], $this->cookieDuration['unit'])))
            ->withSameSite('strict')
            ->withHttpOnly(false)
            ->withSecure(true);
        return $cookie;
    }

    private function forgeIsAdminCookie()
    {
        $isAdmin = false;
        if (in_array('ROLE_ADMIN', $this->user->getRoles())) $isAdmin = true;
        $cookie = Cookie::create('IS_ADMIN')
            ->withValue($isAdmin)
            ->withExpires(strtotime(Carbon::now()->add($this->cookieDuration['qty'], $this->cookieDuration['unit'])))
            ->withSameSite('strict')
            ->withHttpOnly(false)
            ->withSecure(true);
        return $cookie;
    }
}
