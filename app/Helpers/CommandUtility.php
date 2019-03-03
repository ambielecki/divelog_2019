<?php

namespace App\Helpers;

class CommandUtility {
    public static function runBackgroundCommand(string $command, array $options = [], ?string $log_file = null): void {
        $command_parts = [$command];

        if ($log_file === null) {
            $log_file = '/dev/null';
        }

        foreach ($options as $key => $value) {
            if (!is_numeric($key)) {
                $command_parts[] = $key;
            }

            $command_parts[] = $value;
        }

        $command = implode(' ', $command_parts);

        shell_exec("nohup $command >> $log_file 2>&1 &");
    }

    public static function killProcess(int $pid): void {
        if ($pid) {
            shell_exec("sudo kill -TERM $pid");
        }
    }
}