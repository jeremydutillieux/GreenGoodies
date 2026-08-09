<?php

namespace App\EventListener;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;

#[AsEventListener(event: CheckPassportEvent::class)]
final class CheckApiAccessListener
{

    public function __construct(
        private RequestStack $requestStack
    ) {}

    #[AsEventListener]
    public function __invoke(CheckPassportEvent $event): void
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request || !str_starts_with($request->getPathInfo(), '/api/login_check')) {
            return;
        }
       $passport = $event->getPassport();
        $user = $passport->getUser();

        if (!$user instanceof User) {
            return;
        }

        if (!$user->getApiAccessEnabled()) {
            throw new CustomUserMessageAuthenticationException('Accès API non activé. Merci de l\'activer depuis votre compte.');
        }
    }
}
