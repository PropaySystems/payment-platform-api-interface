<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait Address
{
    /**
     * Retrieves a list of contact addresses based on filters and includes.
     *
     * This method fetches contact addresses by applying the specified filters and includes.
     * It constructs a query string using the provided filters and includes, sets the API endpoint,
     * and specifies the request type as 'GET'. The method then executes the request and returns the response.
     *
     * @param  array  $filters  Optional associative array of filters to apply to the query.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  string  $version  API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request.
     */
    public function getContactAddresses(array $filters = [], array $includes = [], string $version = 'v1'): mixed
    {
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes]),
        ]);
        $this->setEndpoint('contact-addresses');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Fetches a specific contact address by ID with optional related resources.
     *
     * This method retrieves a single contact address by its unique identifier. It allows for the inclusion
     * of related resources through the `$includes` parameter to enrich the response data. The API version
     * can be specified to use a particular version of the endpoint. The method constructs a query string
     * with the includes, sets the appropriate API endpoint, and performs a GET request to fetch the data.
     *
     * @param  string  $id  The unique identifier of the contact address to retrieve.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object.
     */
    public function getContactAddress(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes]),
        ]);
        $this->setEndpoint('contact-addresses/show/'.$id);
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Updates a specific contact address by ID.
     *
     * This method allows for updating the details of a specific contact address identified by its unique ID.
     * It sends a PUT request to the specified endpoint with the updated data. The API version can be specified,
     * allowing for flexibility with different API versions. The method constructs the request with the provided
     * data as form parameters and executes the request.
     *
     * @param  string  $id  The unique identifier of the contact address to update.
     * @param  array  $data  An associative array containing the updated contact address details.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object indicating success or failure.
     */
    public function updateContactAddress(string $id, array $data = [], string $version = 'v1'): mixed
    {
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('contact-addresses/'.$id);
        $this->setRequestType('PUT');

        return $this->execute();
    }

    /**
     * Creates a new contact address.
     *
     * This method is responsible for creating a new contact address in the system. It sends a POST request
     * to the 'contact-addresses' endpoint with the provided data. The API version can be specified, allowing
     * for the use of different versions of the API. The method constructs the request with the provided data
     * as form parameters and executes the request.
     *
     * @param  array  $data  An associative array containing the details of the contact address to be created.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object indicating the success or details of the created contact address.
     */
    public function createContactAddress(array $data = [], string $version = 'v1'): mixed
    {
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('contact-addresses');
        $this->setRequestType('POST');

        return $this->execute();
    }
}
