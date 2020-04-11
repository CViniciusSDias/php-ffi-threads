# Multithreading with FFI

## IMPORTANT

**This project is not intended to be used anywhere for real!** This is just something I made for fun and is not even close to be stable and probably never will.

## Description

This simple project consists in one single class: `Thread`. This class makes possible for us to create a threaded task, i.e., a task that will be executed in a separate thread.

To use it, just extend the `CViniciusSDias\ThreadsFFI\Thread` class and implement the `run` method.
This method must have the task's definition.

From the newly created instance, call the `start` method. This method will create a new thread and start the `run` code inside it.

An example is available in the `example.php` file.

## Syncronization

A `join` method is available so a task can be joined. Whenever an instance of `Thread` is unset, the thread created by it is joined (using the `__destruct` method).
 