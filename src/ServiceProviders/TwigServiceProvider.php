<?php
/**
 * MIT License
 *
 * Copyright (c) 2005-2016 TorrentPier
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace TorrentPier\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use TorrentPier\Twig\Loader\Filesystem;

/**
 * Class TwigServiceProvider
 * @package TorrentPier\ServiceProviders
 */
class TwigServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        $container['twig'] = function (Container $container) {
            $loader = new Filesystem($container['config.services.twig.dir_templates']);
            $twig = new \Twig_Environment($loader, [
                'debug' => $container['config.debug'],
                'cache' => $container['config.services.twig.dir_cache'],
            ]);

            $twig->addExtension(new TranslationExtension($container['translator']));
            $twig->addExtension(new \Twig_Extension_Debug());

            return $twig;
        };
    }
}
