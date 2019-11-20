<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

use App\Config\Settings;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigEngine
{

    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(Settings::get("TEMPLATE_DIR"));
        $this->twig = new Environment($loader);
    }

    public function render($template, $data = [])
    {
        return $this->twig->render($template, $data);
    }
}

