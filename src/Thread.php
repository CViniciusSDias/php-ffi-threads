<?php

namespace CViniciusSDias\ThreadsFFI;

use FFI;
use FFI\CData;

abstract class Thread
{
    protected FFI $ffi;
    protected CData $thread;

    public function __construct()
    {
        $this->ffi = FFI::cdef(
            "typedef uint64_t pthread_t;

            typedef struct {
                uint32_t flags;
                void * stack_base;
                size_t stack_size;
                size_t guard_size;
                int32_t sched_policy;
                int32_t sched_priority;
            } pthread_attr_t;
            
            typedef void *(*thread_func)(void *);
            
            int pthread_create(
            pthread_t *thread,
            const pthread_attr_t *attr,
            void *(*start_routine)(void *),
            void *arg
            );
            
            void* pthread_join(
            pthread_t thread,
            void **value_ptr
            );",
            "libpthread.so.0"
        );

        $this->thread = $this->ffi->new('pthread_t');
    }

    public function start(): void
    {
        $this->ffi->pthread_create(FFI::addr($this->thread), null, [$this, 'run'], null);
    }

    public function join(): void
    {
        $this->ffi->pthread_join($this->thread->cdata, null);
    }

    public function __destruct()
    {
        $this->join();
    }

    abstract protected function run(): void;
}
