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
     * @param  array  $data  Optional associative array of customer data to verify.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request.
     */
    public function login(array $data = [], string $version = 'v1'): mixed
    {
        $this->setData([
            'json' => $data,
        ]);
        $this->setEndpoint($version.'/auth/login');
        $this->setRequestType('POST');

        return $this->execute();
    }

    /**
     * Retrieves the details of the authenticated user.
     *
     * This method sends a GET request to fetch the details of the currently authenticated user.
     * The API version can be specified to target a particular version of the endpoint.
     * It initializes the request, sets the endpoint, and executes the request.
     *
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object containing user details.
     *
     * @throws \Exception If an error occurs during the request execution.
     */
    public function user(string $version = 'v1'): mixed
    {
        $this->setVersion($version);
        $this->init();
        $this->setEndpoint('users/show');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Initializes the connection object.
     *
     * This method initializes the connection object and returns the current instance.
     * It can be used to set up the connection before performing further operations.
     * The API version can be specified, although it is not utilized in this method.
     *
     * @param  string  $version  The API version to use for the connection, defaults to 'v1'.
     * @return $this The current instance of the class.
     *
     * @throws \Exception
     */
    public function connection(string $version = 'v1'): mixed
    {
        $this->init();

        return $this;
    }
}
