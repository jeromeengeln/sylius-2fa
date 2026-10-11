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

use BitExpert\SyliusTwoFactorAuthPlugin\Grid\AdminUserGridListener;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set(AdminUserGridListener::class)
        ->public()
        ->tag('kernel.event_listener', ['event' => 'sylius.grid.admin_admin_user', 'method' => 'addField']);
};
