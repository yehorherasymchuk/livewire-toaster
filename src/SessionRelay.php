<?php declare(strict_types=1);

namespace MAS\Toast;

use Illuminate\Contracts\Session\Session;

/** @internal */
final readonly class SessionRelay
{
    public const NAME = 'toasts';

    public function __construct(
        private Session $session,
        private Collector $toasts,
    ) {}

    public function handle(): void
    {
        if ($toasts = $this->toasts->flush()) {
            $this->session->put(self::NAME, $toasts);
        }
    }
}
