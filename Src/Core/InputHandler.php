<?php

namespace Core;

class InputHandler
{
    private $input_command = [];

    public function getCommand(String $input_string)
    {
        $this->parseInput($input_string);
        return $this->input_command[0];
    }

    public function getArgument()
    {
        return $this->input_command[1];
    }

    private function parseInput(String $input_string) : Array
    {
        $this->input_command = explode(' -', $input_string);
        return $this->input_command;
    }
}
