<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait AddressType
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
     * @param array $filters Optional associative array of filters to apply to the query.
     * @param array $includes Optional array of related resources to include in the response.
     * @param array $sort (Optional) An array of sorting options to apply to the contact retrieval.
     * @param string $version API version to use for the request, defaults to 'v1'.
     * @param int $per_page Number of results per page, defaults to 15.
     * @param int|null $page Page number to retrieve, defaults to null which is interpreted as the first page.
     * @return mixed The response from the API after executing the request.
     *
     * @throws \Exception
     */
    public function addressTypes(array $filters = [], array $includes = [], array $sort = [], string $version = 'v1', int $per_page = 15, ?int $page = null): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes, 'sort' => $sort, 'per-page' => $per_page, 'page' => $page ?? 1]),
        ]);
        $this->setEndpoint('address-types');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Retrieves a specific address type by ID with optional related resources.
     *
     * This method fetches a single address type by its unique identifier. It allows for the inclusion
     * of related resources through the `$includes` parameter to enrich the response data. The API version
     * can be specified to use a particular version of the endpoint. The method constructs a query string
     * with the includes, sets the appropriate API endpoint, and performs a GET request to fetch the data.
     *
     * @param string $id The unique identifier of the address type to retrieve.
     * @param array $includes Optional array of related resources to include in the response.
     * @param string $version The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object.
     *
     * @throws \Exception
     */
    public function addressType(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes]),
        ]);
        $this->setEndpoint('address-types/show/' . $id);
        $this->setRequestType('GET');

        return $this->execute();
    }
}
