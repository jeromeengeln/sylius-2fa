<?php

/*
 * This file is part of the Sylius 2FA Auth package.
 *
 * (c) bitExpert AG
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use BitExpert\SyliusTwoFactorAuthPlugin\Form\DataTransformer\VerificationCodeTransformer;
use BitExpert\SyliusTwoFactorAuthPlugin\Form\Renderer\FirewallAwareFormRenderer;
use BitExpert\SyliusTwoFactorAuthPlugin\Form\Type\VerificationCodeType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();
    $services->defaults()->private();

    $services->set(VerificationCodeTransformer::class);

    $services->set(VerificationCodeType::class)
        ->args([service(VerificationCodeTransformer::class)])
        ->tag('form.type');

    $services->set(FirewallAwareFormRenderer::class)
        ->args([
            service('twig'),
            service('security.firewall.map'),
            '@BitExpertSyliusTwoFactorAuthPlugin/admin/security/two_factor.html.twig',
            '@BitExpertSyliusTwoFactorAuthPlugin/shop/security/two_factor.html.twig',
        ]);
};
