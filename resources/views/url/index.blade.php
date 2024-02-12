<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Url list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-8 lg:px-10">
            <div class="relative overflow-x-auto">
                <a href="{{route('url.create')}}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</a>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Url
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Original url
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Visit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($urls as $url)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{route('url.show', ['url' => $url->id])}}" >{{$url->id}}</a>
                            </th>
                            <td class="px-6 py-4">
                                <a href="{{$url->url}}"  target="_blank">{{\Illuminate\Support\Str::limit($url->url, 100, '...')}}</a>

                            </td>
                            <td class="px-6 py-4">
                                {{$url->count}}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{route('url.edit',['url' => $url->id])}}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> edit</a>
                                <form action="{{ route('url.destroy', $url->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this resource?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $urls->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
