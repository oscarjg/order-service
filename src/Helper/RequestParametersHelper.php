<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestParametersHelper
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Helper
 */
class RequestParametersHelper
{
    /**
     * @param Request $request
     * @param $key
     * @param null $defaultValue
     *
     * @return |null
     */
    public static function resolveContent(Request $request, $key, $defaultValue = null)
    {
        $content = json_decode($request->getContent(), true);

        return $content[$key] ?? $defaultValue;
    }
}