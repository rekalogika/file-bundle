<?php

declare(strict_types=1);

/*
 * This file is part of rekalogika/file-src package.
 *
 * (c) Priyadi Iman Nurcahyo <https://rekalogika.dev>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

use Rekalogika\Contracts\File\FileRepositoryInterface;
use Rekalogika\File\Server\FileInterfaceResourceServer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services
        ->set('rekalogika.file.server.file_interface_resource_server')
        ->class(FileInterfaceResourceServer::class)
        ->tag('rekalogika.temporary_url.resource_server', [
            'method' => 'respond',
        ])
        ->tag('rekalogika.temporary_url.resource_transformer', [
            'method' => 'transform',
        ])
        ->args([
            service(FileRepositoryInterface::class),
        ]);
};
