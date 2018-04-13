#!../../bin/php/php7.1.9
<?php

require_once './Src/Controller.php';
require_once './Src/Core/InputHandler.php';

use Src\Controller;
use Core\InputHandler;

echo("Application has been started. Need help? Write 'help' \n");

try {

  $input_command = '';
  $parsed_command = '';
  $handler = new InputHandler();

  while($input_command !== 'quit') {
      $input_command = readline();
      $parsed_command = $handler->getCommand($input_command);

      switch($parsed_command) {
          case 'parse':
              Controller::parse($handler->getArgument());
              break;
          case 'report':
              Controller::report($handler->getArgument());
              break;
          case 'help':
              Controller::help();
              break;
          default:
              echo "Please, enter correct command \n";
              break;
      }
  }

} catch (Exception $e) {
    echo "\n Error: ". $e->getMessage() . "\n";
}
