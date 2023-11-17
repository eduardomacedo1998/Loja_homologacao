<?php

class MercadoPago
{
    private $access_token;
    private $client_id;
    private $client_secret;

    public function __construct(string $access_token, string $client_id, string $client_secret)
    {
        $this->access_token = $access_token;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function getClientId(): string
    {
        return $this->client_id;
    }

    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    public function createPayment(PaymentData $payment_data): Payment
    {
        $request_options = new MPRequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

        return $this->getClient()->create($payment_data, $request_options);
    }

    public function getPayment(string $payment_id): Payment
    {
        return $this->getClient()->get($payment_id);
    }

    public function listPayments(MPSearchRequest $search_request): array
    {
        return $this->getClient()->search($search_request);
    }

    public function updatePayment(string $payment_id, PaymentData $payment_data): Payment
    {
        return $this->getClient()->update($payment_id, $payment_data);
    }

    public function cancelPayment(string $payment_id): Payment
    {
        return $this->getClient()->cancel($payment_id);
    }

    public function capturePayment(string $payment_id): Payment
    {
        return $this->getClient()->capture($payment_id);
    }

    public function refundPayment(string $payment_id, RefundData $refund_data): Refund
    {
        return $this->getClient()->refund($payment_id, $refund_data);
    }

    private function getClient(): PaymentClient
    {
        return new PaymentClient($this->access_token, $this->client_id, $this->client_secret);
    }
}
