<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait Product
{
    /**
     * Retrieves a list of contact products based on filters and includes.
     *
     * This method fetches contact products by applying the specified filters and includes.
     * It constructs a query string using the provided filters and includes, sets the API endpoint
     * to 'contact-product', and specifies the request type as 'GET'. The method then executes the request
     * and returns the response. This can be used to obtain various contact products available in the system,
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
    public function contactProducts(array $filters = [], array $includes = [], array $sort = [], string $version = 'v1', int $per_page = 15, ?int $page = null): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes, 'sort' => $sort, 'per-page' => $per_page, 'page' => $page ?? 1]),
        ]);
        $this->setEndpoint('contact-product');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Retrieves a specific contact product by ID with optional related resources.
     *
     * This method fetches a single contact product by its unique identifier. It allows for the inclusion
     * of related resources through the `$includes` parameter to enrich the response data. The API version
     * can be specified to use a particular version of the endpoint. The method constructs a query string
     * with the includes, sets the appropriate API endpoint, and performs a GET request to fetch the data.
     *
     * @param  string  $id  The unique identifier of the contact product to retrieve.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object.
     *
     * @throws \Exception
     */
    public function contactProduct(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes]),
        ]);
        $this->setEndpoint('contact-product/show/'.$id);
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Updates a specific contact product by ID.
     *
     * This method allows for updating a contact product's details by its unique identifier. It sends a PUT request
     * to the specified endpoint with the data to be updated. The API version can be specified to use a particular
     * version of the endpoint. The method constructs the request with the provided data, sets the appropriate API
     * endpoint, and performs the request to update the contact product.
     *
     * @param  string  $id  The unique identifier of the contact product to update.
     * @param  array  $data  The data to update the contact product with.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request.
     *
     * @throws \Exception
     */
    public function updateContactProduct(string $id, array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('contact-product/'.$id);
        $this->setRequestType('PUT');

        return $this->execute();
    }

    /**
     * Creates a new contact product with the specified details.
     *
     * This method allows for the creation of a new contact product by sending a POST request
     * to the specified endpoint with the data provided. The API version can be specified to use
     * a particular version of the endpoint. The method constructs the request with the provided data,
     * sets the appropriate API endpoint, and performs the request to create the contact product.
     *
     * @param  array  $data  The data to create the contact product with.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request.
     *
     * @throws \Exception
     */
    public function createContactProduct(array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('contact-product');
        $this->setRequestType('POST');

        return $this->execute();
    }

    /**
     * Retrieves the allowed statuses for contact products.
     *
     * This method sends a GET request to fetch the list of allowed statuses for contact products.
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
        $this->setEndpoint('contact-product/allowedStatuses');
        $this->setRequestType('GET');

        return $this->execute();
    }
}
