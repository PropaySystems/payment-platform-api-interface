<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait BankBranch
{

    /**
     * Retrieves a list of bank branches based on filters and includes.
     *
     * This method fetches bank branches by applying the specified filters and includes.
     * It constructs a query string using the provided filters and includes, sets the API endpoint
     * to 'bank-branches', and specifies the request type as 'GET'. The method then executes the request
     * and returns the response. This can be used to obtain various bank branches available in the system,
     * potentially filtered or enhanced with additional related resources.
     *
     * @param array $filters Optional associative array of filters to apply to the query.
     * @param array $includes Optional array of related resources to include in the response.
     * @param string $version API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request.
     */
    public function getBranches(array $filters = [], array $includes = [], string $version = 'v1'): mixed
    {
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes])
        ]);
        $this->setEndpoint('bank-branches');
        $this->setRequestType('GET');
        return $this->execute();
    }

    /**
     * Retrieves a specific bank branch by ID with optional related resources.
     *
     * This method fetches a single bank branch by its unique identifier. It allows for the inclusion
     * of related resources through the `$includes` parameter to enrich the response data. The API version
     * can be specified to use a particular version of the endpoint. The method constructs a query string
     * with the includes, sets the appropriate API endpoint, and performs a GET request to fetch the data.
     *
     * @param string $id The unique identifier of the bank branch to retrieve.
     * @param array $includes Optional array of related resources to include in the response.
     * @param string $version The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object.
     */
    public function getBranch(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes])
        ]);
        $this->setEndpoint('bank-branches/show/' . $id);
        $this->setRequestType('GET');
        return $this->execute();
    }
}
