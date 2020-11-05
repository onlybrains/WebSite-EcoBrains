<?php

function onlyNumbers($value)
{
  if (!$value)
    return '';
  return $value = preg_replace("/[^0-9]/", "", $value);
}


function mask($val, $mask)
{
  $maskared = '';
  $k = 0;
  for ($i = 0; $i <= strlen($mask) - 1; $i++) {
    if ($mask[$i] == '#') {
      if (isset($val[$k])) $maskared .= $val[$k++];
    } else {
      if (isset($mask[$i])) $maskared .= $mask[$i];
    }
  }
  return $maskared;
}
