<?php

  // is_blank('abcd')
  function is_blank($value='') {
    if($value === '') {
      return true;
    } else {
      return false;
    }
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    if(strlen($value) >= $options['min'] && strlen($value) <= $options['max']) {
      return true;
    } else {
      return false;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    $email = explode('@', $value);
    $front = $email[0];
    $back = $email[1];
    $backsplit = explode('.', $back);
    if(sizeof($email) < 2) {
      return false;
    } else if(sizeof($backsplit) < 2) {
      return false;
    } else if(sizeof($email) + sizeof($backsplit) == 4) {
      return true;
    } else {
      return false;
    }
  }

?>
