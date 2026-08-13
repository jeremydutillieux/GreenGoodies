<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class ApiAuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        if ($exception instanceof CustomUserMessageAuthenticationException 
            && $exception->getMessageKey() === 'api_access_disabled') {
            return new JsonResponse(
                ['message' => 'Accès API non activé.'],
                Response::HTTP_FORBIDDEN
            );
        }

        return new JsonResponse(
            ['message' => 'Identifiants incorrects.'],
            Response::HTTP_UNAUTHORIZED
        );
    }
}