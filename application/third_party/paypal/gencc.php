<?php
/*
  PHP credit card number generator
  Copyright (C) 2006 Graham King graham@darkcoding.net

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

$visaPrefixList[] = "4539";
$visaPrefixList[] = "4556";
$visaPrefixList[] = "4916";
$visaPrefixList[] = "4532";
$visaPrefixList[] = "4929";
$visaPrefixList[] = "40240071";
$visaPrefixList[] = "4485";
$visaPrefixList[] = "4716";
$visaPrefixList[] = "4";

$mastercardPrefixList[] = "51";
$mastercardPrefixList[] = "52";
$mastercardPrefixList[] = "53";
$mastercardPrefixList[] = "54";
$mastercardPrefixList[] = "55";

$amexPrefixList[] = "34";
$amexPrefixList[] = "37";

$discoverPrefixList[] = "6011";

$dinersPrefixList[] = "300";
$dinersPrefixList[] = "301";
$dinersPrefixList[] = "302";
$dinersPrefixList[] = "303";
$dinersPrefixList[] = "36";
$dinersPrefixList[] = "38";

$enRoutePrefixList[] = "2014";
$enRoutePrefixList[] = "2149";

$jcbPrefixList16[] = "3088";
$jcbPrefixList16[] = "3096";
$jcbPrefixList16[] = "3112";
$jcbPrefixList16[] = "3158";
$jcbPrefixList16[] = "3337";
$jcbPrefixList16[] = "3528";

$jcbPrefixList15[] = "2100";
$jcbPrefixList15[] = "1800";

$voyagerPrefixList[] = "8699";

/*
  'prefix' is the start of the CC number as a string, any number of digits.
  'length' is the length of the CC number to generate. Typically 13 or 16
 */

function completed_number($prefix, $length)
{

  $ccnumber = $prefix;

  # generate digits

  while (strlen($ccnumber) < ($length - 1)) {
    $ccnumber .= rand(0, 9);
  }

  # Calculate sum

  $sum = 0;
  $pos = 0;

  $reversedCCnumber = strrev($ccnumber);

  while ($pos < $length - 1) {

    $odd = $reversedCCnumber[$pos] * 2;
    if ($odd > 9) {
      $odd -= 9;
    }

    $sum += $odd;

    if ($pos != ($length - 2)) {

      $sum += $reversedCCnumber[$pos + 1];
    }
    $pos += 2;
  }

  # Calculate check digit

  $checkdigit = (( floor($sum / 10) + 1) * 10 - $sum) % 10;
  $ccnumber .= $checkdigit;

  return $ccnumber;
}

function credit_card_number($prefixList, $length, $howMany)
{

  for ($i = 0; $i < $howMany; $i++) {

    $ccnumber = $prefixList[array_rand($prefixList)];
    $result[] = completed_number($ccnumber, $length);
  }

  return $result;
}

function output($title, $numbers)
{

  $result[] = "<div class='creditCardNumbers'>";
  $result[] = "<h3>$title</h3>";
  $result[] = implode('<br />', $numbers);
  $result[] = '</div>';

  return implode('<br />', $result);
}

?>
