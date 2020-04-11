<?php

require_once 'vendor/autoload.php';

use CViniciusSDias\ThreadsFFI\Thread;

class ThreadedTask extends Thread
{
    public string $message;
    public int $threadId;

    public function __construct(int $threadId)
    {
        parent::__construct();
        $this->threadId = $threadId;
    }

    protected function run(): void
    {
        $this->message = "Thread {$this->threadId} generated the following number: " . rand(1, 100);
    }
}

$task1 = new ThreadedTask(1);
$task2 = new ThreadedTask(2);

$task1->start();
$task2->start();

$task1->join();
$task2->join();

echo "Numbers:\n\tTask 1: {$task1->message}\n\tTask 2: {$task2->message}\n";
