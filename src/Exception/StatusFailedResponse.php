<?php
namespace Promopult\TikTokMarketingApi\Exception;

class StatusFailedResponse extends \RuntimeException
{
    /**
     * @var string
     */
    private $taskId;

    /**
     * StatusFailedResponse constructor.
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string $message
     * @param int $code
     * @param string $taskId
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $taskId,
        string $message = 'The asynch report status failed.',
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->taskId = $taskId;
    }

    /**
     * @return string
     */
    public function getTaskId(): string
    {
        return $this->taskId;
    }

    /**
     * @param string $taskId
     * @return StatusFailedResponse
     */
    public function setTaskId(string $taskId): StatusFailedResponse
    {
        $this->taskId = $taskId;
        return $this;
    }
}
