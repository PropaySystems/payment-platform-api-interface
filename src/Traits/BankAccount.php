<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait BankAccount
{
    /**
     * Retrieves a list of contacts based on filters and includes optional related resources for a specified API version.
     *
     * This method allows for the retrieval of contacts with the ability to filter the results and include additional
     * related resources in the response. It constructs a query string with the specified filters and includes, sets
     * the API version, and initiates a GET request to the 'contacts' endpoint. The response from the execution of this
     * request is returned, which may include a list of contacts along with any specified related resources.
     *
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
    public function contactBankAccounts(array $filters = [], array $includes = [], array $sort = [], string $version = 'v1', int $per_page = 15, ?int $page = null): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes, 'sort' => $sort, 'per-page' => $per_page, 'page' => $page ?? 1]),
        ]);
        $this->setEndpoint('contact-bank-account');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Retrieves details of a specific bank account associated with a contact by ID, including optional related resources for a specified API version.
     *
     * This method is designed to fetch the details of a specific bank account associated with a contact, identified by the bank account's ID.
     * It allows for the inclusion of additional related resources in the response. The method constructs a query string using the provided
     * includes, sets the desired API version, and initiates a GET request to the 'contact-bank-account/show/{id}' endpoint, where {id} is
     * the bank account's ID. The response from the execution of this request is then returned, potentially including the bank account's details
     * along with any specified related resources.
     *
     * @param  string  $id  The unique identifier of the bank account to retrieve.
     * @param  array  $includes  (Optional) An array of related resources to include in the response for the bank account.
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @return mixed The response from the API, typically an object or array containing the details of the bank account
     *               and any included related resources. The exact return type may vary depending on the implementation
     *               of the `execute` method.
     *
     * @throws \Exception
     */
    public function contactBankAccount(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes]),
        ]);
        $this->setEndpoint('contact-bank-account/show/'.$id);
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Updates the details of a specific bank account associated with a contact by ID for a specified API version.
     *
     * This method allows for the updating of a specific bank account's details associated with a contact, identified by the bank account's ID.
     * It sets the API version, configures the data payload as form parameters, sets the endpoint to target the specific bank account by appending
     * the ID to the 'contact-bank-account/' endpoint, and specifies the request type as 'PUT'. The method then executes the request and returns
     * the response, which may include the updated details of the bank account.
     *
     * @param  string  $contactNumber  The unique identifier of the contact to update.
     * @param  string  $contactBankAccountId  The unique identifier of the bank account to update.
     * @param  array  $data  (Optional) An associative array of data for updating the bank account. The array keys and values
     *                       should match the bank account model's attributes and the API's update capabilities.
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @return mixed The response from the API, typically an object or array containing the updated details of the bank account.
     *               The exact return type may vary depending on the implementation of the `execute` method.
     *
     * @throws \Exception
     */
    public function updateContactBankAccount(string $contactNumber, string $contactBankAccountId, array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('contact-bank-account/'.$contactNumber.'/'.$contactBankAccountId);
        $this->setRequestType('PUT');

        return $this->execute();
    }

    /**
     * Creates a new bank account for a contact with the provided data for a specified API version.
     *
     * This method prepares the request to create a new bank account for a contact with the given data array. It sets the API version,
     * configures the data payload as form parameters, sets the endpoint to 'contact-bank-account/' for bank account creation,
     * and specifies the request type as 'POST'. Finally, it executes the request and returns the response.
     *
     * @param  string  $contactNumber  The unique identifier of the contact to update.
     * @param  array  $data  (Optional) An associative array of data for creating the bank account. The array keys and values
     *                       should match the bank account model's attributes and the API's creation capabilities.
     * @param  string  $version  (Optional) The version of the API to target. Defaults to 'v1'.
     * @return mixed The response from the API, typically an object or array containing the details of the newly created bank account.
     *               The exact return type may vary depending on the implementation of the `execute` method.
     *
     * @throws \Exception
     */
    public function createContactBankAccount(string $contactNumber, array $data = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'form_params' => $data,
        ]);
        $this->setEndpoint('contact-bank-account/'.$contactNumber);
        $this->setRequestType('POST');

        return $this->execute();
    }

    /**
     * Retrieves the allowed statuses for contact bank accounts.
     *
     * This method sends a GET request to fetch the list of allowed statuses for contact bank accounts.
     * The API version can be specified to target a particular version of the endpoint.
     * It initializes the request, sets the endpoint, and executes the request.
     *
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object containing the allowed statuses.
     *
     * @throws \Exception If an error occurs during the request execution.
     */
    public function allowedContactBankAccountStatuses(string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query([]),
        ]);
        $this->setEndpoint('contact-bank-account/allowedStatuses');
        $this->setRequestType('GET');

        return $this->execute();
    }
}
