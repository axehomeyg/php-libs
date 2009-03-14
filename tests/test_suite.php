<?php
  # Pear/phpunit?? nah, don't think so, for various reasons.
  class TestSuite {
    var $assertions = array();
    var $temp_server_name;

    // ================
    // = Test Helpers =
    // ================
    function set_server_name($name) {
      $this->temp_server_name = $_SERVER['SERVER_NAME'];
      $_SERVER['SERVER_NAME'] = $name;
    }

    function unset_server_name() {
      $_SERVER['SERVER_NAME'] = $this->temp_server_name;
    }
    // ===============================
    // = Core Testing Framework Code =
    // ===============================
    function run($test) {
      try {
        $this->$test();
        return true;
      }
      catch(Exception $e) {
        echo("Exception for test '$test': $e\n");
        return false;
      }
    }
    static function run_all() {
      $object = new TestSuite;
      $results = array();
      $start_time = time();
      $success = true;
      foreach(get_class_methods($object)  as $method_name) {
        if(preg_match("/^test_/", $method_name)) {
          $results[] = $method_name;
          if(!$object->run($method_name)) {
            $success = false;
          }
        }
      }
      $end_time = time();
      if(!$success) { echo "TEST FAILURE!!!\n";}
      echo count($object->assertions) . " assertion(s)\n";
      echo count($results) . " tests: " . ($end_time - $start_time) . " second run time\n";
    }
    private
    
    function t_assert_equals($item1, $item2, $message = null) {
      if(!$message) {$message = print_r($item1, true) . " does not equal " . print_r($item2, true) . "\n";}
      return $this->t_assert($item1 == $item2, $message);
    }
    function t_assert($boolean, $message = "False is not true") {
      $this->assertions[] = $boolean;
      if(!$boolean) {
         throw new Exception($message);
      }
    }    
  }

?>
