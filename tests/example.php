<?php
  require "test_suite.php";


  class ExampleSuite extends TestSuite {
    function test_example_one() {
      $a = "value1";
      $this->t_assert(strlen($a) == 6);
    }
    function test_example_two() {
      $a = "value1";
      $b = "value2";
      $this->t_assert_equal($a, $b);
    }

  } 
  ExampleSuite::run_all();

?>
