<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait Auth
{
    /**
     * Verifies customer data through the CDV (Customer Data Verification) process.
     *
     * This method submits customer data for verification using the CDV process. It allows for the specification
     * of an API version and accepts an array of data to be verified. The method constructs a request with the
     * provided data, sets the appropriate API endpoint for CDV verification, and performs a POST request.
     * The response from the API, indicating the success or failure of the verification, is then returned.
     *
     * @param array $data Optional associative array of customer data to verify.
     * @param string $version The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request.
     */
    public function login(array $data = [], string $version = 'v1'): mixed
    {
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('auth/login');
        $this->setRequestType('POST');

        return $this->execute();
    }
}
