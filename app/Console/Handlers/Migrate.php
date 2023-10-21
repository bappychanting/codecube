<?php

namespace App\Console\Handlers;

use Base\Migration; 
use Base\BaseConsole; 

class Migrate extends BaseConsole
{
  public function handle()
  {
    Migration::executeQueries($this->args[2]??'', glob("database/*.php"));
  }
}

?>
