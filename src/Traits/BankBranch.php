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
    public function branches(array $filters = [], array $includes = [], array $sort = [], string $version = 'v1', int $per_page = 15, ?int $page = null): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes, 'sort' => $sort, 'per-page' => $per_page, 'page' => $page ?? 1]),
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
     * @param  string  $id  The unique identifier of the bank branch to retrieve.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object.
     *
     * @throws \Exception
     */
    public function branch(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes]),
        ]);
        $this->setEndpoint('bank-branches/show/'.$id);
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Updates a specific bank branch by ID.
     *
     * This method sends a PUT request to update the details of a specific bank branch
     * identified by its unique ID. The updated data is sent as form parameters in the request.
     * The API version can be specified to target a particular version of the endpoint.
     *
     * @param  string  $id  The unique identifier of the bank branch to update.
     * @param  array  $data  An associative array containing the updated bank branch details.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object indicating success or failure.
     *
     * @throws \Exception
     */
    public function updateBranch(string $id, array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('bank-branches/'.$id);
        $this->setRequestType('PUT');

        return $this->execute();
    }

    /**
     * Creates a new bank branch with the provided data.
     *
     * This method sends a POST request to create a new bank branch using the specified data.
     * The API version can be specified to target a particular version of the endpoint.
     * The method constructs the request with the provided data as form parameters and
     * executes the request.
     *
     * @param  array  $data  An associative array containing the details of the bank branch to create.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object indicating success or failure.
     *
     * @throws \Exception
     */
    public function createBranch(array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('bank-branches');
        $this->setRequestType('POST');

        return $this->execute();
    }

    /**
     * Retrieves the allowed statuses for bank branches.
     *
     * This method sends a GET request to fetch the list of allowed statuses for bank branches.
     * The API version can be specified to target a particular version of the endpoint.
     * It initializes the request, sets the endpoint, and executes the request.
     *
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object containing the allowed statuses.
     *
     * @throws \Exception If an error occurs during the request execution.
     */
    public function allowedBranchStatuses(string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query([]),
        ]);
        $this->setEndpoint('bank-branches/allowedStatuses');
        $this->setRequestType('GET');

        return $this->execute();
    }
}
