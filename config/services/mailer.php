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

use BitExpert\SyliusTwoFactorAuthPlugin\Mailer\SyliusAuthCodeMailer;
use BitExpert\SyliusTwoFactorAuthPlugin\Mailer\SyliusTwoFactorEnabledMailer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();
    $services->defaults()->private();

    $services->set(SyliusAuthCodeMailer::class)
        ->args([
            service('sylius.email_sender'),
            service('sylius.context.channel'),
            service('sylius.context.locale'),
        ]);

    $services->set(SyliusTwoFactorEnabledMailer::class)
        ->args([
            service('mailer'),
            service('sylius.context.channel'),
            service('sylius.context.locale'),
            service('logger'),
            service('twig'),
            service('translator'),
        ]);
};
