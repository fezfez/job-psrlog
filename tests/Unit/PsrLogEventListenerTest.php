<?php

declare(strict_types=1);

namespace Fezfez\JobRunner\PsrLog\Tests\Unit\EventListener;

use Fezfez\JobRunner\Job\Job;
use Fezfez\JobRunner\PsrLog\PsrLogEventListener;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * @covers \Fezfez\JobRunner\PsrLog\PsrLogEventListener
 */
class PsrLogEventListenerTest extends TestCase
{
    public function testSuccess(): void
    {
        $logger = self::createMock(LoggerInterface::class);
        $job    = self::createMock(Job::class);

        $job->expects($this->once())->method('getName')->willReturn('myName');
        $logger->expects($this->once())->method('info')->with('job myName success : toto');

        $sUT = new PsrLogEventListener($logger);

        $sUT->success($job, 'toto');
    }

    public function testFail(): void
    {
        $logger = self::createMock(LoggerInterface::class);
        $job    = self::createMock(Job::class);

        $job->expects($this->once())->method('getName')->willReturn('myName');
        $logger->expects($this->once())->method('error')->with('job myName fail : toto');

        $sUT = new PsrLogEventListener($logger);

        $sUT->fail($job, 'toto');
    }

    public function testNotDue(): void
    {
        $logger = self::createMock(LoggerInterface::class);
        $job    = self::createMock(Job::class);

        $job->expects($this->once())->method('getName')->willReturn('myName');
        $logger->expects($this->once())->method('debug')->with('job myName notDue');

        $sUT = new PsrLogEventListener($logger);

        $sUT->notDue($job);
    }

    public function testIsLocked(): void
    {
        $logger = self::createMock(LoggerInterface::class);
        $job    = self::createMock(Job::class);

        $job->expects($this->once())->method('getName')->willReturn('myName');
        $logger->expects($this->once())->method('debug')->with('job myName isLocked');

        $sUT = new PsrLogEventListener($logger);

        $sUT->isLocked($job);
    }

    public function testStart(): void
    {
        $logger = self::createMock(LoggerInterface::class);
        $job    = self::createMock(Job::class);

        $job->expects($this->once())->method('getName')->willReturn('myName');
        $logger->expects($this->once())->method('debug')->with('job myName start');

        $sUT = new PsrLogEventListener($logger);

        $sUT->start($job);
    }
}
