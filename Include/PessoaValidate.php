<?php
  class PessoaValidate {
    public static function testarNome($paramNome) {
      if (trim(strlen($paramNome)) >= 6)
        return true;
      else
        return false;
    }
  }
