<?php
/**
 * Local cache of process
 *
 * @package axy\scahce-local
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 * @license https://github.com/axypro/scahce-local/blob/master/LICENSE MIT
 * @link https://github.com/axypro/scache-local repository
 * @link https://packagist.org/packages/axy/scache-local composer package
 * @uses PHP7.1+
 */

declare(strict_types=1);

namespace axy\scache\local;

if (!is_file(__DIR__.'/vendor/autoload.php')) {
    throw new \LogicException('Please: composer install');
}

require_once(__DIR__.'/vendor/autoload.php');
