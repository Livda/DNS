<?php

/*
 * This file is part of Badcow DNS Library.
 *
 * (c) Samuel Williams <sam@badcow.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Badcow\DNS\Ip;

use Badcow\DNS\DNSException;
use Badcow\DNS\Validator;

class Toolbox
{
    /**
     * Expands an IPv6 address to its full, non-short hand representation.
     *
     * @param $ip
     * @return string
     */
    public static function expandIpv6($ip)
    {
        $hex = unpack('H*hex', inet_pton($ip));
        $ip = substr(preg_replace('/([A-f0-9]{4})/', '$1:', $hex['hex']), 0, -1);

        return $ip;
    }

    /**
     * Creates a reverse IPv4 address.
     *
     * @param $ip
     *
     * @return string
     */
    public static function reverseIpv4($ip)
    {
        $parts = array_reverse(explode('.', $ip));

        $address = implode('.', $parts);
        $address .= '.in-addr.arpa.';

        return $address;
    }

    /**
     * Creates a reverse IPv6 address.
     *
     * @param string $ip
     *
     * @return string
     */
    public static function reverseIpv6($ip)
    {
        $ip = self::expandIpv6($ip);
        $ip = str_replace(':', '', $ip);
        $ip = strrev($ip);
        $address = implode('.', str_split($ip));
        $address .= '.ip6.arpa.';

        return $address;
    }
}
