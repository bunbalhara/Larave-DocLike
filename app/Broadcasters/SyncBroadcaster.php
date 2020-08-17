<?php


namespace App\Broadcasters;
use Illuminate\Broadcasting\Broadcasters\Broadcaster;
use Illuminate\Broadcasting\BroadcastException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Sync\V1\Service\SyncStream\StreamMessageInstance;
use Twilio\Rest\Sync\V1\ServiceContext;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SyncBroadcaster extends Broadcaster
{
    const TWILIO_EXCEPTION_NOT_FOUND = 20404;

    /**
     * @var ServiceContext
     */
    protected $sync;

    /**
     * Create a new broadcaster instance.
     *
     * @param ServiceContext $sync
     * @return void
     */
    public function __construct( ServiceContext $sync ) {
        $this->sync = $sync;
    }


    public function auth($request)
    {
        if (Str::startsWith($request->channel_name, ['private-', 'presence-']) &&
            ! $request->user()) {
            throw new AccessDeniedHttpException();
        }

        $channelName = Str::startsWith($request->channel_name, 'private-')
            ? Str::replaceFirst('private-', '', $request->channel_name)
            : Str::replaceFirst('presence-', '', $request->channel_name);

        return parent::verifyUserCanAccessChannel(
            $request, $channelName
        );
    }

    public function validAuthenticationResponse($request, $result)
    {
        if (Str::startsWith($request->channel_name, 'private')) {
            return ['success' => true];
        }

        return $result;
    }

    /**
     * Broadcast the given event.
     *
     * @param  array  $channels
     * @param  string  $event
     * @param  array  $payload
     * @return void
     */
    public function broadcast(array $channels, $event, array $payload = [])
    {
        $socket = Arr::pull($payload, 'socket');

        foreach($this->formatChannels($channels) as $channel) {
            try {
                $response = $this->sync
                    ->syncStreams($channel)
                    ->streamMessages
                    ->create([
                        'type' => $event,
                        'payload' => $payload,
                        'identity' => $socket,
                    ]);
                if ($response instanceof StreamMessageInstance) {
                    continue;
                }
            } catch (TwilioException $e) {
                if ($e->getCode() === self::TWILIO_EXCEPTION_NOT_FOUND) {
                    // Skip this broadcast because no listeners are available to receive the message
                    continue;
                }
                throw new BroadcastException('Failed to broadcast to Sync: ' . $e->getMessage());
            }
        }
    }

    /**
     * Get the Sync SDK instance.
     *
     * @return ServiceContext
     */
    public function getSync()
    {
        return $this->sync;
    }

}
