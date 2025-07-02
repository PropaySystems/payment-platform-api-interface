<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait Bank
{
    /**
     * Retrieves a list of banks based on filters and includes.
     *
     * This method fetches banks by applying the specified filters and includes.
     * It constructs a query string using the provided filters and includes, sets the API endpoint
     * to 'banks', and specifies the request type as 'GET'. The method then executes the request
     * and returns the response. This can be used to obtain various banks available in the system,
     * potentially filtered or enhanced with additional related resources.
     *
     * @param  array  $filters  Optional associative array of filters to apply to the query.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  array  $sort  (Optional) An array of sorting options to apply to the contact retrieval.
     * @param  string  $version  API version to use for the request, defaults to 'v1'.
     * @param  int  $per_page  Number of results per page, defaults to 15.
     * @param  int|null  $page  Page number to retrieve, defaults to null which is interpreted as the first page.
     * @return mixed The response from the API after executing the request.
     *
     * @throws \Exception
     */
    public function banks(array $filters = [], array $includes = [], array $sort = [], string $version = 'v1', int $per_page = 15, ?int $page = null): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes, 'sort' => $sort, 'per-page' => $per_page, 'page' => $page ?? 1]),
        ]);
        $this->setEndpoint('banks');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Retrieves a specific bank by ID with optional related resources.
     *
     * This method fetches a single bank by its unique identifier. It allows for the inclusion
     * of related resources through the `$includes` parameter to enrich the response data. The API version
     * can be specified to use a particular version of the endpoint. The method constructs a query string
     * with the includes, sets the appropriate API endpoint, and performs a GET request to fetch the data.
     *
     * @param  string  $id  The unique identifier of the bank to retrieve.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object.
     *
     * @throws \Exception
     */
    public function bank(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes]),
        ]);
        $this->setEndpoint('banks/show/'.$id);
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Updates a specific bank by ID.
     *
     * This method allows for updating the details of a specific bank identified by its unique ID.
     * It sends a PUT request to the specified endpoint with the updated data. The API version can be specified,
     * allowing for flexibility with different API versions. The method constructs the request with the provided
     * data as form parameters and executes the request.
     *
     * @param  string  $id  The unique identifier of the bank to update.
     * @param  array  $data  An associative array containing the updated bank details.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object indicating success or failure.
     *
     * @throws \Exception
     */
    public function updateBank(string $id, array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('banks/'.$id);
        $this->setRequestType('PUT');

        return $this->execute();
    }

    /**
     * Creates a new bank with the provided data.
     *
     * This method sends a POST request to create a new bank using the specified data.
     * The API version can be specified to target a particular version of the endpoint.
     * The method constructs the request with the provided data as form parameters and
     * executes the request.
     *
     * @param  array  $data  An associative array containing the details of the bank to create.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object indicating success or failure.
     *
     * @throws \Exception
     */
    public function createBank(array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('banks');
        $this->setRequestType('POST');

        return $this->execute();
    }

    /**
     * Retrieves the allowed statuses for banks.
     *
     * This method sends a GET request to fetch the list of allowed statuses for banks.
     * The API version can be specified to target a particular version of the endpoint.
     * It initializes the request, sets the endpoint, and executes the request.
     *
     * @param string $version The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object containing the allowed statuses.
     *
     * @throws \Exception If an error occurs during the request execution.
     */
    public function allowedStatuses(string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query([]),
        ]);
        $this->setEndpoint('banks/allowedStatuses');
        $this->setRequestType('GET');

        return $this->execute();
    }
}
