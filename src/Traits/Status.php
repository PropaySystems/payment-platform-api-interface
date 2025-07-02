<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait Status
{
    /**
     * Retrieves a list of address types based on filters and includes.
     *
     * This method fetches address types by applying the specified filters and includes.
     * It constructs a query string using the provided filters and includes, sets the API endpoint
     * to 'address-types', and specifies the request type as 'GET'. The method then executes the request
     * and returns the response. This can be used to obtain various address types available in the system,
     * potentially filtered or enhanced with additional related resources.
     *
     * @param string $version API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request.
     *
     * @throws \Exception
     */
    public function statuses(string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query([]),
        ]);
        $this->setEndpoint('statuses');
        $this->setRequestType('GET');

        return $this->execute();
    }
}
