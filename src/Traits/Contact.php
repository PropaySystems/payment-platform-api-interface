<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait Contact
{
    /**
     * Retrieves a list of contacts based on filters and includes optional related resources for a specified API version.
     *
     * This method allows for the retrieval of contacts with the ability to filter the results and include additional
     * related resources in the response. It constructs a query string with the specified filters and includes, sets
     * the API version, and initiates a GET request to the 'contacts' endpoint. The response from the execution of this
     * request is returned, which may include a list of contacts along with any specified related resources.
     **
     * @param  array  $filters  (Optional) An associative array of filters to apply to the contact retrieval. The array keys
     *                          and values depend on the contact model's attributes and the API's filtering capabilities.
     * @param  array  $includes  (Optional) An array of related resources to include in the response for each contact.
     * @param  array  $sort  (Optional) An array of sorting options to apply to the contact retrieval.
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @param  int  $per_page  Number of results per page, defaults to 15.
     * @param  int|null  $page  Page number to retrieve, defaults to null which is interpreted as the first page.
     * @return mixed The response from the API, typically an object or array containing the list of contacts
     *               and any included related resources. The exact return type may vary depending on the implementation
     *               of the `execute` method.
     *
     * @throws \Exception
     */
    public function contacts(array $filters = [], array $includes = [], array $sort = [], string $version = 'v1', int $per_page = 15, ?int $page = null): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes, 'sort' => $sort, 'per-page' => $per_page, 'page' => $page ?? 1]),
        ]);
        $this->setEndpoint('contacts');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Retrieves a specific contact by ID, including optional related resources, for a specified API version.
     *
     * This method sets the API version, constructs a query string to include optional related resources,
     * sets the endpoint to target a specific contact by ID, and initiates a GET request. The response from
     * the execution of this request is returned, which may include the contact details along with any specified
     * related resources.
     *
     * @param  string  $id  The unique identifier of the contact to retrieve.
     * @param  array  $includes  (Optional) An array of related resources to include in the response.
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @return mixed The response from the API, typically an object or array containing the contact details
     *               and any included related resources. The exact return type may vary depending on the implementation
     *               of the `execute` method.
     *
     * @throws \Exception
     */
    public function contact(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes]),
        ]);
        $this->setEndpoint('contacts/show/'.$id);
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Updates a specific contact by ID with provided data for a specified API version.
     *
     * This method prepares the request to update a contact identified by the given ID with the provided data array.
     * It sets the API version, configures the data payload as form parameters, sets the endpoint to target the specific
     * contact by appending the ID to the 'contacts/' endpoint, and specifies the request type as 'PUT'.
     * Finally, it executes the request and returns the response.
     *
     * @param  string  $id  The unique identifier of the contact to update.
     * @param  array  $data  (Optional) An associative array of data to update the contact with. The array keys and values
     *                       depend on the contact model's attributes and the API's update capabilities.
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @return mixed The response from the API, typically an object or array containing the updated contact details.
     *               The exact return type may vary depending on the implementation of the `execute` method.
     *
     * @throws \Exception
     */
    public function updateContact(string $id, array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'json' => $data,
        ]);
        $this->setEndpoint('contacts/'.$id);
        $this->setRequestType('PUT');

        return $this->execute();
    }

    /**
     * Bulk updates specific contact by ID with provided data for a specified API version.
     *
     * This method prepares the request to bulk update contacts identified by the given ID with the provided data array.
     * It sets the API version, configures the data payload as form parameters, sets the endpoint to target the specific
     * contact by appending the ID to the 'contacts/' endpoint, and specifies the request type as 'PUT'.
     * Finally, it executes the request and returns the response.
     *
     * @param  string  $id  The unique identifier of the contact to update.
     * @param  array  $data  (Optional) An associative array of data to update the contact with. The array keys and values
     *                       depend on the contact model's attributes and the API's update capabilities.
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @return mixed The response from the API, typically an object or array containing the updated contact details.
     *               The exact return type may vary depending on the implementation of the `execute` method.
     *
     * @throws \Exception
     */
    public function bulkUpdateContact(string $id, array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'json' => $data,
        ]);
        $this->setEndpoint('contacts/bulkUpdate/'.$id);
        $this->setRequestType('PUT');

        return $this->execute();
    }

    /**
     * Creates a new contact with the provided data for a specified API version.
     *
     * This method prepares the request to create a new contact with the given data array. It sets the API version,
     * configures the data payload as form parameters, sets the endpoint to the 'contacts/' for contact creation,
     * and specifies the request type as 'POST'. Finally, it executes the request and returns the response.
     *
     * @param  array  $data  (Optional) An associative array of data for creating the contact. The array keys and values
     *                       should match the contact model's attributes and the API's creation capabilities.
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @return mixed The response from the API, typically an object or array containing the details of the newly created contact.
     *               The exact return type may vary depending on the implementation of the `execute` method.
     *
     * @throws \Exception
     */
    public function createContact(array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'json' => $data,
        ]);
        $this->setEndpoint('contacts');
        $this->setRequestType('POST');

        return $this->execute();
    }

    /**
     * Creates a new contact with the provided data for a specified API version.
     *
     * This method prepares the request to create a new contact with the given data array. It sets the API version,
     * configures the data payload as form parameters, sets the endpoint to the 'contacts/' for contact creation,
     * and specifies the request type as 'POST'. Finally, it executes the request and returns the response.
     *
     * @param  array  $data  (Optional) An associative array of data for creating the contact. The array keys and values
     *                       should match the contact model's attributes and the API's creation capabilities.
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @return mixed The response from the API, typically an object or array containing the details of the newly created contact.
     *               The exact return type may vary depending on the implementation of the `execute` method.
     *
     * @throws \Exception
     */
    public function bulkCreateContacts(array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'json' => $data,
        ]);
        $this->setEndpoint('contacts/bulkCreate');
        $this->setRequestType('POST');

        return $this->execute();
    }

    /**
     * Retrieves the allowed statuses for contacts.
     *
     * This method sends a GET request to fetch the list of allowed statuses for contacts.
     * The API version can be specified to target a particular version of the endpoint.
     * It initializes the request, sets the endpoint, and executes the request.
     *
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object containing the allowed statuses.
     *
     * @throws \Exception If an error occurs during the request execution.
     */
    public function allowedContactStatuses(string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query([]),
        ]);
        $this->setEndpoint('contacts/allowedStatuses');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Retrieves all abbreviated names of contacts for a specified API version.
     *
     * This method sends a GET request to the 'contacts/abbreviatedNames' endpoint to fetch a list of all abbreviated names.
     * It initializes the request, sets the API version, and executes the request.
     *
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @return mixed The response from the API, typically an object or array containing the list of abbreviated names.
     *
     * @throws \Exception If an error occurs during the request execution.
     */
    public function getAllAbbreviatedNames(string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query([]),
        ]);
        $this->setEndpoint('contacts/abbreviatedNames');
        $this->setRequestType('GET');

        return $this->execute();
    }
}
