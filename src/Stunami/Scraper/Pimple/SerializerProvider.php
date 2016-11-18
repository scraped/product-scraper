<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 17/11/2016
 * Time: 20:50
 */

namespace Stunami\Scraper\Pimple;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class SerializerProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['serializer'] = function ($c) {
            $serializer = new Serializer(
                [
                    new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter()),
                    new GetSetMethodNormalizer(),
                    new ArrayDenormalizer(),
                ],
                [new JsonEncode(JSON_PRETTY_PRINT)]
            );

            return $serializer;
        };
    }
}