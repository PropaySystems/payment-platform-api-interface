<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait BankAccountType
{
    /**
     * Retrieves a list of bank account types based on filters and includes.
     *
     * This method fetches bank account types by applying the specified filters and includes.
     * It constructs a query string using the provided filters and includes, sets the API endpoint
     * to 'bank-account-types', and specifies the request type as 'GET'. The method then executes the request
     * and returns the response. This can be used to obtain various bank account types available in the system,
     * potentially filtered or enhanced with additional related resources.
     *
     * @param  array  $filters  Optional associative array of filters to apply to the query.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  string  $version  API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request.
     *
     * @throws \Exception
     */
    public function getBankAccountTypes(array $filters = [], array $includes = [], string $version = 'v1', $per_page = 15): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes, 'per-page' => $per_page]),
        ]);
        $this->setEndpoint('bank-account-types');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Retrieves a specific bank account type by ID with optional related resources.
     *
     * This method fetches a single bank account type by its unique identifier. It allows for the inclusion
     * of related resources through the `$includes` parameter to enrich the response data. The API version
     * can be specified to use a particular version of the endpoint. The method constructs a query string
     * with the includes, sets the appropriate API endpoint, and performs a GET request to fetch the data.
     *
     * @param  string  $id  The unique identifier of the bank account type to retrieve.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object.
     *
     * @throws \Exception
     */
    public function getBankAccountType(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes]),
        ]);
        $this->setEndpoint('bank-account-types/show/'.$id);
        $this->setRequestType('GET');

        return $this->execute();
    }
}
