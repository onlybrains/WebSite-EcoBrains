<?php

function onlyNumbers($value)
{
  if (!$value)
    return '';
  return $value = preg_replace("/[^0-9]/", "", $value);
}
