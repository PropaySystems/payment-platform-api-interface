<?php

namespace PropaySystems\PaymentPlatformApiInterface\Traits;

trait PaymentMethod
{
    /**
     * Retrieves a list of payment methods based on filters and includes.
     *
     * This method fetches payment methods by applying the specified filters and includes.
     * It constructs a query string using the provided filters and includes, sets the API endpoint
     * to 'payments/methods', and specifies the request type as 'GET'. The method then executes the request
     * and returns the response. This can be used to obtain various payment methods available in the system,
     * potentially filtered or enhanced with additional related resources.
     *
     * @param  array  $filters  Optional associative array of filters to apply to the query.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  string  $version  API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request.
     *
     * @throws \Exception
     */
    public function getPaymentMethods(array $filters = [], array $includes = [], string $version = 'v1', $per_page = 15): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['filter' => $filters, 'include' => $includes, 'per-page' => $per_page]),
        ]);
        $this->setEndpoint('payments/methods');
        $this->setRequestType('GET');

        return $this->execute();
    }

    /**
     * Retrieves a specific payment method by ID with optional related resources.
     *
     * This method fetches a single payment method by its unique identifier. It allows for the inclusion
     * of related resources through the `$includes` parameter to enrich the response data. The API version
     * can be specified to use a particular version of the endpoint. The method constructs a query string
     * with the includes, sets the appropriate API endpoint, and performs a GET request to fetch the data.
     *
     * @param  string  $id  The unique identifier of the payment method to retrieve.
     * @param  array  $includes  Optional array of related resources to include in the response.
     * @param  string  $version  The API version to use for the request, defaults to 'v1'.
     * @return mixed The response from the API after executing the request, typically an array or object.
     *
     * @throws \Exception
     */
    public function getPaymentMethod(string $id, array $includes = [], string $version = 'v1'): mixed
    {
        $this->init();
        $this->setVersion($version);
        $this->setData([
            'query' => http_build_query(['include' => $includes]),
        ]);
        $this->setEndpoint('payments/methods/show/'.$id);
        $this->setRequestType('GET');

        return $this->execute();
    }
}
