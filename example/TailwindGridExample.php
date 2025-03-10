<?php

//            dump(request()->all(), explode(',', request()->get('sort')), explode(',', request()->get('filters')));

$client = PaymentPlatformAPI::getInstance() //Singleton
->url('http://payment-platform-api.test/api') //Set host only if you have a custom host
->setVersion('v1')
    ->setCredentials('test@test', '123456789');

$filters = array_merge(
    request()->get('filter_name') ? ['name' => request()->get('filter_name')] : []
);

//            dump($filters);

$contacts = $client->contacts(
    $filters,
    $includes = ['bankAccounts', 'products'],
    $sort = explode(',', request()->get('sort')),
    $version = 'v1',
    $per_page = 4,
    $page = request()->get('page'))
    ->get();

dump($contacts);

?>


<div>

    <table class="w-full ring-1 ring-gray-950/5 dark:ring-white/10 rounded-xl bg-white dark:bg-gray-900">
        <thead class="bg-gray-50 dark:bg-white/5">
        <tr class="border-b">
            <td class="text-sm ps-3">
                <form action="{{route(Route::currentRouteName())}}" method="get">
                    <input
                        class="fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                        autocomplete="off" maxlength="1000" placeholder="Search" type="search"
                        id="name_search" name="filter_name" value="{{request()->get('filter_name')}}">
                </form>
            </td>
            <td class="text-sm ps-3"></td>
            <td class="text-sm ps-3"></td>
            <td class="text-sm ps-3"></td>
            <td class="text-sm ps-3"></td>
            <td class="text-sm ps-3"></td>
            <td class="text-sm ps-3"></td>
            <td class="text-right py-3 pe-3"></td>
        </tr>
        <tr class="border-b">
            <th class="text-left px-3 py-3.5"><a
                    href="{{route(Route::currentRouteName(), ['sort' => in_array('contact_number', $sort) ? '-contact_number' : 'contact_number'])}}">Contact
                    Number</a></th>
            <th class="text-left px-3 py-3.5">Name</th>
            <th class="text-left px-3 py-3.5">Email</th>
            <th class="text-left px-3 py-3.5">Phone</th>
            <th class="text-left px-3 py-3.5">Status</th>
            <th class="text-left px-3 py-3.5">#Products</th>
            <th class="text-left px-3 py-3.5">#Bank Accounts</th>
            <th class="text-left px-3 py-3.5"></th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($contacts->data))
        @foreach ($contacts->data as $contact)
        <tr class="border-b">
            <td class="text-sm ps-3">{{ $contact->attributes->contact_number }}</td>
            <td class="text-sm ps-3">{{ $contact->attributes->name }}</td>
            <td class="text-sm ps-3">{{ $contact->attributes->email }}</td>
            <td class="text-sm ps-3">{{ $contact->attributes->phone }}</td>
            <td class="text-sm ps-3">{{ $contact->attributes->status }}</td>
            <td class="text-sm ps-3">{{ count($contact->relationships->products->data) }}</td>
            <td class="text-sm ps-3">{{ count($contact->relationships->bankAccounts->data) }}</td>

            <td class="text-right py-3 pe-3">
                <x-filament::button type="submit">
                    <span wire:loading.remove wire.target="updateProduct">Update</span>
                    <span wire:loading wire.target="updateProduct">Updating..</span>
                </x-filament::button>
            </td>
        </tr>
        @endforeach
        @else
        <tr class="border-b">
            <td colspan="8" class="text-sm ps-3 text-center font-bold">No records found.</td>
        </tr>
        @endif
        </tbody>
        <tfoot>
        <tr>
            <td colspan="7" class="py-4 px-3">

                <p class="text-sm">
                    Showing {{ $contacts->meta->pagination->count > 0 ? ($contacts->meta->pagination->current_page - 1) * $contacts->meta->pagination->per_page + 1 : 0 }}
                    to {{ min($contacts->meta->pagination->current_page * $contacts->meta->pagination->per_page, $contacts->meta->pagination->total) }}
                    of {{ $contacts->meta->pagination->total }} results

            </td>
            <td class="text-right">

                @if($contacts->meta->pagination->total_pages > 1)

                @if($contacts->links->first ?? false)
                <a class="py-2 px-3 mx-1 border border-primary-600 rounded-lg"
                   href="{{route(Route::currentRouteName(), ['page' => (int) str_replace('page=', '', parse_url($contacts->links->first, PHP_URL_QUERY))])}}">First</a>
                @endif

                @if($contacts->links->prev ?? false)
                <a class="py-2 px-3 mx-1 border border-primary-600 rounded-lg"
                   href="{{route(Route::currentRouteName(), ['page' => (int) str_replace('page=', '', parse_url($contacts->links->prev, PHP_URL_QUERY))])}}">Prev</a>
                @endif

                @if($contacts->links->next ?? false)
                <a class="py-2 px-3 mx-1 border border-primary-600 rounded-lg"
                   href="{{route(Route::currentRouteName(), ['page' => (int) str_replace('page=', '', parse_url($contacts->links->next, PHP_URL_QUERY))])}}">Next</a>
                @endif

                @if($contacts->links->last ?? false)
                <a class="py-2 px-3 mx-1 border border-primary-600 rounded-lg"
                   href="{{route(Route::currentRouteName(), ['page' => (int) str_replace('page=', '', parse_url($contacts->links->last, PHP_URL_QUERY))])}}">Last</a>
                @endif

                @endif
            </td>
        </tr>
        </tfoot>
    </table>
</div>
