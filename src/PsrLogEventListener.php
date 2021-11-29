<?php

declare(strict_types=1);

namespace Fezfez\JobRunner\PsrLog;

use Fezfez\JobRunner\Event\JobEvent;
use Fezfez\JobRunner\Event\JobFailEvent;
use Fezfez\JobRunner\Event\JobIsLockedEvent;
use Fezfez\JobRunner\Event\JobNotDueEvent;
use Fezfez\JobRunner\Event\JobStartEvent;
use Fezfez\JobRunner\Event\JobSuccessEvent;
use Fezfez\JobRunner\Job\Job;
use Psr\Log\LoggerInterface;

use function sprintf;

final class PsrLogEventListener implements JobEvent, JobFailEvent, JobSuccessEvent, JobStartEvent, JobNotDueEvent, JobIsLockedEvent
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function fail(Job $job, string $output): void
    {
        $this->logger->error(sprintf('job %s fail : %s', $job->getName(), $output));
    }

    public function success(Job $job, string $output): void
    {
        $this->logger->info(sprintf('job %s success : %s', $job->getName(), $output));
    }

    public function start(Job $job): void
    {
        $this->logger->debug(sprintf('job %s start', $job->getName()));
    }

    public function notDue(Job $job): void
    {
        $this->logger->debug(sprintf('job %s notDue', $job->getName()));
    }

    public function isLocked(Job $job): void
    {
        $this->logger->debug(sprintf('job %s isLocked', $job->getName()));
    }
}
